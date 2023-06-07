<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Task extends Model implements HasMedia
{
    use SoftDeletes;
    use InteractsWithMedia;
    use Auditable;
    use HasFactory;

    public const STUTS_SELECT = [
        '1' => 'مفتوحه',
        '2' => 'مغلقه',
    ];
    public const CONS_SELECT = [
        '1' => 'ادارة الاسفلت   ',
        '2' => 'مؤسسة حمدان الشمري  ',
        '3' => 'عبدالله عيد الاسلمي ',
        '4' => '  مؤسسة اعالي الجوده ',

    ];

    public const RESPONSER_SELECT = [
        '1' => 'موظف الرخص',
        '2' => 'المهندس',
        '3' => 'ادارة الاسفلت',
        '4' => 'المقاول',
    ];
    public const ENJAZ_STUTS_SELECT = [
        '1' => 'جاري سفلتت الموقع',
        '2' => 'تم الرفض من ادارة الاسفلت',
        '3' => 'جاري استخراج شهادة الانجاز',
        '4' => 'تم اصدار شهادة الانجاز',
        '5' => 'تم الرفض من المختبر',
        '6' => 'اصدار الشهادة بعد الرفض',
        '7' => 'تم اغلاق الرخصة ',
        '8' => '  جاري الحفر  ',
        '9' => '   اتم رفع طلب اتمام اعمال  ',
        '10' => '   تم رفع طلب اخلاء طرف   ',

    ];
        public $table = 'tasks';

    public static $searchable = [
        'lics_file',
        'name',
        'copy',
        'start_time',
        'extract',
        'city',
        'streat',
        'stuts',
        'check_1',
        'move_to_con_date',
    ];

    protected $appends = [
        'lics_file',
    ];

    protected $dates = [
        'start_time',
        'due_date',
        'extract',
        'created_at',
        'updated_at',
        'deleted_at',

    ];

    protected $fillable = [
        'lics_no_id',
        'name',
        'copy',
        'start_time',
        'due_date',
        'length_total',
        'extract',
        'city',
        'streat',
        'stuts',
        'assigned_to_id',
        'created_at',
        'check_1',
        'check_2',
        'updated_at',
        'move_to_con_date',
        'statuts_id',
        'responser',
        'esfelt_done',
        'enjaz_stuts',
        'close_done',
        'esfelt_stuts',
        'con',
        'enjaz',
        'etmam',
        'kholow',

        
    ];
    public function statuts()
    {
        return $this->belongsTo(Esfelt::class, 'esfelt_stuts');
    }
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function licsesNumberLics()
    {
        return $this->hasMany(Lic::class, 'licses_number_id', 'id');
    }

    public function licsNoEsfelts()
    {
        return $this->hasMany(Esfelt::class, 'lics_no_id', 'id');
    }

    public function licesNoCloses()
    {
        return $this->hasMany(Close::class, 'lices_no_id', 'id');
    }

    public function getLicsFileAttribute()
    {
        return $this->getMedia('lics_file');
    }

    public function lics_no()
    {
        return $this->belongsTo(Lic::class, 'lics_no_id');
    }

    public function getStartTimeAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setStartTimeAttribute($value)
    {
        $this->attributes['start_time'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getDueDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDueDateAttribute($value)
    {
        $this->attributes['due_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getExtractAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setExtractAttribute($value)
    {
        $this->attributes['extract'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function assigned_to()
    {
        return $this->belongsTo(User::class, 'assigned_to_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}

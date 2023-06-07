<?php

namespace App\Models;
use Carbon\Carbon;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Esfelt extends Model implements HasMedia
{
    use SoftDeletes;
    use InteractsWithMedia;
    use Auditable;
    use HasFactory;

    public const DELIVERY_SELECT = [
        '1' => 'جاري سفلتت الموقع',
        '2' => 'تم الرفض من ادارة الاسفلت',
        '3' => 'جاري استخراج شهادة الانجاز',
        '4' => 'تم اصدار شهادة الانجاز',
        '5' => 'تم الرفض من المختبر',
        '6' => 'اصدار الشهادة بعد الرفض',

    ];
    public const TYPE_SELECT = [
        '1' => 'عادية',
        '2' => 'طارئ',
    ];
    public const CONS_SELECT = [
        '1' => 'ادارة الاسفلت   ',
        '2' => 'مؤسسة حمدان الشمري  ',
        '3' => 'عبدالله عيد الاسلمي ',
        '4' => '  مؤسسة اعالي الجوده ',

    ];
    public const ESFELT_STUTS_SELECT = [
        '1' => 'تم الارسال الي المقاول',
        '2' => 'تم الانتهاء من سفلتت الموقع',
    ];

    public $table = 'esfelts';

    public static $searchable = [
        'licses',
        'work_done_pic',
        'city',
        'length',
        'lengtute',
        'cons',
        'esfelt_pic',
        'eng_sign',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'end_date',
        'deleted_at',
    ];

    protected $appends = [
        'licses',
        'work_done_pic',
        'esfelt_pic',
        'eng_sign',
    ];

    protected $fillable = [
        'lics_no_id',
        'city',
        'length',
        'lengtute',
        'check_1',
        'eng_id',
        'cons',
        'created_at',
        'esfelt_stuts',
        'note',
        'end_date',
        'link',
        'type',
        'delivery',
        'end_esfelt_date',

        'check_2',
        'updated_at',
        'deleted_at',
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function lics_no()
    {
        return $this->belongsTo(Task::class, 'lics_no_id');
    }
    public function statutsTasks()
    {
        return $this->hasMany(Task::class, 'esfelt_stuts', 'id');
    }
    public function getLicsesAttribute()
    {
        return $this->getMedia('licses');
    }

    public function getWorkDonePicAttribute()
    {
        $files = $this->getMedia('work_done_pic');
        $files->each(function ($item) {
            $item->url = $item->getUrl();
            $item->thumbnail = $item->getUrl('thumb');
            $item->preview = $item->getUrl('preview');
        });

        return $files;
    }

    public function eng()
    {
        return $this->belongsTo(User::class, 'eng_id');
    }

    public function getEsfeltPicAttribute()
    {
        $files = $this->getMedia('esfelt_pic');
        $files->each(function ($item) {
            $item->url = $item->getUrl();
            $item->thumbnail = $item->getUrl('thumb');
            $item->preview = $item->getUrl('preview');
        });

        return $files;
    }

    public function getEngSignAttribute()
    {
        $files = $this->getMedia('eng_sign');
        $files->each(function ($item) {
            $item->url = $item->getUrl();
            $item->thumbnail = $item->getUrl('thumb');
            $item->preview = $item->getUrl('preview');
        });

        return $files;
    }
    
    public function setEndDateAttribute($value)
    {
        $this->attributes['end_date'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}

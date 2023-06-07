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

class Lic extends Model implements HasMedia
{
    use SoftDeletes;
    use InteractsWithMedia;
    use Auditable;
    use HasFactory;

    public const STUTS_SELECT = [
        '1' => 'طوارئ',
        '2' => 'عادية',
    ];
    public const eng_check = [
        '1' => 'غير موافق ',
        '2' => 'موافق',
    ];

    public const DEPARTMENT_SELECT = [
        'Electrical' => 'الكهرباء',
        'Projects'   => 'المشاريع',
    ];

    public const ORDER_STAUTS_SELECT = [
        '1' => 'تم استلام الطلب',
        '2' => 'تم رفع الطلب للجهات الحكومية',
        '3' => 'تم الرفض',
        '4' => 'جاري إعادة رفع الطلب',
        '5' => 'تم اصدار الرخصة',
    ];

    public $table = 'lics';

    public static $searchable = [
        'department',
        'license_no',
        'esnad',
        'datestary',
        'date_end',
        'city',
        'longtude',
        'path',
        'license_pic',
        'stuts',
        'e_length',
        't_length',
        'sarameek',
        'wide',
        'order_stauts',
        'naseg_no',
        'order_pic',
        'order_reject',
        'task_number',  
    ];

    protected $appends = [
        'path',
        'license_pic',
        'order_pic',
        'order_reject',
    ];

    protected $dates = [
        'created_at',
        'esnad',
        'datestary',
        'date_end',
        'updated_at',
        'deleted_at',

        
    ];

    protected $fillable = [
        'created_at',
        'department',
        'license_no',
        'esnad',
        'datestary',
        'date_end',
        'city',
        'longtude',
        'stuts',
        'e_length',
        't_length',
        'wide',
        'deep',
        'created_by_id',
        'head_eng_id',
        'eng_check',
        'order_stauts',
        'user_id',
        'updated_at',
        'licses_number_id',
        'task_number',  
        'naseg_no',


    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function licsNoTasks()
    {
        return $this->hasMany(Task::class, 'lics_no_id', 'id');
    }

    public function getEsnadAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setEsnadAttribute($value)
    {
        $this->attributes['esnad'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getDatestaryAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDatestaryAttribute($value)
    {
        $this->attributes['datestary'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getDateEndAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDateEndAttribute($value)
    {
        $this->attributes['date_end'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getPathAttribute()
    {
        $files = $this->getMedia('path');
        $files->each(function ($item) {
            $item->url = $item->getUrl();
            $item->thumbnail = $item->getUrl('thumb');
            $item->preview = $item->getUrl('preview');
        });

        return $files;
    }

    public function getLicensePicAttribute()
    {
        $files = $this->getMedia('license_pic');
        $files->each(function ($item) {
            $item->url = $item->getUrl();
            $item->thumbnail = $item->getUrl('thumb');
            $item->preview = $item->getUrl('preview');
        });

        return $files;
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    public function head_eng()
    {
        return $this->belongsTo(User::class, 'head_eng_id');
    }

    public function getOrderPicAttribute()
    {
        $files = $this->getMedia('order_pic');
        $files->each(function ($item) {
            $item->url = $item->getUrl();
            $item->thumbnail = $item->getUrl('thumb');
            $item->preview = $item->getUrl('preview');
        });

        return $files;
    }

    public function getOrderRejectAttribute()
    {
        $files = $this->getMedia('order_reject');
        $files->each(function ($item) {
            $item->url = $item->getUrl();
            $item->thumbnail = $item->getUrl('thumb');
            $item->preview = $item->getUrl('preview');
        });

        return $files;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function licses_number()
    {
        return $this->belongsTo(Task::class, 'licses_number_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}

<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Billcon extends Model implements HasMedia
{
    use SoftDeletes;
    use MultiTenantModelTrait;
    use InteractsWithMedia;
    use Auditable;
    use HasFactory;

    public const JOB_3_SELECT = [
        '1' => 'بلاط',
        '2' => 'بلاط 2',
    ];

    public const JOB_2_SELECT = [
        '1' => 'كشط متر',
        '2' => 'كشط مترين',
    ];

    public const ACCOUNT_DEPARTMENT_SELECT = [
        '1' => 'جاري الاعتماد',
        '2' => 'تم الاعتماد',
    ];

    public const JOB_1_SELECT = [
        '1' => 'اعادة سفلتة بعرض كشط 1 متر',
        '2' => 'اعادة سفلته بعرض كشط  1.20سم',
    ];

    public $table = 'billcons';

    protected $appends = [
        'enjaz',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'task_no_id',
        'mokusa_id',
        'created_by_id',
        'job_1',
        'job_2',
        'job_3',
        'count_1',
        'count_2',
        'count_3',
        'price_1',
        'price_2',
        'price_3',
        'note_1',
        'note_2',
        'note_3',
        'totall',
        'totall_2',
        'totall_3',
        'totall_4',
        'descount_1',
        'descount_2',
        'descount_3',
        'descount_4',
        'descount_5',
        'descount_6',
        'descount_7',
        'descount_8',
        'descount_9',
        'descount_10',
        'descount_11',

        'account_department',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function task_no()
    {
        return $this->belongsTo(Task::class, 'task_no_id');
    }

    public function mokusa()
    {
        return $this->belongsTo(Lic::class, 'mokusa_id');
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    public function getEnjazAttribute()
    {
        return $this->getMedia('enjaz');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
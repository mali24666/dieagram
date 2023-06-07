<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Box extends Model implements HasMedia
{
    use SoftDeletes;
    use InteractsWithMedia;
    use Auditable;
    use HasFactory;

    public const BOX_TYPE_SELECT = [
        '1' => '1',
        '2' => '2',
        '4' => '4',
    ];

    public const BOX_NOTES_SELECT = [
        'need_plate' => 'need plate',
        'broken'     => 'broken',
    ];

    public $table = 'boxes';

    public static $searchable = [
        'box_number',
        'box_notes',
    ];

    protected $appends = [
        'box_photo',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'box_number',
        'box_type',
        'box_location',
        'box_notes',
        'minibller_no_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public static function boot()
    {
        parent::boot();
        Box::observe(new \App\Observers\BoxActionObserver());
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function getBoxPhotoAttribute()
    {
        $files = $this->getMedia('box_photo');
        $files->each(function ($item) {
            $item->url = $item->getUrl();
            $item->thumbnail = $item->getUrl('thumb');
            $item->preview = $item->getUrl('preview');
        });

        return $files;
    }

    public function minibller_no()
    {
        return $this->belongsTo(Minibller::class, 'minibller_no_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}

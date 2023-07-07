<?php

namespace App\Models;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Box extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, Auditable, HasFactory;

    public $table = 'boxes';

    protected $appends = [
        'box_photo',
    ];

    public static $searchable = [
        'box_number',
        'box_notes',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const BOX_TYPE_SELECT = [
        '1' => '1',
        '2' => '2',
        '4' => '4',
    ];

    public const BOX_NOTES_SELECT = [
        'need_plate' => 'need plate',
        'broken'     => 'broken',
    ];

    protected $fillable = [
        'minibller_no_id',
        'box_number',
        'box_type',
        'box_location',
        'box_notes',
        'trans_box_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function boxCosutomerStations()
    {
        return $this->belongsToMany(Station::class);
    }

    public function boxTranseformers()
    {
        return $this->belongsToMany(Transeformer::class);
    }

    public function minibller_no()
    {
        return $this->belongsTo(Cb::class, 'minibller_no_id');
    }

    public function getBoxPhotoAttribute()
    {
        $files = $this->getMedia('box_photo');
        $files->each(function ($item) {
            $item->url       = $item->getUrl();
            $item->thumbnail = $item->getUrl('thumb');
            $item->preview   = $item->getUrl('preview');
        });

        return $files;
    }

    public function trans_box()
    {
        return $this->belongsTo(Transeformer::class, 'trans_box_id');
    }
}

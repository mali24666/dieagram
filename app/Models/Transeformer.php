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

class Transeformer extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, Auditable, HasFactory;

    public $table = 'transeformers';

    protected $appends = [
        'picture_befor',
        'photo_after',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public static $searchable = [
        't_no',
        'manuf_sno',
        'manufacturer',
        'manufacturer_serial',
        'x_minb',
        'y_minb',
        'left_ss',
        'right_ss',
        'serial_no',
        'type',
    ];

    protected $fillable = [
        't_no',
        'kva_rating',
        'primary_voltage',
        'sec_voltage',
        'manuf_sno',
        'manufacturer',
        'manafac_year',
        'over_load',
        'rating',
        'manufacturer_serial',
        'circuits',
        'no_of_used_circuits',
        'manufacturer_minb',
        'lv_cable',
        'x_minb',
        'y_minb',
        'manuf',
        'left_ss',
        'right_ss',
        'serial_no',
        'type',
        'created_at',
        'cb_no_id',
        'latitude',
        'longitude',
        'feeder_id',
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

    public function transeCbs()
    {
        return $this->hasMany(Cb::class, 'transe_id', 'id');
    }

    public function transformerBills()
    {
        return $this->hasMany(Bill::class, 'transformer_id', 'id');
    }

    public function transLines()
    {
        return $this->belongsToMany(Line::class);
    }

    public function transDiagrams()
    {
        return $this->belongsToMany(Diagram::class);
    }

    public function getPictureBeforAttribute()
    {
        $files = $this->getMedia('picture_befor');
        $files->each(function ($item) {
            $item->url       = $item->getUrl();
            $item->thumbnail = $item->getUrl('thumb');
            $item->preview   = $item->getUrl('preview');
        });

        return $files;
    }

    public function getPhotoAfterAttribute()
    {
        $files = $this->getMedia('photo_after');
        $files->each(function ($item) {
            $item->url       = $item->getUrl();
            $item->thumbnail = $item->getUrl('thumb');
            $item->preview   = $item->getUrl('preview');
        });

        return $files;
    }

    public function cb_no()
    {
        return $this->belongsTo(Cb::class, 'cb_no_id');
    }

    public function feeder()
    {
        return $this->belongsTo(Line::class, 'feeder_id');
    }

    public function transe_notes()
    {
        return $this->belongsToMany(Allnote::class);
    }
}

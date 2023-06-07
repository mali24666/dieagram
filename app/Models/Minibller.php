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

class Minibller extends Model implements HasMedia
{
    use SoftDeletes;
    use InteractsWithMedia;
    use Auditable;
    use HasFactory;

    public $table = 'minibllers';

    public static $searchable = [
        'minibller_number',
        'minibller_x',
        'minibller_y',
    ];

    protected $appends = [
        'minibller_photo',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'cb_number_id',
        'minibller_number',
        'minibller_x',
        'minibller_y',
        'longitude',
        'latitude',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function minibllerNoBoxes()
    {
        return $this->hasMany(Box::class, 'minibller_no_id', 'id');
    }

    public function cb_number()
    {
        return $this->belongsTo(Cb::class, 'cb_number_id');
    }

    public function getMinibllerPhotoAttribute()
    {
        $file = $this->getMedia('minibller_photo')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }

    public function minibllar_notes()
    {
        return $this->belongsToMany(Minibllarnote::class);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}

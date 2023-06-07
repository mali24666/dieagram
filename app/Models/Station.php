<?php

namespace App\Models;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Station extends Model
{
    use SoftDeletes, Auditable, HasFactory;

    public $table = 'stations';

    public static $searchable = [
        'station_no',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'station_no',
        'location',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function stationDiagrams()
    {
        return $this->hasMany(Diagram::class, 'station_id', 'id');
    }

    public function stationLines()
    {
        return $this->hasMany(Line::class, 'station_id', 'id');
    }
/**
 * Get all of the comments for the Station
 *
 * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
 */
public function Transeformers()
{
    return $this->hasManyThrough(Transeformer::class, Line::class);
}
    public function feederDiagrams()
    {
        return $this->belongsToMany(Diagram::class);
    }

    public function feeders()
    {
        return $this->belongsToMany(Line::class);
    }
}

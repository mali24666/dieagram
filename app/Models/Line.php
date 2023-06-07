<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Line extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'lines';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'station_id',
        'line_no',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function point1Cts()
    {
        return $this->hasMany(Ct::class, 'point_1_id', 'id');
    }

    public function point2Cts()
    {
        return $this->hasMany(Ct::class, 'point_2_id', 'id');
    }

    public function feederTranseformers()
    {
        return $this->hasMany(Transeformer::class, 'feeder_id', 'id');
    }

    public function feedersStations()
    {
        return $this->belongsToMany(Station::class);
    }

    public function station()
    {
        return $this->belongsTo(Station::class, 'station_id');
    }

    public function trans()
    {
        return $this->belongsToMany(Transeformer::class);
    }

    public function cts()
    {
        return $this->belongsToMany(Ct::class);
    }
}

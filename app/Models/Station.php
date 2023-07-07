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

    public function nameProjects()
    {
        return $this->hasMany(Project::class, 'name_id', 'id');
    }

    public function feederDiagrams()
    {
        return $this->belongsToMany(Diagram::class);
    }

    public function feeders()
    {
        return $this->belongsToMany(Line::class);
    }

    public function trans()
    {
        return $this->belongsToMany(Transeformer::class);
    }

    public function box_cosutomers()
    {
        return $this->belongsToMany(Box::class);
    }

    public function ct_stations()
    {
        return $this->belongsToMany(Ct::class);
    }

    public function rmus()
    {
        return $this->belongsToMany(Rmu::class);
    }

    public function auto_closers()
    {
        return $this->belongsToMany(Autorecloser::class);
    }

    public function section_lazies()
    {
        return $this->belongsToMany(SectionLazy::class);
    }

    public function avrs()
    {
        return $this->belongsToMany(Avr::class);
    }
}

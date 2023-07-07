<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Avr extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'avrs';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'avr_no',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function avrProjects()
    {
        return $this->hasMany(Project::class, 'avr_id', 'id');
    }

    public function avrStations()
    {
        return $this->belongsToMany(Station::class);
    }
}

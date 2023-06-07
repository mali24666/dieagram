<?php

namespace App\Models;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Diagram extends Model
{
    use SoftDeletes, Auditable, HasFactory;

    public $table = 'diagrams';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'station_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function station()
    {
        return $this->belongsTo(Station::class, 'station_id');
    }

    public function feeders()
    {
        return $this->belongsToMany(Station::class);
    }

    public function cts()
    {
        return $this->belongsToMany(Ct::class);
    }

    public function trans()
    {
        return $this->belongsToMany(Transeformer::class);
    }
}

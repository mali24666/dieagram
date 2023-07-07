<?php

namespace App\Models;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ct extends Model
{
    use SoftDeletes, Auditable, HasFactory;

    public $table = 'cts';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'ct_no',
        'point_1_id',
        'point_2_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function ctDiagrams()
    {
        return $this->belongsToMany(Diagram::class);
    }

    public function ctStationStations()
    {
        return $this->belongsToMany(Station::class);
    }

    public function point_1()
    {
        return $this->belongsTo(Line::class, 'point_1_id');
    }

    public function point_2()
    {
        return $this->belongsTo(Line::class, 'point_2_id');
    }
}

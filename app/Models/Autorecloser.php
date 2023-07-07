<?php

namespace App\Models;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Autorecloser extends Model
{
    use SoftDeletes, Auditable, HasFactory;

    public $table = 'autoreclosers';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'auto_recloser_no',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function autorecloserProjects()
    {
        return $this->hasMany(Project::class, 'autorecloser_id', 'id');
    }

    public function autoCloserStations()
    {
        return $this->belongsToMany(Station::class);
    }
}

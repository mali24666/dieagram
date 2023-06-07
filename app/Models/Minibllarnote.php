<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Minibllarnote extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public $table = 'minibllarnotes';

    public static $searchable = [
        'notes',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'notes',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function minibllarNotesMinibllers()
    {
        return $this->belongsToMany(Minibller::class);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}

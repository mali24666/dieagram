<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bill extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'bills';

    public static $searchable = [
        'ground',
        'line',
        'power_detected',
        'panal',
        'reading',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'ground',
        'line',
        'power_detected',
        'panal',
        'reading',
        'transformer_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function transformer()
    {
        return $this->belongsTo(Transeformer::class, 'transformer_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}

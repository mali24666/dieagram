<?php

namespace App\Models;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cb extends Model
{
    use SoftDeletes, Auditable, HasFactory;

    public $table = 'cbs';

    public static $searchable = [
        'trans_cb_fider_number',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'transe_id',
        'trans_cb_fider_number',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function cbNumberMinibllers()
    {
        return $this->hasMany(Minibller::class, 'cb_number_id', 'id');
    }

    public function minibllerNoBoxes()
    {
        return $this->hasMany(Box::class, 'minibller_no_id', 'id');
    }

    public function cbNoTranseformers()
    {
        return $this->hasMany(Transeformer::class, 'cb_no_id', 'id');
    }

    public function transe()
    {
        return $this->belongsTo(Transeformer::class, 'transe_id');
    }
}

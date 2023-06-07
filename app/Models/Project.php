<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'station',
        'top',
        'left',
        'descreption',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

}

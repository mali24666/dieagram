<?php

namespace App\Models;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes, Auditable, HasFactory;

    public $table = 'projects';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    public const typeSelecy = [
        '1' => 'station',
        '2' => 'down feeder',
        '3' => 'write feeder',
        '4' => 'transformer',
        '5' => 'ct',
        '6' => 'R-M-u',
        '7' => 'voltage regulator',
        '8' => 'section lazy ',
        '9' => 'auto recloser',


    ];

    protected $fillable = [
        'name_id',
        'station',
        'top',
        'left',
        'descreption',
        'transefer_id',
        'feeder_id',
        'second_feeder',
        'ct_id',
        'ct_postion',
        'rmu_id',
        'autorecloser_id',
        'sectionlazy_id',
        'avr_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function name()
    {
        return $this->belongsTo(Station::class, 'name_id');
    }

    public function transefer()
    {
        return $this->belongsTo(Transeformer::class, 'transefer_id');
    }

    public function feeder()
    {
        return $this->belongsTo(Line::class, 'feeder_id');
    }

    public function ct()
    {
        return $this->belongsTo(Ct::class, 'ct_id');
    }

    public function rmu()
    {
        return $this->belongsTo(Rmu::class, 'rmu_id');
    }

    public function autorecloser()
    {
        return $this->belongsTo(Autorecloser::class, 'autorecloser_id');
    }

    public function sectionlazy()
    {
        return $this->belongsTo(SectionLazy::class, 'sectionlazy_id');
    }

    public function avr()
    {
        return $this->belongsTo(Avr::class, 'avr_id');
    }
}

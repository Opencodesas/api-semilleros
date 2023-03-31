<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;

class Chronogram extends Model
{
    use SoftDeletes, HasFactory, LogsActivity;

    protected $table = "chronograms";

    protected $fillable = [
        'created_by',
        'month',
        'municipality',
        'note',
    ];

    protected $hidden = ['created_at', 'deleted_at', 'updated_at'];


    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }

    public function control_data(){
        return $this->morphMany(ControlChangeData::class,'data_model');
	}

    public function getPublishedAtAttribute(){
        return $this->created_at->format('Y-m-d');
    }

    public function mes(){
        return $this->hasOne(Months::class, 'id', 'month');
    }

    public function municipio(){
        return $this->hasOne(City::class, 'id', 'municipality');
    }

    public function estado(){
        return $this->hasOne(Status::class, 'slug', 'status');
    }

    public function groups(){
        return $this->hasMany(ChronogramsGroups::class, 'chronograms_id');
    }
}

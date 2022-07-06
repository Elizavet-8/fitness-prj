<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'level',
        'training_price',
        'problem_zone_id',
        'stripe_id'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'training_days' => 'array',
        'level' => 'integer',
        'training_price' => 'double',
        'problem_zone_id'=>'integer',
        'info'=>'array',
    ];
    public function days()
    {
        return $this->hasMany(\App\Models\Days::class);
    }

    public function trainingDays()
    {
        return $this->belongsTo(\App\Models\Days::class,"id","training_id");
    }

    public function problemZone()
    {
        return $this->belongsTo(\App\Models\ProblemZone::class);
    }

    public function trainingLocation()
    {
        return $this->belongsTo(\App\Models\TrainingLocation::class);
    }

    public function trainingUser()
    {
        return $this->belongsTo(\App\Models\TrainingUser::class);
    }
}

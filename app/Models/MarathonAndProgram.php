<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarathonAndProgram extends Model
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
        'price',
        'discount_price',
        'finish_date',
        'menu_id',
        'training_id',
        'about_trainings',
        'about_ration',
        'about_procedures',
        'about_support',
        'about_motivation'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'finish_date' => 'timestamp',
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function training()
    {
        return $this->belongsTo(Training::class);
    }
}

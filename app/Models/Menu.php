<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'menu_calories_id',
        'menu_content',
        'menu_price',
        'proteins',
        'fat',
        'carbs',
        'info',
        'stripe_id'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'menu_calories_id' => 'integer',
        'menu_content' => 'string',
        'menu_price' => 'double',
        'proteins' => 'double',
        'fat' => 'double',
        'carbs' => 'double',
        'info' => 'array',
    ];


    public function menuDays()
    {
        return $this->HasMany(\App\Models\MenuDays::class);
    }

    public function menuCalories()
    {
        return $this->belongsTo(\App\Models\MenuCalory::class);
    }
}

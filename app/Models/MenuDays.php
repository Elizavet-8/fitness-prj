<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuDays extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'menu_id',
        'day_number',
        'name',
        'description',
        'content',
        'info',
        'menu_type_id',
        'videos',
        'proteins',
        'fat',
        'carbs'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'menu_id' => 'integer',
        'content' => 'array',
        'info' => 'array',
        'menu_type_id' => 'integer',
        'videos' => 'array'
    ];



    public function menuType()
    {
        return $this->belongsTo(\App\Models\MenuType::class);
    }

    public function menu()
    {
        return $this->belongsTo(\App\Models\Menu::class);
    }
}

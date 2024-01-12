<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = ['kd_menu','nm_menu','id_cat_menu','id_kitchen_menu','satuan_menu','stok_menu','desc_menu','foto_menu'];

    // Get Data dari Table Category
    public function Category (): BelongsTo
    {
        return $this->belongsTo(Category::class,'id_cat_menu','id');
    }

    // Get Data dari Table Kitchen
    public function Kitchen(): BelongsTo
    {
        return $this->belongsTo(Kitchen::class,'id_kitchen_menu','id');
    }
}

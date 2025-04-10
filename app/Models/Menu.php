<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = ['name', 'price', 'stock', 'image_url', 'description'];

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'menu_order')->withPivot('jumlah');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'image',
    ];
    public $timestamps = true;
    // علاقة  لجلب المتاجر المتعلقة بكل فئة
    public function Stores()
    {
        return $this->hasMany('App\Models\Store', 'category_id');
    }
}

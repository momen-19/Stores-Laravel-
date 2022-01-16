<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;
    protected $fillable = [
        'ip',
        'rating',
        'store_id',
    ];
    public function Stores()
    {
        return $this->hasMany('App\Models\Store', 'store_id');
    }
}

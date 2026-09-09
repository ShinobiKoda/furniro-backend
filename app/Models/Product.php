<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function category(){
       return $this->belongsTo(Category::class);
    }

    public function reviews(){
        return $this->hasMany(Review::class);
    }

    public function scopeActive(Builder $query): void{
        $query->where('is_active', true);
    }
}

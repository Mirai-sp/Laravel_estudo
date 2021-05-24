<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable = [
        'name',
        'image',
        'description'
    ];

    protected $dates = [
        'deleted_at',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    protected static function booted() {
        static::creating(function ($category) {
            $category->slug = Str::slug($category->name);
        });

        static::updating(function ($category) {
            $category->slug = Str::slug($category->name);
        });
    }

    // protected function setNameAttribute($name) {        
    //     $this->attributes['name'] = $name;
    //     $this->attributes['slug'] = Str::slug($name);            
    // }

}

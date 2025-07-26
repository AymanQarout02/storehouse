<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'name',
        'description',
        'quantity',
        'price',
        'created_by',
        'media_id',
    ];
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function media()
    {
        return $this->belongsTo(Media::class, 'media_id');
    }

}

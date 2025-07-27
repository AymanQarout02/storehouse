<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Media extends BaseModel
{

    protected $fillable = [
        'file_name',
        'file_path',
        'file_type',
        'file_size',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function product()
    {
        return $this->hasOne(Product::class);
    }
}

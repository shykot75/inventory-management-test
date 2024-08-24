<?php

namespace App\Models;

use App\Enums\ProductEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = ProductEnum::DB_TABLE;
    protected $primaryKey = ProductEnum::ID;
    protected $fillable = ProductEnum::ALL_FIELDS;

    public function category()
    {
        return $this->belongsTo(Category::class, ProductEnum::CATEGORY_ID, 'category_id');
    }
    public function purchases()
    {
        return $this->hasMany(Purchase::class, 'product_id', 'product_id');
    }

}

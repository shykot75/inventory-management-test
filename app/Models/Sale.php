<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Enums\SalesEnum;

class Sale extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = SalesEnum::DB_TABLE;
    protected $primaryKey = SalesEnum::ID;
    protected $fillable = SalesEnum::ALL_FIELDS;

    /**
     * Relationship with Product.
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }

    /**
     * Relationship with Supplier.
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'customer_id');
    }
}

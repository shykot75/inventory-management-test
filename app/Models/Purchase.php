<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Enums\PurchaseEnum;

class Purchase extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = PurchaseEnum::DB_TABLE;
    protected $primaryKey = PurchaseEnum::ID;
    protected $fillable = PurchaseEnum::ALL_FIELDS;

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
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'supplier_id');
    }

}

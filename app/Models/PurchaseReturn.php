<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Enums\PurchaseReturnEnum;

class PurchaseReturn extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = PurchaseReturnEnum::DB_TABLE;
    protected $primaryKey = PurchaseReturnEnum::ID;
    protected $fillable = PurchaseReturnEnum::ALL_FIELDS;

    public function purchase()
    {
        return $this->belongsTo(Purchase::class, 'purchase_id', 'purchase_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }
}

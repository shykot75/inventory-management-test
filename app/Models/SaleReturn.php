<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Enums\SalesReturnEnum;

class SaleReturn extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = SalesReturnEnum::DB_TABLE;
    protected $primaryKey = SalesReturnEnum::ID;
    protected $fillable = SalesReturnEnum::ALL_FIELDS;

    public function purchase()
    {
        return $this->belongsTo(Sale::class, 'sale_id', 'sale_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }
}

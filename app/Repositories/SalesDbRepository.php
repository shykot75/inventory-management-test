<?php

namespace App\Repositories;

use App\Enums\ProductEnum;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleReturn;
use Illuminate\Support\Facades\DB;

class SalesDbRepository
{
    private Product $product;
    private Sale $sale;
    private SaleReturn $saleReturn;
    public function __construct()
    {
        $this->product = new Product();
        $this->sale = new Sale();
        $this->saleReturn = new SaleReturn();
    }

    public function getAllItem(): mixed
    {
        return  $this->sale
            ->whereNull('deleted_at')
            ->with([
                'product:product_id,product_name,quantity,product_price',
                'customer'
            ])
            ->latest()
            ->get();
    }

    public function storeData( array $data): mixed
    {
        return $this->sale->create($data);
    }

    public function getItemById(int $id): mixed
    {
        return $this->sale
            ->with([
                'product:product_id,product_name,quantity,product_price',
                'customer'
            ])
            ->whereNull('deleted_at')
            ->findOrFail($id);
    }


    public function getCustomerList(): mixed
    {
        return DB::table('customers')
            ->whereNull('deleted_at')
            ->select('customer_id', 'customer_name')
            ->get();
    }

    public function getReturnItemList(): mixed
    {
        return  $this->saleReturn
            ->whereNull('deleted_at')
            ->with([
                'product:product_id,product_name,quantity,product_price',
            ])
            ->latest()
            ->get();
    }

    public function storeReturnData( array $data): mixed
    {
        return $this->saleReturn->create($data);
    }

    public function updateSaleReturnStatus(int $saleId)
    {
        $sale = $this->sale->findOrFail($saleId);
        if ($sale) {
            $sale->update(['is_returned' => 1]); // Set is_returned to 1
        }
    }

    public function getSaleReturnItemById(int $id): mixed
    {
        return $this->saleReturn
            ->with([
                'product:product_id,product_name,quantity,product_price',
            ])
            ->whereNull('deleted_at')
            ->findOrFail($id);
    }




}

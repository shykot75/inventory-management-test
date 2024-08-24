<?php

namespace App\Repositories;

use App\Enums\ProductEnum;
use App\Models\Category;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseReturn;
use Illuminate\Support\Facades\DB;

class PurchaseDbRepository
{
    private Product $product;
    private Purchase $purchase;
    private PurchaseReturn $purchaseReturn;
    public function __construct()
    {
        $this->product = new Product();
        $this->purchase = new Purchase();
        $this->purchaseReturn = new PurchaseReturn();
    }

    public function getAllItem(): mixed
    {
        return  $this->purchase
            ->whereNull('deleted_at')
            ->with([
                'product:product_id,product_name,quantity,product_price',
                'supplier'
            ])
            ->latest()
            ->get();
    }

    public function storeData( array $data): mixed
    {
        return $this->purchase->create($data);
    }

    public function getItemById(int $id): mixed
    {
        return $this->purchase
            ->with([
                'product:product_id,product_name,quantity,product_price',
                'supplier'
            ])
            ->whereNull('deleted_at')
            ->findOrFail($id);
    }


    public function getSupplierList(): mixed
    {
        return DB::table('suppliers')
            ->whereNull('deleted_at')
            ->select('supplier_id', 'supplier_name')
            ->get();
    }

    public function getReturnItemList(): mixed
    {
        return  $this->purchaseReturn
            ->whereNull('deleted_at')
            ->with([
                'product:product_id,product_name,quantity,product_price',
            ])
            ->latest()
            ->get();
    }

    public function storeReturnData( array $data): mixed
    {
        return $this->purchaseReturn->create($data);
    }

    public function updatePurchaseReturnStatus(int $purchaseId)
    {
        $purchase = $this->purchase->findOrFail($purchaseId);
        if ($purchase) {
            $purchase->update(['is_returned' => 1]); // Set is_returned to 1
        }
    }

    public function getPurchaseReturnItemById(int $id): mixed
    {
        return $this->purchaseReturn
            ->with([
                'product:product_id,product_name,quantity,product_price',
            ])
            ->whereNull('deleted_at')
            ->findOrFail($id);
    }




}

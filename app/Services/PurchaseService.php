<?php

namespace App\Services;

use App\Enums\PurchaseEnum;
use App\Enums\PurchaseReturnEnum;
use App\Repositories\ProductDbRepository;
use App\Repositories\PurchaseDbRepository;
use Illuminate\Support\Facades\Hash;

class PurchaseService
{
    private PurchaseDbRepository $purchaseDbRepository;
    private ProductDbRepository $productDbRepository;


    public function __construct()
    {
        $this->purchaseDbRepository = new PurchaseDbRepository();
        $this->productDbRepository = new ProductDbRepository();
    }

    public function getItemList(): mixed
    {
        $result = $this->purchaseDbRepository->getAllItem();
        if (empty($result)){
            return [];
        }
        return $result;
    }

    public function storeItem(array $formData): mixed
    {
        $purchaseInfo = $this->purchaseDbRepository->storeData($formData);
        if (empty($purchaseInfo)){
            throw new \Exception('Purchase Information not stored. Invalid data format');
        }
        // Update product quantity if payment is paid
        if ($formData['payment_status'] == PurchaseEnum::PAYMENT_STATUS_PAID) {
            $this->productDbRepository->increaseQuantityForProductPurchase($purchaseInfo->product_id, $purchaseInfo->purchase_quantity);
        }

        return $purchaseInfo;
    }

    public function getItem(int $id): mixed
    {
        $result = $this->purchaseDbRepository->getItemById($id);
        if (empty($result)){
            return [];
        }
        return $result;
    }

    public function getSuppliers(): mixed
    {
        $result = $this->purchaseDbRepository->getSupplierList();
        if (empty($result)){
            return [];
        }
        return $result;
    }
    public function getProducts(): mixed
    {
        $result = $this->productDbRepository->getProductListForPurchase();
        if (empty($result)){
            return [];
        }
        return $result;
    }


    public function getReturnItemList(): mixed
    {
        $result = $this->purchaseDbRepository->getReturnItemList();
        if (empty($result)){
            return [];
        }
        return $result;
    }

    public function storeReturnItem(array $formData): mixed
    {
        $purchaseReturnInfo = $this->purchaseDbRepository->storeReturnData($formData);
        if (empty($purchaseReturnInfo)){
            throw new \Exception('Purchase Return Information not stored. Invalid data format');
        }
        // Update product quantity if payment is paid
        if ($formData['payment_status'] == PurchaseReturnEnum::PAYMENT_STATUS_PAID) {
            $this->productDbRepository->decreaseQuantityForPurchaseReturn($purchaseReturnInfo->product_id, $purchaseReturnInfo->return_quantity);
            // Update the purchase record to indicate the item has been returned
            $this->purchaseDbRepository->updatePurchaseReturnStatus($purchaseReturnInfo->purchase_id);
        }

        return $purchaseReturnInfo;
    }

    public function getPurchaseReturnItem(int $id): mixed
    {
        $result = $this->purchaseDbRepository->getPurchaseReturnItemById($id);
        if (empty($result)){
            return [];
        }
        return $result;
    }


}

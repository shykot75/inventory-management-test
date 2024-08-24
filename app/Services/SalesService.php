<?php

namespace App\Services;

use App\Enums\SalesEnum;
use App\Enums\SalesReturnEnum;
use App\Repositories\ProductDbRepository;
use App\Repositories\SalesDbRepository;
use Illuminate\Support\Facades\Hash;

class SalesService
{
    private SalesDbRepository $salesDbRepository;
    private ProductDbRepository $productDbRepository;


    public function __construct()
    {
        $this->salesDbRepository = new SalesDbRepository();
        $this->productDbRepository = new ProductDbRepository();
    }

    public function getItemList(): mixed
    {
        $result = $this->salesDbRepository->getAllItem();
        if (empty($result)){
            return [];
        }
        return $result;
    }

    public function storeItem(array $formData): mixed
    {
        $saleInfo = $this->salesDbRepository->storeData($formData);
        if (empty($saleInfo)){
            throw new \Exception('Sale Information not stored. Invalid data format');
        }
        // Update product quantity if payment is paid
        if ($formData['payment_status'] == SalesEnum::PAYMENT_STATUS_PAID) {
            $this->productDbRepository->decreaseQuantityForSaleReturn($saleInfo->product_id, $saleInfo->sale_quantity);
        }

        return $saleInfo;
    }

    public function getItem(int $id): mixed
    {
        $result = $this->salesDbRepository->getItemById($id);
        if (empty($result)){
            return [];
        }
        return $result;
    }

    public function getCustomers(): mixed
    {
        $result = $this->salesDbRepository->getCustomerList();
        if (empty($result)){
            return [];
        }
        return $result;
    }
    public function getProducts(): mixed
    {
        $result = $this->productDbRepository->getProductListForSale();
        if (empty($result)){
            return [];
        }
        return $result;
    }


    public function getReturnItemList(): mixed
    {
        $result = $this->salesDbRepository->getReturnItemList();
        if (empty($result)){
            return [];
        }
        return $result;
    }

    public function storeReturnItem(array $formData): mixed
    {
        $saleReturnInfo = $this->salesDbRepository->storeReturnData($formData);
        if (empty($saleReturnInfo)){
            throw new \Exception('Sale Return Information not stored. Invalid data format');
        }
        // Update product quantity if payment is paid
        if ($formData['payment_status'] == SalesReturnEnum::PAYMENT_STATUS_PAID) {
            $this->productDbRepository->increaseQuantityForProductSale($saleReturnInfo->product_id, $saleReturnInfo->return_quantity);
            // Update the sale record to indicate the item has been returned
            $this->salesDbRepository->updateSaleReturnStatus($saleReturnInfo->sale_id);
        }

        return $saleReturnInfo;
    }

    public function getSaleReturnItem(int $id): mixed
    {
        $result = $this->salesDbRepository->getSaleReturnItemById($id);
        if (empty($result)){
            return [];
        }
        return $result;
    }


}

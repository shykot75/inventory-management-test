<?php

namespace App\Services;

use App\Repositories\ProductDbRepository;
use Illuminate\Support\Facades\Hash;

class ProductService
{
    private ProductDbRepository $productDbRepository;


    public function __construct()
    {
        $this->productDbRepository = new ProductDbRepository();
    }

    public function getItemList(array $filterData): mixed
    {
        $result = $this->productDbRepository->getAllItem($filterData);
        if (empty($result)){
            return [];
        }
        return $result;
    }

    public function storeItem(array $formData): mixed
    {
       if(isset($formData['product_image'])){
           $formData['product_image'] = (new ImageService())->storeImage($formData['product_image']);
       }
        $result = $this->productDbRepository->storeData($formData);
        if (empty($result)){
            throw new \Exception('Invalid data format');
        }
        return $result;
    }

    public function getItem(int $id): mixed
    {
        $result = $this->productDbRepository->getItemById($id);
        if (empty($result)){
            return [];
        }
        return $result;
    }

    public function updateItem(array $formData, int $id): mixed
    {
        $product = $this->productDbRepository->getItemById($id);
        if (empty($product)){
            throw new \Exception('Invalid Product Information');
        }
        if(isset($formData['product_image'])){
            // Pass the new image and existing image path to updateImage
            $formData['product_image'] = (new ImageService())->updateImage($formData['product_image'], $product->product_image);
        }
        $result = $this->productDbRepository->updateData($formData, $id);
        if (empty($result)){
            throw new \Exception('Invalid data format');
        }
        return $result;
    }

    public function deleteItem(int $id): mixed
    {
        $result = $this->productDbRepository->deleteItem($id);
        if (empty($result)){
            throw new \Exception('Invalid data format');
        }
        return $result;
    }

    public function getCategories(): mixed
    {
        $result = $this->productDbRepository->getCategoryList();
        if (empty($result)){
            return [];
        }
        return $result;
    }

}

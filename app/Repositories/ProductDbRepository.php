<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\Product;

class ProductDbRepository
{
    private Product $product;
    private Category $category;
    public function __construct()
    {
        $this->product = new Product();
        $this->category = new Category();
    }

    public function getAllItem(array $filters=[]): mixed
    {
        $query = $this->product
            ->with('category')
            ->whereNull('deleted_at');
        $query = $this->getFilterQuery($query, $filters);

        // Default sorting if no specific sorting is requested
        if (empty($filters['product_price']) && empty($filters['quantity_order'])) {
            $query = $query->latest(); // Default to latest if no other sorting is specified
        }
        return $query->get();
    }
    private function getFilterQuery($query , array $filters=[])
    {
        if (!empty($filters['category_id'])){
            $query = $query->whereHas('category', function ($q) use ($filters) {
                $q->where('category_id', $filters['category_id']);
            });
        }
        if (!empty($filters['product_price'])) {
            $query = $query->orderBy('product_price', $filters['product_price']);
        }

        if (!empty($filters['quantity_order'])) {
            $query = $query->orderBy('quantity', $filters['quantity_order']);
        }
        return $query;
    }

    public function storeData( array $data): mixed
    {
        return $this->product->create($data);
    }

    public function getItemById(int $id): mixed
    {
        return $this->product
            ->with('category')
            ->whereNull('deleted_at')
            ->findOrFail($id);
    }

    public function updateData( array $data, int $id): mixed
    {
        return $this->product
            ->whereNull('deleted_at')
            ->findOrFail($id)
            ->update($data);
    }

    public function deleteItem(int $id): mixed
    {
        return $this->product
            ->whereNull('deleted_at')
            ->findOrFail($id)
            ->delete();
    }

    public function getCategoryList(): mixed
    {
        return $this->category
            ->whereNull('deleted_at')
            ->get();
    }



}

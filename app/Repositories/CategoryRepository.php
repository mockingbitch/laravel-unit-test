<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = $this->model = app()->make(Category::class);
    }

    // Tạo category
    public function storeCategory($data) : Category
    {
        $category = $this->model->create($data);

        return $category;
    }

    // Update category
    public function updateCategory($data, $category) : Category
    {
        $category->update($data);
        
        return $category;
    }

    // Show category
    public function showCategory($category_id) : Category
    {
        return $this->model->findOrFail($category_id);
    }

    // Destroy category
    public function destroyCategory($category) : bool
    {
        $this->model->delete();

        return true;
    }
}


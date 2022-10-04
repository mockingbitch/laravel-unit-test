<?php

namespace App\Repositories;

use App\Models\Brand;

class BrandRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = $this->model = app()->make(Brand::class);
    }

    // Tạo Brand
    public function storeBrand($data) : Brand
    {
        $brand = $this->model->create($data);

        return $brand;
    }

    // Update Brand
    public function updateBrand($data, $brand) : Brand
    {
        $brand->update($data);
        
        return $brand;
    }

    // Show brand
    public function showBrand($brand_id) :Brand
    {
        return $this->model->findOrFail($brand_id);
    }

    // Destroy brand
    public function destroyBrand($brand) : bool
    {
        $this->model->delete();

        return true;
    }
}


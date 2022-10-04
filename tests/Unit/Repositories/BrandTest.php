<?php

namespace Tests\Unit\Repositories;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Repositories\BrandRepository;
use App\Models\Brand;
use Faker\Factory as Faker;

class BrandTest extends TestCase
{
    protected $brand;

    public function setUp() : void
    {
        parent::setUp();
        $this->faker = Faker::create();
        $this->brand = [
            'name' => $this->faker->name,
            'description' => $this->faker->name,
        ];
        $this->brandRepository = new BrandRepository();
    }

     /**
     * A basic unit test store
     *
     * @return void
     */
    public function testStore()
    {
        $brand = $this->brandRepository->storeBrand($this->brand);
        $this->assertInstanceOf(Brand::class, $brand);
        $this->assertEquals($this->brand['name'], $brand->name);
        $this->assertEquals($this->brand['description'], $brand->description);
        $this->assertDatabaseHas('brands', $this->brand);
    }

    public function testShow()
    {
        $brand = Brand::factory()->create();
        $found = $this->brandRepository->showBrand($brand->id);
        $this->assertInstanceOf(Brand::class, $found);
        $this->assertEquals($found->name, $brand->name);
        $this->assertEquals($found->description, $brand->description);
    }

    public function testUpdate()
    {
       // Tạo dữ liệu mẫu
        $brand = Brand::factory()->create();
        $newBrand = $this->brandRepository->updateBrand($this->brand, $brand);
        // Kiểm tra dữ liệu trả về
        $this->assertInstanceOf(Brand::class, $newBrand);
        $this->assertEquals($newBrand->name, $this->brand['name']);
        $this->assertEquals($newBrand->description, $this->brand['description']);
        // Kiểm tra xem cơ sở dữ liệu đã được cập nhập hay chưa
        $this->assertDatabaseHas('brands', $this->brand);
    }

    public function testDestroy()
    {
        $brand = Brand::factory()->create();
        $deleteBrand = $this->brandRepository->destroyBrand($brand);
        // Kiểm tra dữ liệu có trả về true hay không
        $this->assertTrue($deleteBrand);
    }
}


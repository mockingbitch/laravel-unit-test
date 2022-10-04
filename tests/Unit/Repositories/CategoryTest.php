<?php

namespace Tests\Unit\Repositories;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Repositories\CategoryRepository;
use App\Models\Category;
use Faker\Factory as Faker;

class CategoryTest extends TestCase
{
    protected $category;

    public function setUp() : void
    {
        parent::setUp();
        $this->faker = Faker::create();
        $this->category = [
            'name' => $this->faker->name,
            'description' => $this->faker->name,
        ];
        $this->categoryRepository = new CategoryRepository();
    }

     /**
     * A basic unit test store
     *
     * @return void
     */
    public function testStore()
    {
        $category = $this->categoryRepository->storeCategory($this->category);
        $this->assertInstanceOf(Category::class, $category);
        $this->assertEquals($this->category['name'], $category->name);
        $this->assertEquals($this->category['description'], $category->description);
        $this->assertDatabaseHas('categories', $this->category);
    }

    public function testShow()
    {
        $category = Category::factory()->create();
        $found = $this->categoryRepository->showCategory($category->id);
        $this->assertInstanceOf(Category::class, $found);
        $this->assertEquals($found->name, $category->name);
        $this->assertEquals($found->description, $category->description);
    }

    public function testUpdate()
    {
       // Tạo dữ liệu mẫu
        $category = Category::factory()->create();
        $newCategory = $this->categoryRepository->updateCategory($this->category, $category);
        // Kiểm tra dữ liệu trả về
        $this->assertInstanceOf(Category::class, $newCategory);
        $this->assertEquals($newCategory->name, $this->category['name']);
        $this->assertEquals($newCategory->description, $this->category['description']);
        // Kiểm tra xem cơ sở dữ liệu đã được cập nhập hay chưa
        $this->assertDatabaseHas('categories', $this->category);
    }

    public function testDestroy()
    {
        $category = Category::factory()->create();
        $deleteCategory = $this->categoryRepository->destroyCategory($category);
        // Kiểm tra dữ liệu có trả về true hay không
        $this->assertTrue($deleteCategory);
    }
}


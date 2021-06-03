<?php

namespace Tests\Unit;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use PHPUnit\Framework\TestCase;

class CrudCategoryTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $category = Category::create(["name" => "Laptop", "is_publish" => true]);
        $this->assertDatabaseHas('category', [
            'name' => 'Laptop', 'is_publish' => true
        ]);
        Category::find($category->id)->update(["name" => "HP", "is_publish" => false]);
        $this->assertDatabaseHas('category', [
            'name' => 'HP', 'is_publish' => false
        ]);
        Category::destroy($category->id);
        $this->assertDatabaseMissing('category', [
            'name' => 'HP', 'is_publish' => false
        ]);
    }
}
<?php

namespace Tests\Feature;

use App\Models\Item;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ItemTest extends TestCase
{


    public function testItemHasTheCorrectFormat()
    {
        $itemT = Item::create(['name' => 'TEST', 'description' => 'TEST', 'price' => '109', 'image' => 'asdasdas']);
        $response = $this->json('GET', '/api/item/'.$itemT->id);
        $response->assertStatus(200);
        $response->assertJsonStructure(['id', 'name', 'description', 'image']);
    }

    public function testAllItemsHasTheCorrectFormat()
    {
        $response = $this->json('GET', '/api/item/all');
        $response->assertStatus(200);
        $response->assertJsonStructure(['items' =>[['id', 'name', 'description', 'image']]]);
    }

    public function testCreateStoreTheCorretValue()
    {
        $data = [
            'name' => "TEST", 
            "description" => "Nuevo test", 
            "price" => "19", 
            "image" => UploadedFile::fake()->image('imagen.png')
        ];
        $response = $this->json('POST', '/api/item/create', $data);
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'name' => $data["name"], 
            'description' => $data["description"], 
            'price'  => $data["price"]]);
    }

    public function testUpdateWithTheCorrectValue()
    {
        $itemT = Item::create(['name' => 'TEST', 'description' => 'TEST', 'price' => '109', 'image' => 'asdasdas']);
        $data = [
            'name' => "TEST", 
            "description" => "Nuevo test", 
            "price" => "19", 
            "image" => UploadedFile::fake()->image('imagen.png')
        ];
        $response = $this->json('PATCH', '/api/item/'.$itemT->id, $data);
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'name' => $data["name"], 
            'description' => $data["description"], 
            'price'  => $data["price"]]);
        $response->assertJsonMissing(['image' => $itemT->image]);
    }

    public function testDeleteCorrectItem()
    {
        $itemT = Item::create(['name' => 'TEST', 'description' => 'TEST', 'price' => '109', 'image' => 'asdasdas']);
        $response = $this->json('DELETE', '/api/item/'.$itemT->id);
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'name' => $itemT->name, 
            'description' => $itemT->description, 
            'price'  => $itemT->price
            ]
        );
    }


}

<?php

namespace Tests\Feature;

use App\Item;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ItemTest extends TestCase
{
    use DatabaseMigrations;

    protected function setUp()
    {
        parent::setUp();
        (new \DatabaseSeeder())->run(); // テストデータ登録
    }

    public function testIndex()
    {
        $response = $this->get('/api/items');

        $response->assertStatus(200);
        $this->assertCount(1, $response->json());
    }

    public function testIndexReturnsOnlyUncheckedItems()
    {
        $item = Item::query()->find(1);
        $item->checked = 1;
        $item->save();

        $response = $this->get('/api/items');

        $response->assertStatus(200);
        $this->assertCount(0, $response->json());
    }

    public function testShow()
    {
        $response = $this->get('/api/items/1');

        $response->assertStatus(200);
    }

    public function testStore()
    {
        $data = ['content' => 'ブログを書く'];
        $response = $this->post('/api/items', $data);

        $response->assertStatus(201);
        $response->assertJson($data);
        $item = Item::query()->find($response->json()['id']);
        $this->assertInstanceOf(Item::class, $item);
    }

    public function testUpdateContent()
    {
        $data = ['content' => 'ブログを書く'];
        $response = $this->patch('/api/items/1', $data);

        $response->assertStatus(200);
        $response->assertJson($data);
        $item = Item::query()->find(1);
        $this->assertSame('ブログを書く', $item->content);
    }

    public function testUpdateChecked()
    {
        $data = ['checked' => 1];
        $response = $this->patch('/api/items/1', $data);

        $response->assertStatus(200);
        $response->assertJson($data);
        $item = Item::query()->find(1);
        $this->assertEquals(true, $item->checked);
    }

    public function testDelete()
    {
        $response = $this->delete('/api/items/1');

        $response->assertStatus(200);
        $this->assertNull(Item::query()->find(1));
    }
}

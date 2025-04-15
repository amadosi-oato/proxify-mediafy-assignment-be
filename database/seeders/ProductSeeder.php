<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create(
            [
                'feed_product_id' => '1' ,
                'sku' => '12345',
                'name' => 'Product 1',
                'qty' => 10,
                'status' => 1,
                'visibility' => true,
                'price' => 100.00,
                'type_id' => 'simple',
                'description' => 'Product 1 description',
                'image' => 'https://picsum.photos/id/29/200/200',
                'tags' => ['tag1', 'tag2']
            ]
        );

        Product::create(
            [
                'feed_product_id' => '2' ,
                'sku' => '12346',
                'name' => 'Product 2',
                'qty' => 11,
                'status' => 1,
                'visibility' => true,
                'price' => 120.00,
                'type_id' => 'simple',
                'description' => 'Product 2 description',
                'image' => 'https://picsum.photos/id/298/200/200',
                'tags' => ['tag3', 'tag4']
            ]
        );

        Product::create(
            [
                'feed_product_id' => '3' ,
                'sku' => '12347',
                'name' => 'Product 3',
                'qty' => 0,
                'status' => 1,
                'visibility' => true,
                'price' => 90.00,
                'type_id' => 'simple',
                'description' => 'Product 3 description',
                'image' => 'https://picsum.photos/id/198/200/200',
                'tags' => ['tag5', 'tag6']
            ]
        );
        Product::create(
            [
                'feed_product_id' => '4' ,
                'sku' => '12348',
                'name' => 'Product 4',
                'qty' => 100,
                'status' => 1,
                'visibility' => false,
                'price' => 101.00,
                'type_id' => 'simple',
                'description' => 'Product 3 description',
                'image' => 'https://picsum.photos/id/98/200/200',
                'tags' => ['tag1', 'tag3']
            ]
        );
    }
}

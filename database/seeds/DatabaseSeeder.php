<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        	[
	            'username' => 'phamductrungbmt',
	            'email' => Str::random(10).'@gmail.com',
	            'password' => Hash::make('123123'),
	            'role' => 'MEMBER',
        	],
        	[
	            'username' => 'trungbmt',
	            'email' => Str::random(10).'@gmail.com',
	            'password' => Hash::make('123123'),
	            'role' => 'ADMIN',
        	],
            [
                'username' => 'hadestrb',
                'email' => Str::random(10).'@gmail.com',
                'password' => Hash::make('123123'),
                'role' => 'ADMIN',
            ],
        ]);
        DB::table('tbl_category')->insert([
            [
                'category_name' => 'Vest',
                'category_desc' => Str::random(200),
                'category_img' => 'category_image/default.png',
                'category_status' => '1',
            ],
            [
                'category_name' => 'Váy Cưới',
                'category_desc' => Str::random(200),
                'category_img' => 'category_image/default.png',
                'category_status' => '1',
            ],
            [
                'category_name' => 'Giầy Chú Rể',
                'category_desc' => Str::random(200),
                'category_img' => 'category_image/default.png',
                'category_status' => '1',
            ],
        ]);
        DB::table('tbl_product')->insert([
            [
                'product_category' => '1',
                'product_name' => 'Vest Nam 1',
                'product_desc' => Str::random(200),
                'product_img' => 'product_image/top-shop-ban-ao-vest-cho-nam-lich-lam-tai-thai-nguyen-thumb-828.jpg',
                'product_status' => '1',
            ],
            [
                'product_category' => '1',
                'product_name' => 'Vest Nam 2',
                'product_desc' => Str::random(200),
                'product_img' => 'product_image/ao-vest-cao-cap-xanh-den-av2l1089-6969.jpg',
                'product_status' => '1',
            ],
            [
                'product_category' => '1',
                'product_name' => 'Vest Nam 3',
                'product_desc' => Str::random(200),
                'product_img' => 'product_image/6274aef8b87512b6e276370c63be2b62.jpg',
                'product_status' => '1',
            ],
        ]);
        DB::table('tbl_product')->insert([
            [
                'product_category' => '2',
                'product_name' => 'Vay Cuoi 1',
                'product_desc' => Str::random(200),
                'product_img' => 'product_image/Odette1.jpg',
                'product_status' => '1',
            ],
            [
                'product_category' => '2',
                'product_name' => 'Vay Cuoi 2',
                'product_desc' => Str::random(200),
                'product_img' => 'product_image/vay-cuoi-01.jpg',
                'product_status' => '1',
            ],
            [
                'product_category' => '2',
                'product_name' => 'Vay Cuoi 3',
                'product_desc' => Str::random(200),
                'product_img' => 'product_image/cho-thue-vay-cuoi-caroline.jpg',
                'product_status' => '1',
            ],
        ]);
        DB::table('tbl_product_detail')->insert([
            [
                'product_id' => '1',
                'product_size' => 'M',
                'product_amount' => '5',
                'product_price' => '2000000',
            ],
            [
                'product_id' => '1',
                'product_size' => 'L',
                'product_amount' => '812',
                'product_price' => '6000000',
            ],
            [
                'product_id' => '1',
                'product_size' => 'X',
                'product_amount' => '12',
                'product_price' => '5000000',
            ],
            [
                'product_id' => '2',
                'product_size' => 'L',
                'product_amount' => '5',
                'product_price' => '200000',
            ],
            [
                'product_id' => '3',
                'product_size' => 'X',
                'product_amount' => '5',
                'product_price' => '1000000',
            ],
            [
                'product_id' => '4',
                'product_size' => 'XL',
                'product_amount' => '5',
                'product_price' => '100000',
            ],
            [
                'product_id' => '5',
                'product_size' => 'XXL',
                'product_amount' => '5',
                'product_price' => '5000000',
            ],
            [
                'product_id' => '6',
                'product_size' => 'S',
                'product_amount' => '5',
                'product_price' => '500000',
            ],
        ]);
    }
}

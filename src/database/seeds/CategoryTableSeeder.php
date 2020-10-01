<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'category_name' => '現金',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('category')->insert($param);

        $param = [
            'category_name' => '普通預金',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('category')->insert($param);

        $param = [
            'category_name' => 'クレジットカード',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('category')->insert($param);

        $param = [
            'category_name' => '食費',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('category')->insert($param);

        $param = [
            'category_name' => '日用品',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('category')->insert($param);

        $param = [
            'category_name' => '趣味・娯楽',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('category')->insert($param);

        $param = [
            'category_name' => '交通費',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('category')->insert($param);

        $param = [
            'category_name' => '交際費',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('category')->insert($param);

        $param = [
            'category_name' => '水光熱費',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('category')->insert($param);

        $param = [
            'category_name' => '通信費',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('category')->insert($param);

        $param = [
            'category_name' => '衣服・美容',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('category')->insert($param);

        $param = [
            'category_name' => '健康・医療',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('category')->insert($param);

        $param = [
            'category_name' => '車・住宅',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('category')->insert($param);

        $param = [
            'category_name' => '保険',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('category')->insert($param);

        $param = [
            'category_name' => '税・社会保障',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('category')->insert($param);

        $param = [
            'category_name' => 'その他',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('category')->insert($param);
    }
}

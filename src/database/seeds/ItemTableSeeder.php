<?php

use Illuminate\Database\Seeder;

class ItemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'user_id' => 1,
            'book_no' => 1,
            'debit_credit' => 2,
            'date' => '2020-01-01',
            'account_type' => 1,
            'category_id' => 1,
            'kubun_id' => null,
            'price' => 3000,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('items')->insert($param);

        $param = [
            'user_id' => 1,
            'book_no' => 1,
            'debit_credit' => 1,
            'date' => '2020-01-01',
            'account_type' => 2,
            'category_id' => 4,
            'kubun_id' => 8,
            'price' => 2000,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('items')->insert($param);

        $param = [
            'user_id' => 1,
            'book_no' => 1,
            'debit_credit' => 1,
            'date' => '2020-01-01',
            'account_type' => 2,
            'category_id' => 5,
            'kubun_id' => 12,
            'price' => 1000,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('items')->insert($param);


        $param = [
            'user_id' => 2,
            'book_no' => 2,
            'debit_credit' => 2,
            'date' => '2020-02-01',
            'account_type' => 1,
            'category_id' => 3,
            'kubun_id' => 3,
            'price' => 20000,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('items')->insert($param);

        $param = [
            'user_id' => 2,
            'book_no' => 2,
            'debit_credit' => 1,
            'date' => '2020-02-01',
            'account_type' => 2,
            'category_id' => 6,
            'kubun_id' => 11,
            'price' => 20000,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('items')->insert($param);


        $param = [
            'user_id' => 1,
            'book_no' => 3,
            'debit_credit' => 2,
            'date' => '2020-03-01',
            'account_type' => 1,
            'category_id' => 2,
            'kubun_id' => 1,
            'price' => 5000,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('items')->insert($param);

        $param = [
            'user_id' => 1,
            'book_no' => 3,
            'debit_credit' => 1,
            'date' => '2020-03-01',
            'account_type' => 2,
            'category_id' => 8,
            'kubun_id' => 1,
            'price' => 4000,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('items')->insert($param);

        $param = [
            'user_id' => 1,
            'book_no' => 3,
            'debit_credit' => 1,
            'date' => '2020-03-01',
            'account_type' => 2,
            'category_id' => 7,
            'kubun_id' => 22,
            'price' => 1000,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('items')->insert($param);


        $param = [
            'user_id' => 2,
            'book_no' => 4,
            'debit_credit' => 2,
            'date' => '2020-04-01',
            'account_type' => 1,
            'category_id' => 2,
            'kubun_id' => 1,
            'price' => 10000,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('items')->insert($param);

        $param = [
            'user_id' => 2,
            'book_no' => 4,
            'debit_credit' => 1,
            'date' => '2020-04-01',
            'account_type' => 2,
            'category_id' => 10,
            'kubun_id' => 32,
            'price' => 5000,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('items')->insert($param);


        $param = [
            'user_id' => 2,
            'book_no' => 4,
            'debit_credit' => 1,
            'date' => '2020-04-01',
            'account_type' => 2,
            'category_id' => 10,
            'kubun_id' => 33,
            'price' => 5000,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('items')->insert($param);

        $param = [
            'user_id' => 1,
            'book_no' => 5,
            'debit_credit' => 2,
            'date' => '2020-05-01',
            'account_type' => 1,
            'category_id' => 2,
            'kubun_id' => 2,
            'price' => 2000,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('items')->insert($param);

        $param = [
            'user_id' => 1,
            'book_no' => 5,
            'debit_credit' => 1,
            'date' => '2020-05-01',
            'account_type' => 2,
            'category_id' => 7,
            'kubun_id' => 21,
            'price' => 1000,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('items')->insert($param);

        $param = [
            'user_id' => 1,
            'book_no' => 5,
            'debit_credit' => 1,
            'date' => '2020-05-01',
            'account_type' => 2,
            'category_id' => 7,
            'kubun_id' => 22,
            'price' => 1000,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('items')->insert($param);

    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Run the table tables.
         **/
        // for ($i=1; $i <= 4; $i++) { 
        //     DB::table('tables')->insert([
        //         'name' => 'Bàn '.$i,
        //         'people_number' => 6,
        //         'status' => 0,
        //         'created_at' => date('Y-m-d H:i:s'),
        //         'updated_at' => date('Y-m-d H:i:s')
        //     ]);
        // }
        // for ($i=5; $i <= 6; $i++) { 
        //     DB::table('tables')->insert([
        //         'name' => 'Bàn '.$i,
        //         'people_number' => 10,
        //         'status' => 0,
        //         'created_at' => date('Y-m-d H:i:s'),
        //         'updated_at' => date('Y-m-d H:i:s')
        //     ]);
        // }
        // for ($i=7; $i <= 8; $i++) { 
        //     DB::table('tables')->insert([
        //         'name' => 'Bàn '.$i,
        //         'people_number' => 20,
        //         'status' => 0,
        //         'created_at' => date('Y-m-d H:i:s'),
        //         'updated_at' => date('Y-m-d H:i:s')
        //     ]);
        // }

        /**
         * Run the table category_menu.
         **/
        // DB::table('category_menu')->insert([
        //     'name' => 'Món Khai Vị',
        //     'created_at' => date('Y-m-d H:i:s'),
        //     'updated_at' => date('Y-m-d H:i:s')
        // ]);
        // DB::table('category_menu')->insert([
        //     'name' => 'Món Soup',
        //     'created_at' => date('Y-m-d H:i:s'),
        //     'updated_at' => date('Y-m-d H:i:s')
        // ]);

        /**
         * Run the table product.
         **/
        // DB::table('product')->insert([
        //     'name' => 'Chạo Tôm',
        //     'user_id' => 1,
        //     'category_id' => 1,
        //     'price' => 0,
        //     'thumbnail' => 'image',
        //     'description' => 'mô tả món ăn',
        //     'status' => 0,
        //     'created_at' => date('Y-m-d H:i:s'),
        //     'updated_at' => date('Y-m-d H:i:s')
        // ]);


        /**
         * Run the table schedule.
         **/
        // for ($i = 1; $i <= 31; $i++) {
        //     DB::table('schedule')->insert([
        //         'datework' => '2021-12-' . $i,
        //         'starttime' => '18',
        //         'endtime' => '22',
        //         'status' => 0,
        //         'note' => 'Chuẩn bị đồ ăn kĩ,lau chùi bàn ghế sạch sẽ',
        //         'created_at' => date('Y-m-d H:i:s'),
        //         'updated_at' => date('Y-m-d H:i:s')
        //     ]);
        // }

        /**
         * Run the table attendance.
         **/
        for ($i = 64; $i <= 93; $i++) {
            DB::table('attendance')->insert([
                'user_id' => 5,
                'schedule_id' => $i,
                'note' => 'báo đồ ca sau',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        }
    }
}

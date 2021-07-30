<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PaymentType;

class PaymentTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = [
            ['name' => 'Bkash', 'created_by' => 1, 'updated_by' => 1],
            ['name' => 'Nogod', 'created_by' => 1, 'updated_by' => 1],
            ['name' => 'Rocket', 'created_by' => 1, 'updated_by' => 1],
            ['name' => 'Dutch Bangla Bank', 'created_by' => 1, 'updated_by' => 1],
            ['name' => 'The City Bank', 'created_by' => 1, 'updated_by' => 1]
         ];

         foreach ($datas as $data) {
            PaymentType::create($data);
         }
    }
}

<?php

use Illuminate\Database\Seeder;

class ClientAddressesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        for ($i = 0; $i < 10; $i++) {
            DB::table('client_addresses')->insert([
                'client_id' => $this->getRandomClientId(),
                'street' => $faker->streetAddress,
                'zipcode' => $faker->randomNumber(6),
                'city' => $faker->city,
                'country' => $faker->country,
                'is_default' => 1,
                'created_at' => $faker->dateTime,
                'updated_at' => $faker->dateTime,
            ]);
        }
       
    }
    private function getRandomClientId() {
        $client = \App\Domains\Models\Client::inRandomOrder()->first();
        return $client->id;
    }
}

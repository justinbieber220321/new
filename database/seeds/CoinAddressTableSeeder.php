<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CoinAddressTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('coin_address')->truncate();
        $data = [
            ['address' => '3A4vqvNR7wd9H9sRVobD1MNhjKoGWFDWD5', 'currency' => 'BTC'],
            ['address' => '0xB72A70F232FDFD1Cfa87753fB4927fc2Ac9B25be', 'currency' => 'ETH'],
            ['address' => getAddressXrp(), 'currency' => 'XRP'],
        ];
        DB::table('coin_address')->insert($data);
    }
}
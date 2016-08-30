<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Rate;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(RateSeeder::class);
    }
}

class RateSeeder extends Seeder {
    public function run(){
        DB::table('rates')->delete();

        $date_begin = '0000-00-00';
        $date_end = '27777-12-31';
//        $date_end = date('Y-m-d');
        $max_rate = 8.0;
        $min_rate = 27.0;
        $date = $date_begin;
        while($date <= $date_end){
            $date = date('Y-m-d', strtotime($date.' + 1 days'));
            DB::table('rates')->insert([
                'usd_buy' => $this->rand_rate($max_rate, $min_rate),
                'usd_sell' => $this->rand_rate($max_rate, $min_rate),
                'rub_buy' => $this->rand_rate($max_rate, $min_rate),
                'rub_sell' => $this->rand_rate($max_rate, $min_rate),
                'eur_buy' => $this->rand_rate($max_rate, $min_rate),
                'eur_sell' => $this->rand_rate($max_rate, $min_rate),
                'date' => $date
            ]);
        }
    }
    protected function rand_rate($max,$min){
        $range = $max-$min;
        $num = $min + $range * mt_rand(0, 32767)/32767;
        $num = round($num, 2);
        return ((float) $num);
    }
}
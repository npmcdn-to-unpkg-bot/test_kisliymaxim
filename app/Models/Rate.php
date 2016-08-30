<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    public function getRandomRate(){
        for($i=0;$i<3;$i++){
            $rand[] = rand(50000,1500000);
        }
        $rates = $this->whereIn('id', $rand)->get();
//        $all_rate = $this->where('id','=', 123456)->get();
        return $rates->toArray();
    }
    public function getRate($day,$month,$year){
        $str=$year.'-'.$month.'-'.$day;
        $rates = $this->where('date', $str)->get();
        return $rates->toArray();
    }

}

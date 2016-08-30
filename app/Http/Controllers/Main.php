<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Rate;
use App\Models\Save;

class Main extends Controller
{
    public function index(Rate $rateModel){
        $rates = $rateModel->getRandomRate();
//        var_dump($rates);
        return view('main', ['rates' => $rates]);
    }
    public function getRate(Rate $rateModel){
        if(isset($_GET['day']) && isset($_GET['month']) && isset($_GET['year'])) {
            $rates = $rateModel->getRate($_GET['day'],$_GET['month'],$_GET['year']);
            echo json_encode($rates[0]);
        }
        else{
            echo false;
        }
    }
    public function addToSaves(Save $saveModel)
    {
        if (isset($_GET['usd_buy'])) {
            $set['usd_buy']=$_GET['usd_buy'];
            $set['usd_sell']=$_GET['usd_sell'];
            $set['rub_buy']=$_GET['rub_buy'];
            $set['rub_sell']=$_GET['rub_sell'];
            $set['eur_buy']=$_GET['eur_buy'];
            $set['eur_sell']=$_GET['eur_sell'];
            $set['date']=$_GET['date'];
            $status = $saveModel->add($set);
            echo $status;
        } else {
            echo 'false';
        }
    }
}

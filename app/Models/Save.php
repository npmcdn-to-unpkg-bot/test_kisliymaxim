<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Save extends Model
{
    public function add($set){
        $status = $this->insert($set);
        return $status;
    }
}

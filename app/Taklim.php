<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Taklim extends Model
{
    protected $table = 'taklim';
    protected $guarded = [];

    public function setTanggalAtribute($value){
    	$this->attribute['tanggal'] = date("Y-m-d",strtotime($value));
    }
}
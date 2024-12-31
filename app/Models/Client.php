<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = "client_id";
    public function order(){
        return $this->hasMany(Order::class,'client_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cart extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = "cart_id";
    protected $fillable = [
        'pro_id',
        'client_id',
        'is_watchlist',
    ];
    public function product()
    {
        return $this->belongsTo(Product::class, 'pro_id'); // 'pro_id' is the foreign key in the cart table
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id'); // 'client_id' is the foreign key in the cart table
    }
    public function orders()
    {
        return $this->hasMany(Order::class,'order_id');
    }

    
}

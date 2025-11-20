<?php

namespace App\Models;

use App\Models\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'nama',
        'no_telepon',
        'alamat',
        'nama_perusahaan',
    ];

    public function order()
    {
        return $this->hasMany(Order::class, 'customer_id');
    }
}

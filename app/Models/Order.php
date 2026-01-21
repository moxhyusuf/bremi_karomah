<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Customer;
use App\Models\Delivery;
use App\Models\Material;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Order extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'customer_id',
        'kode',
        'tipe',
        'jumlah',
        'warna',
        'ukuran',
        'posisi',
        'status',
        'catatan',
    ];

    public const ORDER_TYPE = ['sablon', 'bordir'];
    public const ORDER_STATUS = ['pending', 'proses', 'selesai', 'retur'];

    protected function createdAtFormatted(): Attribute
    {
        return Attribute::get(fn() => Carbon::parse($this->created_at)->format('d/m/Y'));
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function material()
    {
        return $this->hasMany(Material::class, 'order_id');
    }

    public function delivery()
    {
        return $this->hasMany(Delivery::class, 'order_id');
    }
}

<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Material extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'order_id',
        'nama_item',
        'jumlah_diterima',
    ];

    protected function createdAtFormatted(): Attribute
    {
        return Attribute::get(fn() => Carbon::parse($this->created_at)->format('d/m/Y'));
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}

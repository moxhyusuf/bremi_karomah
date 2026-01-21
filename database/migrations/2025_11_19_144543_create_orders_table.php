<?php

use App\Models\Order;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers');
            $table->string('kode')->unique();
            $table->enum('tipe', Order::ORDER_TYPE);
            $table->integer('jumlah');
            $table->string('warna');
            $table->string('ukuran');
            $table->string('posisi');
            $table->enum('status', Order::ORDER_STATUS)->default(Order::ORDER_STATUS[0]);
            $table->string('catatan')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nota');
            $table->uuid('user_id')->nullable(false);
            $table->foreign('user_id')->references('id')->on('users');
            $table->uuid('obat_id')->nullable(false);
            $table->foreign('obat_id')->references('id')->on('obats');
            $table->string('jumlah');
            $table->string('total_harga');
            $table->string('status');
            $table->boolean('delete_at')->default(0)->change();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksis');
    }
}

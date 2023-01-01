<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('obats', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nama');
            $table->string('stok');
            $table->string('harga');
            $table->string('foto');
            $table->string('status');
            $table->uuid('kategori_id')->nullable(false);
            $table->foreign('kategori_id')->references('id')->on('kategoris');
            $table->uuid('supplier_id')->nullable(false);
            $table->foreign('supplier_id')->references('id')->on('suppliers');
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
        Schema::dropIfExists('obats');
    }
}

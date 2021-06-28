<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDaprosEdukasiPelanggan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('edukasi_pelanggan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('witel_str')->nullable();
            $table->string('nama_pelanggan')->nullable();
            $table->string('alamat')->nullable();
            $table->string('notel')->nullable();
            $table->string('paket_inet');
            $table->string('no_hp')->nullable();
            $table->string('email')->nullable();
            $table->string('status_svm')->nullable();
            $table->timestamp('valid_from')->nullable();
            $table->string('nper')->nullable();
            $table->string('payment_date')->nullable();
            $table->integer('status')->default(0);
            $table->timestamp('tgl_psb')->nullable();
            $table->string('paket_psb')->nullable();
            $table->string('nohp_pcf')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dapros_edukasi_pelanggan');
    }
}

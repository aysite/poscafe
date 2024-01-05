<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('kd_cus',20);
            $table->string('nm_cus',50);
            $table->string('alamat_cus',100);
            $table->string('telp_cus',15)->nullable();
            $table->smallInteger('poin_cus');
            $table->smallInteger('user_id_cus')->default(0);
            $table->smallInteger('status_cus')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};

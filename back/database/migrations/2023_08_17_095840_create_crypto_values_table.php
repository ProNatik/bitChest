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
        Schema::create('crypto_values', function (Blueprint $table) {
            $table->id();
            $table->integer('value');
            $table->timestamp('date')->useCurrent();
            //foreign key
            $table->unsignedBigInteger('crypto_id')->nullable(false);
            $table->foreign('crypto_id')->references('id')->on('cryptos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crypto_values');
    }
};

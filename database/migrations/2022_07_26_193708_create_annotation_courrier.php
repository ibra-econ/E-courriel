<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('annotation_courrier', function (Blueprint $table) {
            $table->unsignedBigInteger('courrier_id');
            $table->foreign('courrier_id')->references('id')->on('courriers')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('annotation_id');
            $table->foreign('annotation_id')->references('id')->on('annotations')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('annotation_courrier');
    }
};

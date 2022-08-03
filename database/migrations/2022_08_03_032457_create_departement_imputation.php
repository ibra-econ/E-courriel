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
        Schema::create('departement_imputation', function (Blueprint $table) {
            $table->unsignedBigInteger('imputation_id');
            $table->foreign('imputation_id')->references('id')->on('imputations')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('departement_id');
            $table->foreign('departement_id')->references('id')->on('departements')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('departement_imputation');
    }
};

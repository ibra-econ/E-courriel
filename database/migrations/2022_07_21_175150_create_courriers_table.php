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
        Schema::create('courriers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('nature_id');
            $table->foreign('nature_id')->references('id')->on('natures')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('correspondant_id');
            $table->foreign('correspondant_id')->references('id')->on('correspondants')->onUpdate('cascade')->onDelete('cascade');
            $table->string('type');
            $table->string('reference');
            $table->string('numero');
            $table->string('objet');
            $table->string('priorite');
            $table->string('confidentiel');
            $table->string('etat');
            $table->date('date');
            $table->date('date_arriver');
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
        Schema::dropIfExists('courriers');
    }


};

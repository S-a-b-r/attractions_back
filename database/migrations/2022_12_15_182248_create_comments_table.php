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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_author');
            $table->unsignedBigInteger('id_attraction');
            $table->string('title');
            $table->text('text');
            $table->timestamps();

            $table->foreign('id_author')->references('id')->on('users');
            $table->foreign('id_attraction')->references('id')->on('attractions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('comments');
        Schema::enableForeignKeyConstraints();
    }
};

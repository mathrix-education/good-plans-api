<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('lastname')->nullable();
            $table->string('firstname')->nullable();
            $table->string('email');
            $table->string('password');
            $table->string('scopes')->default('[]');
            $table->timestamp('birthdate')->nullable();
            $table->string('city')->nullable();
            $table->json('universities')->nullable();
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
        Schema::dropIfExists('users');
    }
}

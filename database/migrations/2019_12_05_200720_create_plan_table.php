<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('link')->nullable();
            $table->unsignedBigInteger('institution_id');
            $table->date('starting_at')->nullable();
            $table->date('ending_at')->nullable();
            $table->json('cities');
            $table->json('categories');
            $table->json('filters');
            $table->string('video_id')->nullable();
            $table->timestamps();

            // Foreign keys
            $table->foreign('institution_id')->references('id')->on('institutions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('good_plan');
    }
}

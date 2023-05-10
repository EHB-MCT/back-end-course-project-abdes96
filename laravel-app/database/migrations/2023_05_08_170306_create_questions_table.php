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
        Schema::create('questions', function (Blueprint $table) {

                $table->id();
                $table->string('question');
                $table->integer('score');
                $table->foreignId('lists_id')->constrained('lists')->onDelete('cascade');
                $table->timestamps();
            });
    }

    /**
     * Reverse the mig²rations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions');

    }
};

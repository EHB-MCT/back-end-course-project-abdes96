<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('lists', function (Blueprint $table) {
            $table->boolean('completed')->default(false);
            $table->string('client')->nullable();
            $table->string('client')->nullable();

        });
    }

    public function down()
    {
        Schema::table('lists', function (Blueprint $table) {
            $table->dropColumn('completed');
            $table->dropColumn('client');
        });
    }
};

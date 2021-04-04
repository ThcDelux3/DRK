<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDrkserverDataToUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->string('vorname');
            $table->string('nachname');
            $table->string('organisation')->nullable();
            $table->string('personalnummer')->nullable();
            $table->date('geburtsdatum')->nullable();
            $table->string('qualifiaktion')->nullable();
            $table->string('pin', 6)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('nachname');
            $table->dropColumn('vorname');
            $table->dropColumn('organisation');
            $table->dropColumn('personalnummer');
            $table->dropColumn('geburtsdatum');
            $table->dropColumn('qualifiaktion');
            $table->dropColumn('pin');
            $table->string('name');
        });
    }
}

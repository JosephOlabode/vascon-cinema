<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyToShowtimes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('showtime', function (Blueprint $table) {
            $table->unsignedBigInteger('cinema_id');
            $table->unsignedBigInteger('movie_id');

            $table->foreign('cinema_id')->references('id')
                ->on('cinemas')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('movie_id')->references('id')
                ->on('movies')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('showtime', function (Blueprint $table) {
            $table->dropForeign('showtime_cinema_id_foreign');
            $table->dropIndex('showtime_cinema_id_foreign');
            $table->dropForeign('showtime_movie_id_foreign');
            $table->dropIndex('showtime_movie_id_foreign');
        });

        Schema::table('showtime', function (Blueprint $table) {
            $table->dropColumn('cinema_id');
            $table->dropColumn('movie_id');
        });
    }
}

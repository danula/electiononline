<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimestamps extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::table('results', function($table)
        {
            $table->timestamps();
        });
        Schema::table('results_d', function($table)
        {
            $table->timestamps();
        });
        Schema::table('seats', function($table)
        {
            $table->timestamps();
        });
        Schema::table('seat_results', function($table)
        {
            $table->timestamps();
        });
        Schema::table('districts', function($table)
        {
            $table->timestamps();
        });
        Schema::table('district_results', function($table)
        {
            $table->timestamps();
        });
        Schema::table('candidates', function($table)
        {
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
		//
	}

}

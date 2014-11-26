<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

        Schema::create('districts', function($table)
        {
            $table->increments('id');
            $table->string('name');
        });

        Schema::create('seats', function($table)
        {
            $table->increments('id');
            $table->integer('district_id')->unsigned();
            $table->foreign('district_id')->references('id')->on('districts');
            $table->string('name');
        });

        Schema::create('seat_results', function($table)
        {
            $table->increments('id');
            $table->integer('year');
            $table->integer('seat_id')->unsigned();
            $table->foreign('seat_id')->references('id')->on('seats');
            $table->integer('polled_votes')->unsigned();
            $table->integer('rejected_votes')->unsigned();
            $table->integer('registered_votes')->unsigned();
            $table->integer('valid_votes')->unsigned();
        });

        Schema::create('district_results', function($table)
        {
            $table->increments('id');
            $table->integer('year');
            $table->integer('district_id')->unsigned();
            $table->foreign('district_id')->references('id')->on('districts');
            $table->integer('polled_votes')->unsigned();
            $table->integer('rejected_votes')->unsigned();
            $table->integer('registered_votes')->unsigned();
            $table->integer('valid_votes')->unsigned();
        });


        Schema::create('candidates', function($table)
        {
            $table->increments('id');
            $table->integer('year');
            $table->string('name');
            $table->string('photo');
            $table->string('logo');
            $table->string('party');
            $table->integer('number_of_votes')->unsigned();
        });


        Schema::create('results', function($table)
        {
            $table->increments('id');
            $table->integer('year');
            $table->integer('seat_id')->unsigned();
            $table->foreign('seat_id')->references('id')->on('seats');
            $table->integer('candidate_id')->unsigned();
            $table->foreign('candidate_id')->references('id')->on('candidates');
            $table->integer('number_of_votes')->unsigned();
        });

        Schema::create('results_d', function($table)
        {
            $table->increments('id');
            $table->integer('year');
            $table->integer('district_id')->unsigned();
            $table->foreign('district_id')->references('id')->on('districts');
            $table->integer('candidate_id')->unsigned();
            $table->foreign('candidate_id')->references('id')->on('candidates');
            $table->integer('number_of_votes')->unsigned();
        });


    }

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('results');
        Schema::drop('results_d');
        Schema::drop('candidates');
        Schema::drop('seat_results');
        Schema::drop('district_results');
        Schema::drop('seats');
        Schema::drop('districts');
	}

}

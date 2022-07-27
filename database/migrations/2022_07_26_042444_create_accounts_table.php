<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->string('sr_code', 20)->unique()->nullable();
            $table->string('gsuite_email', 100)->primary()->unique();
            $table->string('email', 255)->unique()->nullable();
            $table->string('contact', 20)->unique()->nullable();

            $table->string('first_name', 50)->nullable();
            $table->string('middle_name', 50)->nullable();
            $table->string('last_name', 50)->nullable();

            $table->date('birth_date')->nullable();
            $table->string('gender', 20)->nullable();
            $table->string('civil_status', 20)->nullable();
            $table->string('religion', 100)->nullable();

            $table->string('home_brgy', 150)->nullable();
            $table->string('home_mun', 150)->nullable();
            $table->string('home_prov', 150)->nullable();

            $table->string('birth_brgy', 150)->nullable();
            $table->string('birth_mun', 150)->nullable();
            $table->string('birth_prov', 150)->nullable();

            $table->string('dorm_brgy', 150)->nullable();
            $table->string('dorm_mun', 150)->nullable();
            $table->string('dorm_prov', 150)->nullable();
            $table->string('classification', 20)->nullable();
            $table->string('acc_type', 20);
            $table->string('password', 100);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accounts');
    }
}

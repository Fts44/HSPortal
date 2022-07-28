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
            $table->string('gsuite_email', 100)->primary();
            $table->string('email', 255)->unique()->nullable();
            $table->string('contact', 20)->unique()->nullable();

            $table->string('first_name', 50)->nullable();
            $table->string('middle_name', 50)->nullable();
            $table->string('last_name', 50)->nullable();

            $table->date('birth_date')->nullable();
            $table->string('gender', 20)->nullable();
            $table->string('civil_status', 20)->nullable();
            $table->string('religion', 100)->nullable();

            $table->string('home_address_id', 10)->nullable()->unique();
            $table->string('birth_address_id', 10)->nullable()->unique();
            $table->string('dorm_adress_id', 10)->nullable()->unique();
           
            $table->string('classification', 20)->nullable();
            $table->string('profile_pic', 255)->nullable();
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

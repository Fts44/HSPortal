<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

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
            $table->id();
            $table->string('sr_code', 20)->unique()->nullable();
            $table->string('gsuite_email', 100)->unique()->nullable();
            $table->string('email', 255)->unique()->nullable();
            $table->string('contact', 20)->unique()->nullable();

            $table->string('first_name', 50)->nullable();
            $table->string('middle_name', 50)->nullable();
            $table->string('last_name', 50)->nullable();
            $table->string('suffix_name', 50)->nullable();

            $table->date('birthdate')->nullable();
            $table->string('gender', 20)->nullable();
            $table->string('civil_status', 20)->nullable();
            $table->string('religion', 100)->nullable();

            $table->integer('home_address_id')->nullable();
            $table->integer('birth_address_id')->nullable();
            $table->integer('dorm_address_id')->nullable();

            $table->string('classification')->nullable();
            $table->string('position')->nullable();
            $table->integer('gl_id')->nullable();
            $table->integer('dept_id')->nullable();
            $table->integer('prog_id')->nullable();
            $table->integer('emergency_contact_id')->nullable()->unique();
            $table->string('profile_pic', 255)->nullable();
            $table->string('password', 100);
            $table->boolean('is_verified')->default(0);
            $table->dateTime('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            
            // $table->string('home_prov', 50)->nullable();
            // $table->string('home_mun', 50)->nullable();
            // $table->string('home_brgy', 50)->nullable();

            // $table->string('birth_prov', 50)->nullable();
            // $table->string('birth_mun', 50)->nullable();
            // $table->string('birth_brgy', 50)->nullable();

            // $table->string('dorm_prov', 50)->nullable();
            // $table->string('dorm_mun', 50)->nullable();
            // $table->string('dorm_brgy', 50)->nullable();

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

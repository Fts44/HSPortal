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
            $table->string('sr_code', 20)->unique()->nullable();
            $table->string('gsuite_email', 100)->unique()->nullable();
            $table->string('email', 255)->unique()->nullable();
            $table->string('contact', 20)->unique()->nullable();

            $table->string('first_name', 50)->nullable();
            $table->string('middle_name', 50)->nullable();
            $table->string('last_name', 50)->nullable();

            $table->date('birth_date')->nullable();
            $table->string('gender', 20)->nullable();
            $table->string('civil_status', 20)->nullable();
            $table->string('religion', 100)->nullable();

            $table->string('home_prov', 50)->nullable();
            $table->string('home_mun', 50)->nullable();
            $table->string('home_brgy', 50)->nullable();

            $table->string('birth_prov', 50)->nullable();
            $table->string('birth_mun', 50)->nullable();
            $table->string('birth_brgy', 50)->nullable();

            $table->string('dorm_prov', 50)->nullable();
            $table->string('dorm_mun', 50)->nullable();
            $table->string('dorm_brgy', 50)->nullable();
           
            $table->string('classification', 20)->nullable();
            $table->string('position', 20)->nullable();
            $table->string('grade_level', 20)->nullable();
            $table->string('department', 20)->nullable();
            $table->string('program', 20)->nullable();
            $table->string('emergency_contact_id', 20)->nullable()->unique();
            $table->string('profile_pic', 255)->nullable();
            $table->string('password', 100);
            $table->boolean('is_verified')->default(0);
            $table->dateTime('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
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

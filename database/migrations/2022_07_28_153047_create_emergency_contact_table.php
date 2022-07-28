<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmergencyContactTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emergency_contact', function (Blueprint $table) {
            $table->increments('id');
            $table->string('emerg_fn',50);
            $table->string('emerg_mn',50);
            $table->string('emerg_ln',50);
            $table->string('relation_to_patient',50);
            $table->string('landline',50);
            $table->string('contact',50);
            $table->string('biz_address',10)->unique();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('emergency_contact');
    }
}

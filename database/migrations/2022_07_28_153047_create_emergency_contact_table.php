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
            $table->id();
            $table->string('first_name',50);
            $table->string('middle_name',50);
            $table->string('last_name',50);
            $table->string('relation',50);
            $table->string('landline',50);
            $table->string('contact',50);
            $table->string('biz_prov', 50);
            $table->string('biz_mun', 50);
            $table->string('biz_brgy', 50);
        });

        return redirect()->back()->withInput($request->all());
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

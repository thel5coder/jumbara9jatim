<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableParticipant extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participants', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('contingent_id');
            $table->string('participant_id');
            $table->string('mis',20);
            $table->string('full_name',50);
            $table->string('birth_place');
            $table->string('birth_date');
            $table->enum('sex',['Laki - laki','Perempuan']);
            $table->enum('religion',['Islam','Kristen','Katholik','Hindu','Budha']);
            $table->text('address');
            $table->string('phone',20);
            $table->enum('group_member',['Pengurus PMI','Staf PMI','Pembina PMR','Fasilitator PMR','PMR']);
            $table->integer('position_id');
            $table->string('email');
            $table->string('photograph');
            $table->string('ansurance');
            $table->string('mis_image');
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
        Schema::dropIfExists('participants');
    }
}

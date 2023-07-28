<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prescriptions', function (Blueprint $table) {
            $table->increments('id');
            $table->foreignId('appointment_id')->constrained('appointments')
            ->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('medicine_id')->constrained('medicines')
            ->onUpdate('cascade')->onDelete('set null');
            $table->string('code');
            $table->string('symptom')->nullable();
            $table->string('diagnosis')->nullable();
            $table->string('advice')->nullable();
            $table->string('usage')->nullable();
            $table->integer('total_days');
            $table->integer('morning');
            $table->integer('noon');
            $table->integer('afternoon');
            $table->integer('night');
            $table->date('date');
            $table->string('slug');
            $table->boolean('is_delete')->default(0);
            $table->softDeletes();
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
        Schema::dropIfExists('prescriptions');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->increments('id');
            $table->foreignId('patient_id')->constrained('users')
                ->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('doctor_id')->constrained('users')
                ->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('qr_id')->constrained('qr_codes')
                ->onUpdate('cascade')->onDelete('set null');
            $table->string('code');
            $table->date('date');
            $table->datetime('time');
            $table->string('note')->nullable();
            $table->boolean('test_status')->default(0);
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('appointments');
    }
}

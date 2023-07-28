<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCaseHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('case_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->foreignId('appointment_id')->constrained('appointments')
            ->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('test_id')->nullable()->constrained('tests')
            ->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('prescription_id')->nullable()->constrained('prescriptions')
            ->onUpdate('cascade')->onDelete('set null');
            $table->string('code');
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
        Schema::dropIfExists('case_histories');
    }
}

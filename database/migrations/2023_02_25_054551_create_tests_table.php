<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tests', function (Blueprint $table) {
            $table->increments('id');
            $table->foreignId('appointment_id')->constrained('appointments')
                ->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('test_type_id')->constrained('test_types')
                ->onUpdate('cascade')->onDelete('set null');
            $table->string('note')->nullable();
            $table->string('result');
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
        Schema::dropIfExists('tests');
    }
}

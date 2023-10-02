<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateColumnsOnPrescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('prescriptions', function (Blueprint $table) {
            //Add
            $table->string('name')->after('id');
            $table->integer('patient_id')->after('name');
            $table->integer('doctor_id')->after('patient_id');
            $table->text('detail')->after('code');

            //Drop
            $table->dropColumn('symptom');
            $table->dropColumn('diagnosis');
            $table->dropColumn('advice');
            $table->dropColumn('usage');
            $table->dropColumn('total_days');
            $table->dropColumn('morning');
            $table->dropColumn('noon');
            $table->dropColumn('afternoon');
            $table->dropColumn('night');
            $table->dropColumn('date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('prescriptions', function (Blueprint $table) {
            //Drop
            $table->dropColumn('name');
            $table->dropColumn('patient_id');
            $table->dropColumn('doctor_id');
            $table->dropColumn('detail');

            //Add
            // $table->string('symptom')->nullable();
            // $table->string('diagnosis')->nullable();
            // $table->string('advice')->nullable();
            // $table->string('usage')->nullable();
            // $table->integer('total_days');
            // $table->integer('morning');
            // $table->integer('noon');
            // $table->integer('afternoon');
            // $table->integer('night');
            // $table->date('date');
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSatisfactoryMarkToExamEnrollsTable extends Migration
{
    public function up()
    {
        Schema::table('exam_enrolls', function (Blueprint $table) {
            $table->string('satisfactory_mark')->nullable()->after('merit_position');
        });
    }

    public function down()
    {
        Schema::table('exam_enrolls', function (Blueprint $table) {
            $table->dropColumn('satisfactory_mark');
        });
    }
}

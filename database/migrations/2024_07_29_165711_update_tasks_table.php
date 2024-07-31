<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTasksTable extends Migration
{
    public function up()
    {
        // Schema::table('tasks', function (Blueprint $table) {
        //     $table->foreignId('task_to')->constrained('projects')->onDelete('cascade')->after('task_description');
        // });
    }

    public function down()
    {
        // Schema::table('tasks', function (Blueprint $table) {
        //     $table->dropForeign(['task_to']);
        //     $table->dropColumn('task_to');
        // });
    }
}

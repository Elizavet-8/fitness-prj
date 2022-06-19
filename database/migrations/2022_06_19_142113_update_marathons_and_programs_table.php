<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateMarathonsAndProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('marathon_and_programs', function (Blueprint $table) {
            $table->unsignedBigInteger('menu_id');
            $table->unsignedBigInteger('training_id');
            $table->string('about_trainings')->nullable();
            $table->string('about_ration')->nullable();
            $table->string('about_procedures')->nullable();
            $table->string('about_support')->nullable();
            $table->string('about_motivation')->nullable();
            $table->foreign('menu_id')
                ->references('id')
                ->on('menus')
                ->cascadeOnUpdate();
            $table->foreign('training_id')
                ->references('id')
                ->on('trainings')
                ->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

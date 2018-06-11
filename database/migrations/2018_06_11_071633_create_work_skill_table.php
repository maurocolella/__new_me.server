<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkSkillTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_skill', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('work_id')->unsigned()->nullable();
            $table->foreign('work_id')->references('id')
                ->on('works')->onDelete('cascade');

            $table->integer('skill_id')->unsigned()->nullable();
            $table->foreign('skill_id')->references('id')
                ->on('skills')->onDelete('cascade');

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('work_skill');
    }
}

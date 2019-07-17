<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create1563399196768ProjectsTable extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('projects')) {
            Schema::create('projects', function (Blueprint $table) {
                $table->increments('id');
                $table->string('title');
                $table->longText('description');
                $table->longText('objectives')->nullable();
                $table->string('visibility');
                $table->timestamps();
                $table->softDeletes();
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('projects');
    }
}

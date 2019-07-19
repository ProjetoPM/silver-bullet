<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->longText('description');
            $table->longText('objectives')->nullable();
            $table->string('visibility');
            $table->integer('created_by');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}

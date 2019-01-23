<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateListingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('slug')->nullable()->default(null);
            $table->longText('description');
            $table->double('price');
            $table->string('featured_image');
            $table->unsignedInteger('category_id');
            $table->unsignedInteger('make_id');
            $table->unsignedInteger('carmodel_id')->nullable();
            $table->unsignedInteger('user_id');
            $table->string('location');
            $table->string('year');
            $table->tinyInteger('is_offer')->default(0);
            $table->tinyInteger('visibility')->default(1);
            $table->tinyInteger('approved')->default(0);
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
        Schema::dropIfExists('listings');
    }
}

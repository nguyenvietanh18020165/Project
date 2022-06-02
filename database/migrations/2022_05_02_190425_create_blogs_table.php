<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longtext('news');
            $table->string('desc');
            $table->unsignedBigInteger('blog_category');
            $table->unsignedBigInteger('category');
            $table->integer('user_id');
            $table->string('image');
            $table->string('slug');
            $table->timestamps();
            $table->foreign('blog_category')
                ->references('id')->on('blog_categories')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');
            $table->foreign('category')
            ->references('id')->on('categoris')
            ->onDelete('CASCADE')
            ->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blogs');
    }
};

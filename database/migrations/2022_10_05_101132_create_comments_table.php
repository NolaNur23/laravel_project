<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->string('name',255);
            $table->longText('comment');
            $table->integer('like')->unsigned()->nullable()->default(0);
            $table->enum('is_active',['enable','disable'])->default('enable');
            $table->timestamps();

            // make::migration add_id_news_to_comments_table --table=comments
            // untuk menambahkan kelas untuk menambahkan field

            // $table->integer('id_news')->unsigned()->after('is_active');
            // $table->foreign('id_news')->references('id')->on('tb_news')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}

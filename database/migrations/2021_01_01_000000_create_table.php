<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // ユーザーテーブル
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            /*
            $table->string('email')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            */
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        /*
        Schema::create('password_resets', function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('failed_jobs', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->text('connection');
            $table->text('queue');
            $table->longText('payload');
            $table->longText('exception');
            $table->timestamp('failed_at')->useCurrent();
        });
        */

        // カテゴリーテーブル
        Schema::create('categories', function (Blueprint $table) {
            $table->unsignedBigInteger('id');
            $table->string('name');

            $table->primary('id');
        });

        // 記事テーブル
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('title', 100);
            $table->text('body');
            $table->unsignedBigInteger('category_id');
            $table->timestampTz('posted_at')->nullable();
            $table->boolean('public_flag');
            $table->timestamps();   // TODO:without timezoneになるのでTzを付ける必要がありそう

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('category_id')->references('id')->on('categories');
        });

        // コメントテーブル
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('article_id');
            $table->text('text');
            $table->timestamp('created_at')->nullable();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('article_id')->references('id')->on('articles');
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
        Schema::dropIfExists('articles');
        Schema::dropIfExists('categories');
        /*
        Schema::dropIfExists('failed_jobs');
        Schema::dropIfExists('password_resets');
        */
        Schema::dropIfExists('users');
    }
}

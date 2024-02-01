<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('author_id');
            $table->string('author');
            $table->boolean('published')->default(false);
            $table->foreign('author_id')->references('id')->on('users');
            $table->timestamps();
        });
        DB::statement('ALTER TABLE posts ADD photo LONGBLOB');
        DB::statement('ALTER TABLE posts ADD content LONGTEXT');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};

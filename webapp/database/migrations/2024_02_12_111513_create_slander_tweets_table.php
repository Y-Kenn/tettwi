<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('slander_tweets', function (Blueprint $table) {
            $table->string('tweet_id')->primary();
            $table->string('user_id');
            $table->string('slanderer_id');
            $table->text('embedded_tweet_html');
            $table->unsignedInteger('slanderous_evaluations_num')->default(0);
            $table->unsignedInteger('fair_evaluations_num')->default(0);
            $table->unsignedInteger('bookmarks_num')->default(0);
            $table->timestamp('hidden_at')->nullable();
            $table->timestamp('tweeted_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('slanderer_id')->references('id')->on('slanderers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('slander_tweets', function (Blueprint $table) {
            $table->dropForeign(['slanderer_id']);
        });
        Schema::dropIfExists('slander_tweets');
    }
};

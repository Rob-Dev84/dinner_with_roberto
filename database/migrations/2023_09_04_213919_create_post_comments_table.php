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
        Schema::create('post_comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->foreign('parent_id')->references('id')->on('post_comments')->onDelete('cascade');
            $table->foreignId('post_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('post_comment_status_id')->constrained();//pending/approved/spam/trash
            $table->ipAddress('user_ip')->nullable();
            $table->unsignedTinyInteger('recipe_rating')->nullable();
            $table->string('name');
            $table->string('email');
            $table->string('link')->nullable();
            $table->string('comment');
            $table->boolean('cookies_consent')->default(0);
            $table->boolean('notify_on_reply')->default(0); // send an email to the user when I reply 
            $table->boolean('read')->default(0); // check if comment is read
            $table->boolean('reply')->default(0); // check if comment need to be reply
            $table->boolean('pinned')->default(0);
            $table->timestamp('pinned_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_comments');
    }
};

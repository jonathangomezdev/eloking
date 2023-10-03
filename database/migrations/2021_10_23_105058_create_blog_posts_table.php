<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->text('content');
            $table->text('category');
            $table->text('slug');
            $table->text('image');
            $table->text('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('page_title')->nullable();
            $table->enum('status', [
                'draft',
                'published'
            ])->default('draft');
            $table->timestamp('schedule_publish_at')->nullable();
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
        Schema::dropIfExists('blog_posts');
    }
}

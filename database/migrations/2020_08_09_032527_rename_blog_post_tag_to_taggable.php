<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameBlogPostTagToTaggable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blog_post_tag', function (Blueprint $table) {
            $table->dropForeign(['blog_post_id']);
            $table->dropColumn(['blog_post_id']);

            $table->morphs('tag_for');
        });

        Schema::rename('blog_post_tag', 'taggables');

        Schema::table('taggables', function (Blueprint $table) {
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('taggables', function (Blueprint $table) {
            $table->dropMorphs('tag_for');
        });

        Schema::rename('taggables', 'blog_post_tag');

        Schema::disableForeignKeyConstraints();

        Schema::table('blog_post_tag', function (Blueprint $table) {
            $table->unsignedBigInteger('blog_post_id')->index();
            $table->foreign('blog_post_id')->references('id')->on('blog_posts');
        });

        Schema::enableForeignKeyConstraints();
    }
}

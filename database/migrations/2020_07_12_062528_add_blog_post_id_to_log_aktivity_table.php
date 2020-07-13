<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBlogPostIdToLogAktivityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('log_aktivities', function (Blueprint $table) {
            $table->unsignedBigInteger('blog_post_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('log_aktivities', function (Blueprint $table) {
            $table->dropColumn(['blog_post_id']);
        });
    }
}

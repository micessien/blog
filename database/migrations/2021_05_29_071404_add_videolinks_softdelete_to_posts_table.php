<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVideolinksSoftdeleteToPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->string('youtube', 50)->nullable()->after('category_id');
            $table->string('dailymotion', 50)->nullable()->after('category_id');
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
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('youtube');
            $table->dropColumn('dailymotion');
            $table->dropColumn('deleted_at');
        });
    }
}

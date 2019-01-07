<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeAvatarAttributeOfUserProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('user_profiles', function (Blueprint $table) {
            $table->string('avatar')->nullable()->change();
            $table->dropColumn('name');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->change();        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropColumn('avatar');
        Schema::table('user_profiles', function (Blueprint $table) {
            $table->string('name');
        });
        Schema::dropForeign('user_profiles_user_id_foreign');
    }
}

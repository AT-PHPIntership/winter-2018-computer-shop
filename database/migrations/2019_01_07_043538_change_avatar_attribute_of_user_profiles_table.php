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
            $table->dropForeign('user_profiles_user_id_foreign');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_profiles', function (Blueprint $table) {
            $table->dropForeign('user_profiles_user_id_foreign');
            $table->foreign('user_id')->references('id')->on('users')->delete('cascade'); 
            $table->string('name')->after('id');
            $table->dropColumn('avatar');
        });
    }
}

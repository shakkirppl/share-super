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
        Schema::table('users', function (Blueprint $table) {
            //
            $table->string('is_super_admin')->nullable()->after('remember_token');
            $table->string('is_shop_admin')->nullable()->after('is_super_admin');
            $table->string('is_staff')->nullable()->after('is_shop_admin');
            $table->integer('store_id')->default(0)->after('is_staff');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};

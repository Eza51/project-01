<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     *1.php artisan make:migration add_phone_number_to_users_table --table=users
   
     */
    //Schema::table('countries', function (Blueprint $table) {
            //$table->string('zip')->nullable()->after('name');
            //php artisan migrate:rollback
            //2.create table
            //php artisan make:migration create_flights_table
     
    public function up(): void
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->unsignedSmallInteger('id')->primary();
            $table->string('name');
            $table->string('iso2');
            $table->string('phone_code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('countries');
    }
};

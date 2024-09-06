<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('webuser', function (Blueprint $table) {
            $table->increments('id'); // 'id' as primary key with auto-increment
            $table->string('username', 50)->unique(); // Unique username
            $table->text('name'); // User's name
            $table->string('password'); // User's password
            $table->string('role', 50)->default('user');

            $table->timestamps(); // Adds created_at and updated_at columns
        });
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });

    }

    public function down()
    {
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('user');
    }
}

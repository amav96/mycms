<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('status')->default('esperando_validar')->change();
            $table->string('role')->default('usuario')->change();
            $table->string('identification');
            $table->string('firstName');
            $table->string('lastName');
            $table->string('email')->unique();
            $table->integer('code')->default(1);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->longText('token_validate', 255);
            $table->integer('restoring_password')->default(0);
            $table->rememberToken();
            $table->timestamps();
            $table->collation = 'utf8_unicode_ci';
            $table->charset = 'utf8';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}

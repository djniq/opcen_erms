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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(false);
            $table->string('email')->unique()->nullable(false);
            $table->string('username')->unique()->nullable(false);
            $table->timestamp('email_verified_at')->nullable();
            $table->bigInteger('primary_mobile_number')->nullable(false)->unsigned()->comment('Mobile number that will receive the text notification.');
            $table->string('password');
            $table->enum('role', ['superAdmin', 'admin', 'opcen', 'emt'])->comment('superAdmin: All access super user; admin: Facility administrator; opcen: Primary Opcen app user; emt: EMT staff/responder group account;');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};

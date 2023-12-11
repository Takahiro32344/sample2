<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id()->unique();
            $table->string('birthday', 20);
            $table->string('gender', 20);
            $table->string('address_1', 20);
            $table->string('address_2', 20);
            $table->string('name', 20);
            $table->string('id-name', 70);
            $table->string('email', 70);
            $table->unique('email', 'accounts_email_unique');
            $table->string('password', 100);
            $table->string('tel', 20)->nullable(true);
            $table->unique('tel', 'accounts_tel_unique');
            $table->integer('login_status')->nullable(true)->default(0);
            $table->integer('certification_flag')->nullable(true)->default(0);
            $table->integer('publish_email')->nullable(true)->default(0);
            $table->integer('publish_tel')->nullable(true)->default(0);
            $table->string('question', 50)->nullable(true);
            $table->string('answer', 100)->nullable(true);
            $table->string('one_time_code', 100)->nullable(true);
            $table->string('update_image_name', 300)->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};

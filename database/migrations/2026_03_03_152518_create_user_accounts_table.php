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
        Schema::create('user_accounts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id');
            $table->foreignUuid('account_platform_id');
            $table->string('account_id')->nullable();
            $table->string('name')->nullable();
            $table->string('username', 50)->nullable();
            $table->string('photo_url', 500)->nullable();
            $table->string('account_url', 500)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_accounts');
    }
};

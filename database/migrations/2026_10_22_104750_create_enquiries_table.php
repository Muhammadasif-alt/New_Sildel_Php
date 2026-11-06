<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('enquiries', function (Blueprint $table) {
            $table->id();
            $table->string('name', 120);
            $table->string('email', 190)->index();
            $table->string('subject', 190)->nullable();
            $table->text('message');
            $table->string('locale', 5)->default('en');
            $table->string('ip_address', 45)->nullable();
            $table->string('user_agent', 255)->nullable();
            $table->timestamp('mailed_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('enquiries');
    }
};

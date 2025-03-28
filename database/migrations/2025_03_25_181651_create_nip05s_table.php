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
        Schema::create('nip05s', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('pubkey')->unique();
            $table->jsonb('relays')->nullable();
            $table->jsonb('profile')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nip05s');
    }
};

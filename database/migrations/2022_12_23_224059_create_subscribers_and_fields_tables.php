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
    public function up(): void
    {
        Schema::create('subscribers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->enum('state', ['active', 'unsubscribed', 'junk', 'bounced', 'unconfirmed']);
            $table->timestamps();
        });

        Schema::create('fields', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->enum('type', ['date', 'number', 'string', 'boolean']);
            $table->timestamps();
        });

        Schema::create('field_subscriber', function (Blueprint $table) {
            $table->foreignId('field_id')->constrained()->cascadeOnDelete();
            $table->foreignId('subscriber_id')->constrained()->cascadeOnDelete();
            $table->string('value');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('field_subscriber');
        Schema::dropIfExists('fields');
        Schema::dropIfExists('subscribers');
    }
};

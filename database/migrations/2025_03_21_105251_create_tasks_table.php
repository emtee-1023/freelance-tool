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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->text('description');
            $table->foreignId('assigned_to')->constrained('users')->onDelete('cascade');
            $table->decimal('amount', 10, 2)->default(0);
            $table->decimal('freelancer_pay', 10, 2)->default(0);
            $table->datetime('deadline');
            $table->enum('status', ['pending assignment', 'in progress', 'completed', 'cancelled'])->default('pending assignment');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};

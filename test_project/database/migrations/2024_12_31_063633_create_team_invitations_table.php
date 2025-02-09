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
        if (!Schema::hasTable('team_invitations')) { // Check if the table already exists
            Schema::create('team_invitations', function (Blueprint $table) {
                $table->id();
                $table->foreignId('team_id')->constrained()->cascadeOnDelete();
                $table->string('email');
                $table->string('role')->nullable();
                $table->timestamps();

                $table->unique(['team_id', 'email']);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('team_invitations')) {
            Schema::dropIfExists('team_invitations');
        }
    }
};

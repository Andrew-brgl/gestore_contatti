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
        Schema::create('delegates', function (Blueprint $table) {
            $table->id();

            $table->string('role');
            $table->string('first_name');
            $table->string('last_name');

            $table->foreignId('invitation_id')->constrained('invitations')->restrictOnDelete()->cascadeOnUpdate();
            $table->foreignId('contact_id')->constrained('contacts')->restrictOnDelete()->cascadeOnUpdate();
                $table->unique(['invitation_id', 'contact_id']);
            $table->foreignId('title_id')->nullable()->constrained('titles')->nullOnDelete()->nullOnUpdate();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delegates');
    }
};

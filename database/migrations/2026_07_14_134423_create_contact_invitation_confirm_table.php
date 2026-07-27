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
        Schema::create('contact_invitation_confirm', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contact_id')->constrained('contacts')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('invitation_id')->constrained('invitations')->cascadeOnDelete()->cascadeOnUpdate();
                $table->unique(['contact_id', 'invitation_id']);

            $table->integer('attending_guests')->default(0)->nullable();
            $table->integer('confirmed_guests')->default(0)->nullable();
            $table->date('confirmation_date')->nullable();
            $table->date('cancellation_date')->nullable();
            $table->boolean('has_attended')->default(true)->nullable();
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_invitation_confirm');
    }
};

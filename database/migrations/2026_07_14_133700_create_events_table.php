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
        Schema::create('events', function (Blueprint $table) {
            $table->id();

            $table->dateTime('start_date', 0);
            $table->string('title');

                $table->unique(['start_date', 'title']);

            $table->string('description');

            $table->text('program_document')->nullable();
            $table->string('access_type', 50)->nullable();
            $table->string('reference_secretariat', 150)->nullable();

            $table->foreignId('event_type_id')->constrained('event_types')->restrictOnDelete()->cascadeOnUpdate();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};

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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();

            //super key
            $table->string('institution');
            $table->string('first_name');
            $table->string('last_name');

                $table->unique(['institution', 'last_name', 'first_name']);

            //other fields
            $table->string('primary_email');
            $table->string('secondary_email')->nullable();
            $table->string('primary_phone')->nullable();
            $table->string('secondary_phone')->nullable();
            $table->string('origin_area')->nullable();
            $table->date('valid_from');
            $table->date('valid_unitil')->nullable();
            $table->string('website')->nullable();
            $table->text('notes')->nullable();
            $table->string('department', 150)->nullable();
            $table->timestamps();
            
            //FK on roles, categories e titles
            $table->foreignId('role_id')->constrained()->restrictOnDelete()->cascadeOnUpdate();
            $table->foreignId('category_id')->constrained()->restrictOnDelete()->cascadeOnUpdate();
            $table->foreignId('title_id')->nullable()->constrained()->nullOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};

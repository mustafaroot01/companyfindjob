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
        Schema::create('job_listings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->string('country');
            $table->string('city');
            $table->string('nearest_point')->nullable();
            $table->decimal('salary_from', 12, 2)->nullable();
            $table->decimal('salary_to', 12, 2)->nullable();
            $table->enum('currency', ['USD', 'IQD'])->default('IQD');
            $table->date('deadline')->nullable();
            $table->text('skills')->nullable(); // JSON cast
            $table->enum('job_type', ['full-time', 'part-time', 'freelance'])->default('full-time');
            $table->integer('experience_years')->default(0);
            $table->string('degree_level')->nullable();
            $table->text('tags')->nullable(); // JSON cast
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_listings');
    }
};

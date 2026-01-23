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
        Schema::create('exclusive_distributors', function (Blueprint $table) {
            $table->id();

            // Titles
            $table->string('title_ar');
            $table->string('title_en')->nullable();

            // Subtitle
            $table->string('subtitle_ar')->nullable();
            $table->string('subtitle_en')->nullable();

            // Description
            $table->text('description_ar')->nullable();
            $table->text('description_en')->nullable();

            // Image
            $table->string('image')->nullable();

            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exclusive_distributors');
    }
};

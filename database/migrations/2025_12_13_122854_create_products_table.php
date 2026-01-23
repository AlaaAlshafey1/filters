<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
Schema::create('products', function (Blueprint $table) {
    $table->id();

    $table->string('name_ar');
    $table->string('name_en')->nullable();

    $table->text('description_ar')->nullable();
    $table->text('description_en')->nullable();

    // Sections text
    $table->text('eco_description')->nullable();
    $table->text('finishes_description')->nullable();

    // Main image (hero)
    $table->string('main_image')->nullable();

    // PDFs
    $table->string('pdf_open_plate')->nullable();
    $table->string('pdf_offset_hole')->nullable();
    $table->string('pdf_closed_plate')->nullable();

    $table->foreignId('category_id')->constrained()->cascadeOnDelete();

    $table->timestamps();
});

    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

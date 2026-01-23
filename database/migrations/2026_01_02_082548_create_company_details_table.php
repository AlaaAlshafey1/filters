<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('company_details', function (Blueprint $table) {
            $table->id();
            $table->string('section_key')->unique(); // vision, mission, values, what_we_do, how_we_do, certification, about
            $table->string('title_ar')->nullable();
            $table->string('title_en')->nullable();
            $table->text('description_ar')->nullable();
            $table->text('description_en')->nullable();
            $table->json('images')->nullable(); // صور لكل قسم
            $table->string('video_url')->nullable(); // لو عايز فيديو زي الـ YouTube
            $table->boolean('is_active')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('company_details');
    }
};

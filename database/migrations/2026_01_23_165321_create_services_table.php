<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();

            $table->string('title1_ar');
            $table->string('title1_en');

            $table->string('title2_ar')->nullable();
            $table->string('title2_en')->nullable();

            $table->text('desc1_ar')->nullable();
            $table->text('desc1_en')->nullable();

            $table->string('title3_ar')->nullable();
            $table->string('title3_en')->nullable();

            $table->text('desc2_ar')->nullable();
            $table->text('desc2_en')->nullable();

            $table->string('image')->nullable();
            
            $table->json('items'); 

            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};

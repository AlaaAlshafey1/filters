<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contact_us', function (Blueprint $table) {
            $table->id();
            $table->string('name');       // اسم المرسل
            $table->string('email');      // ايميل المرسل
            $table->string('subject')->nullable();  // موضوع الرسالة
            $table->text('message');      // نص الرسالة
            $table->boolean('is_read')->default(false); // تم قراءتها؟
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contact_us_messages');
    }
};

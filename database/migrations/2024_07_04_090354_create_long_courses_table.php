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
        Schema::create('long_courses', function (Blueprint $table) {
            $table->id();

            $table->longText('name');
            $table->integer('certificate_price');

            $table->longText('paths')->default('[]');
            $table->longText('quiz');
            $table->integer('success_degree');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('long_courses');
    }
};

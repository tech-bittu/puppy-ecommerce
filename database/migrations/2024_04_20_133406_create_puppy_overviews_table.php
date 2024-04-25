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
        Schema::create('puppy_overviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('puppyinfo_id')->constrained('puppyinformations')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('short_desc');
            $table->text('long_desc')->nullable();
            $table->boolean('status');
            $table->string('page_title')->nullable();
            $table->string('meta_image')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_keyword')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('og_image')->nullable();
            $table->string('og_title')->nullable();
            $table->string('og_description')->nullable();
            $table->string('og_url')->nullable();
            $table->boolean('robots')->default(0);
            $table->boolean('googlebot')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('puppy_overviews');
    }
};

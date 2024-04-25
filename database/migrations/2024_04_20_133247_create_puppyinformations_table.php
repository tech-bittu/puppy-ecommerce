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
        Schema::create('puppyinformations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('breed_type')->constrained('breeds')->cascadeOnUpdate();
            $table->foreignId('barking_level')->constrained('barking_levels')->cascadeOnUpdate();
            $table->foreignId('activity_level')->constrained('activity_levels')->cascadeOnUpdate();
            $table->foreignId('coat_type')->constrained('coat_types')->cascadeOnUpdate();
            $table->foreignId('characteristics')->constrained('characteristics')->cascadeOnUpdate();
            $table->foreignId('shedding')->constrained('sheedings')->cascadeOnUpdate();
            $table->foreignId('size')->constrained('breed_sizes')->cascadeOnUpdate();
            $table->foreignId('trainability')->constrained('trainabilities')->cascadeOnUpdate();
            $table->foreignId('group_type')->constrained('group_types')->cascadeOnUpdate();
            $table->string('drooling_level');
            $table->integer('life_expetancy');
            $table->integer('affectionate_with_family');
            $table->integer('good_with_child');
            $table->integer('good_with_other_dogs');
            $table->integer('openness_to_strangers');
            $table->integer('watchdog_protective_nature');
            $table->integer('adaptability_level');
            $table->integer('playfulness_level');
            $table->timestampTz('created_at')->useCurrent();
            $table->timestampTz('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('puppyinformation');
    }
};

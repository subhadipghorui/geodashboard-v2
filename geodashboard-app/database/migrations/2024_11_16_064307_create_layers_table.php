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
        Schema::create('layers', function (Blueprint $table) {
            $table->id();
            $table->string('g_uuid');
            $table->string('g_label');
            $table->string('g_slug');
            $table->json('g_groups')->nullable();
            $table->string('g_layer_type')->nullable();
            $table->string('g_layer_url')->nullable();
            $table->string('g_feature_type')->nullable();
            $table->json('g_meta')->nullable();
            $table->boolean('g_feature_label_visibility')->nullable();
            $table->text('g_feature_label_value')->nullable();
            $table->boolean('g_feature_hover_enabled')->nullable();
            $table->text('g_feature_hover_value')->nullable();
            $table->boolean('g_feature_click_enabled')->nullable();
            $table->text('g_feature_click_value')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->string('created_by');
            $table->string('updated_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('layers');
    }
};

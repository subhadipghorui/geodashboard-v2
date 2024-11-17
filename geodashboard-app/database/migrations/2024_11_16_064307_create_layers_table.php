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
            $table->json('g_layer_config')->nullable();
            $table->json('g_meta')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
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

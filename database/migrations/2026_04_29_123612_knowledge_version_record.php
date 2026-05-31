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
        Schema::create('knowledge_version_records', function (Blueprint $table) {
            $table->integer('version');
            $table->string('disease_code');
            $table->string('disease_name');
            $table->text('disease_description');
            $table->text('disease_treatment');
            $table->string('symptom_code');
            $table->string('symptom_name');
            $table->float('mb');
            $table->float('md');

            // Primary key
            $table->primary(['version', 'disease_code', 'symptom_code']);
            // Foreign key
            $table->foreign('version')->references('version')->on('knowledge_base_versions');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('knowledge_version_records');
    }
};

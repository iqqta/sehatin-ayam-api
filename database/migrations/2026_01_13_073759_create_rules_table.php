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
        Schema::create('rules', function (Blueprint $table) {
            $table->string('disease_code');
            $table->string('symptom_code');
            $table->float('mb');
            $table->float('md');
            $table->timestamps();

            // Composite primary key
            $table->primary(['disease_code', 'symptom_code']);

            // Foreign keys
            $table->foreign('disease_code')->references('disease_code')->on('diseases')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('symptom_code')->references('symptom_code')->on('symptoms')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rules');
    }
};

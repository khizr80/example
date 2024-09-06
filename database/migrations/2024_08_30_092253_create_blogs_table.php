<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->unsignedBigInteger('SubCategoryId')->nullable();
            $table->string('title');
            $table->string('slugs');
            $table->text('content'); // Content field for blog body
            $table->string('image')->nullable(); // Optional image field
            $table->unsignedBigInteger('UserId');
            $table->timestamps(); // Handles CreatedAt and UpdatedAt

            // Foreign key relationships
            $table->foreign('SubCategoryId')->references('id')->on('subcategories')->onDelete('cascade');
            $table->foreign('UserId')->references('id')->on('webuser')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};

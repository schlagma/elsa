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
        Schema::create('candidates', function (Blueprint $table) {
            $table->id();
            $table->integer('election');
            $table->integer('committee');
            $table->text('lastname');
            $table->text('firstname');
            $table->text('email');
            $table->text('picture')->nullable();
            $table->integer('course');
            $table->integer('faculty');
            $table->integer('list')->nullable();
            $table->json('answers')->nullable();
            $table->integer('votes')->nullable();
            $table->boolean('resigned');
            $table->text('edit_token')->nullable();
            $table->timestamp('edit_token_created_at')->useCurrent()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidates');
    }
};

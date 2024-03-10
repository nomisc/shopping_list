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
        //
        Schema::create('shopping_lists', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('item')->nullable(false);
            $table->boolean('checked')->default(false);
            $table->boolean('exported')->default(false);
            $table->boolean('edit_mode')->default(false);
            $table->bigInteger('edit_mode_by')->nullable();
            $table->bigInteger('edit_by')->nullable();
            $table->bigInteger('inserted_by')->nullable();
            $table->bigInteger('deleted_by')->nullable();
            $table->bigInteger('exported_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('shopping_lists', function (Blueprint $table) {
            $table->foreign('edit_by')->references('id')->on('users')->onDelete('restrict');
            $table->foreign('inserted_by')->references('id')->on('users')->onDelete('restrict');
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('restrict');
            $table->foreign('exported_by')->references('id')->on('users')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('shopping_lists');
    }
};

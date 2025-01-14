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
        Schema::disableForeignKeyConstraints();

        Schema::create('inventory_logs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_id');
            $table->decimal('quantity');
            $table->enum('type', ["add","remove"]);
            $table->string('description');
            $table->timestamp('created_at');
            $table->bigInteger('updated_at');
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_logs');
    }
};

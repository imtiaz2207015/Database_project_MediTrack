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
    Schema::create('medicines', function (Blueprint $table) {
        $table->id();
        $table->foreignId('category_id')->constrained()->onDelete('cascade');
        $table->foreignId('supplier_id')->constrained()->onDelete('cascade');
        $table->string('name');
        $table->string('generic_name')->nullable();
        $table->string('brand')->nullable();
        $table->enum('dosage_form', ['tablet','capsule','syrup','injection','cream','drops','other']);
        $table->string('strength')->nullable();
        $table->decimal('price', 10, 2);
        $table->integer('stock_quantity')->default(0);
        $table->integer('reorder_level')->default(10);
        $table->date('expiry_date');
        $table->string('batch_number')->nullable();
        $table->text('description')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicines');
    }
};

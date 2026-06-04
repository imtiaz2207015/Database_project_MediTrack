<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up(): void
{
    Schema::create('purchases', function (Blueprint $table) {
        $table->id();
        $table->foreignId('supplier_id')->constrained()->onDelete('cascade');
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->decimal('total_amount', 10, 2);
        $table->string('status')->default('received');
        $table->date('purchase_date');
        $table->timestamps();
    });
    
    // Add CHECK constraint for Oracle (doesn't support ENUM)
    DB::statement("ALTER TABLE purchases ADD CONSTRAINT chk_purchase_status CHECK (status IN ('received','pending','cancelled'))");
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};

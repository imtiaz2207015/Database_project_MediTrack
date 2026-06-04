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
    Schema::create('sales', function (Blueprint $table) {
        $table->id();
        $table->foreignId('customer_id')->nullable()->constrained()->onDelete('set null');
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->decimal('total_amount', 10, 2);
        $table->decimal('discount', 10, 2)->default(0);
        $table->decimal('paid_amount', 10, 2);
        $table->string('payment_method')->default('cash');
        $table->string('status')->default('completed');
        $table->timestamps();
    });
    
    // Add CHECK constraints for Oracle (doesn't support ENUM)
    DB::statement("ALTER TABLE sales ADD CONSTRAINT chk_payment_method CHECK (payment_method IN ('cash','card','mobile_banking'))");
    DB::statement("ALTER TABLE sales ADD CONSTRAINT chk_sales_status CHECK (status IN ('completed','pending','cancelled'))");
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};

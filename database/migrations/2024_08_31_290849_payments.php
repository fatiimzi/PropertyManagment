<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained()->onDelete('cascade'); // Foreign key to tenants
            $table->foreignId('property_id')->constrained()->onDelete('cascade'); // Foreign key to properties
            $table->date('payment_date'); // Date the payment was made
            $table->decimal('amount', 10, 2); // Amount of the payment
            $table->boolean('is_settled')->default(false); // Whether the payment is settled or not
            $table->timestamps(); // created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
};

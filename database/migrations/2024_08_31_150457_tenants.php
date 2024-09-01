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
    Schema::create('tenants', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('contact_details');
        $table->foreignId('property_id')->constrained()->onDelete('cascade');
        $table->timestamps(); // created_at and updated_at
    });
}

    /**
     * Reverse the migrations.
     */
public function down()
{
    Schema::dropIfExists('tenants');
}

 
};

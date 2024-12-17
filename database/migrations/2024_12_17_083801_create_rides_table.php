<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rides', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('driver_id')->nullable();
            $table->string('pickup_location');
            $table->string('dropoff_location');
            $table->decimal('fare', 8, 2);
            $table->enum('status', ['pending', 'accepted', 'in_progress', 'completed', 'canceled'])->default('pending');
            $table->timestamp('pickup_time')->nullable();
            $table->timestamp('dropoff_time')->nullable();
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('driver_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rides');
    }
};

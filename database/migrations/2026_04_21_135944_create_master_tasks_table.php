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
        Schema::create('master_tasks', function (Blueprint $table) {
            $table->id();
            $table->string('pekerjaan')->nullable();
            $table->integer('point_type')->default(0)->comment('0 per hari 1 per bulan');
            $table->integer('per_hari')->default(0);
            $table->integer('per_bulan')->default(0);
            $table->integer('menit_per_output')->default(0);
            $table->decimal('point_per_10', 6, 1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_tasks');
    }
};

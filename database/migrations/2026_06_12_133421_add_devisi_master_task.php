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
        Schema::table('master_tasks', function (Blueprint $table) {
            $table->string('devisi')->after('status')->nullable();
        });

        DB::table('master_tasks')->update(['devisi' => 'Creative']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('master_tasks', function (Blueprint $table) {
            $table->dropColumn('devisi');
        });
    }
};

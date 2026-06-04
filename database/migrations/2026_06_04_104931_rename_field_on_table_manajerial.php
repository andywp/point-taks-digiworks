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
        Schema::table('manajerials', function (Blueprint $table) {
            $table->renameColumn('persentase', 'menit');
        });
        Schema::table('manajerials', function (Blueprint $table) {
            $table->integer('menit')->nullable()->change();
            $table->decimal('poin', 6, 1)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('manajerials', function (Blueprint $table) {
            $table->renameColumn('menit', 'persentase');
        });
        Schema::table('manajerials', function (Blueprint $table) {
            $table->decimal('persentase',5,2)->nullable()->change();
            $table->integer('poin')->nullable()->change();
        });
    }
};

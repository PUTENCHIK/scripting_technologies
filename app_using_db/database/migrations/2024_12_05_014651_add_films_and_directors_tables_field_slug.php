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
        Schema::table('films', function (Blueprint $table) {
            $table->string('slug')->unique()->after('name');
        });
        Schema::table('directors', function (Blueprint $table) {
            $table->string('slug')->unique()->after('full_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('films', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
        Schema::table('directors', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::table('comments', function(Blueprint $table) {
            $table->foreignId('post_id')->after('id');
        });
    }

    public function down(): void
    {
        Schema::table('comments', function(Blueprint $table) {
            $table->dropConstrainedForeignId('post_id');
        });
    }
};

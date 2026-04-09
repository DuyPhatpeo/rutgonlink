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
        Schema::table('links', function (Blueprint $table) {
            $table->string('password')->nullable()->after('short_code');
            $table->timestamp('expires_at')->nullable()->after('password');
            $table->integer('click_limit')->nullable()->after('expires_at');
            $table->string('title')->nullable()->after('click_limit');
            $table->text('description')->nullable()->after('title');
            $table->string('thumbnail')->nullable()->after('description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('links', function (Blueprint $table) {
            $table->dropColumn(['password', 'expires_at', 'click_limit', 'title', 'description', 'thumbnail']);
        });
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            if (! Schema::hasColumn('properties', 'user_id')) {
                $table->unsignedBigInteger('user_id')->nullable()->after('marketing_id');
            }
        });

        if (Schema::hasColumn('properties', 'marketing_id')) {
            DB::statement('UPDATE properties SET user_id = marketing_id WHERE marketing_id IS NOT NULL');
        }

        Schema::table('properties', function (Blueprint $table) {
            if (Schema::hasColumn('properties', 'marketing_id')) {
                $table->dropColumn('marketing_id');
            }
        });
    }

    public function down(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            if (! Schema::hasColumn('properties', 'marketing_id')) {
                $table->unsignedBigInteger('marketing_id')->nullable()->after('id');
            }
        });

        if (Schema::hasColumn('properties', 'user_id')) {
            DB::statement('UPDATE properties SET marketing_id = user_id WHERE user_id IS NOT NULL');
        }

        Schema::table('properties', function (Blueprint $table) {
            if (Schema::hasColumn('properties', 'user_id')) {
                $table->dropColumn('user_id');
            }
        });
    }
};
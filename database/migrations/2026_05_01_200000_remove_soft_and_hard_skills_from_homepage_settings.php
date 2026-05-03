<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('homepage_settings', function (Blueprint $table) {
            if (Schema::hasColumn('homepage_settings', 'soft_skills')) {
                $table->dropColumn('soft_skills');
            }
            if (Schema::hasColumn('homepage_settings', 'hard_skills')) {
                $table->dropColumn('hard_skills');
            }
        });
    }

    public function down(): void
    {
        Schema::table('homepage_settings', function (Blueprint $table) {
            if (! Schema::hasColumn('homepage_settings', 'soft_skills')) {
                $table->text('soft_skills')->nullable()->after('skills');
            }
            if (! Schema::hasColumn('homepage_settings', 'hard_skills')) {
                $table->text('hard_skills')->nullable()->after('soft_skills');
            }
        });
    }
};

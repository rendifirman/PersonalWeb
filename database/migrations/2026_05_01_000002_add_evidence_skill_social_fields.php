<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('experiences', function (Blueprint $table) {
            $table->string('evidence_photo')->nullable()->after('description');
        });

        Schema::table('projects', function (Blueprint $table) {
            $table->string('evidence_photo')->nullable()->after('link');
        });

        Schema::table('homepage_settings', function (Blueprint $table) {
            $table->text('soft_skills')->nullable()->after('skills');
            $table->text('hard_skills')->nullable()->after('soft_skills');
            $table->string('linkedin')->nullable()->after('location');
            $table->string('instagram')->nullable()->after('linkedin');
            $table->string('github')->nullable()->after('instagram');
            $table->string('twitter')->nullable()->after('github');
        });
    }

    public function down(): void
    {
        Schema::table('experiences', function (Blueprint $table) {
            $table->dropColumn('evidence_photo');
        });

        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn('evidence_photo');
        });

        Schema::table('homepage_settings', function (Blueprint $table) {
            $table->dropColumn(['soft_skills', 'hard_skills', 'linkedin', 'instagram', 'github', 'twitter']);
        });
    }
};

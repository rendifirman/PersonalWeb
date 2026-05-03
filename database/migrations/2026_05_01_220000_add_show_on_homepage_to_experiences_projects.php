<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('experiences', function (Blueprint $table) {
            if (! Schema::hasColumn('experiences', 'show_on_homepage')) {
                $table->boolean('show_on_homepage')->default(true)->after('description');
            }
        });

        Schema::table('projects', function (Blueprint $table) {
            if (! Schema::hasColumn('projects', 'show_on_homepage')) {
                $table->boolean('show_on_homepage')->default(true)->after('description');
            }
        });
    }

    public function down(): void
    {
        Schema::table('experiences', function (Blueprint $table) {
            if (Schema::hasColumn('experiences', 'show_on_homepage')) {
                $table->dropColumn('show_on_homepage');
            }
        });

        Schema::table('projects', function (Blueprint $table) {
            if (Schema::hasColumn('projects', 'show_on_homepage')) {
                $table->dropColumn('show_on_homepage');
            }
        });
    }
};

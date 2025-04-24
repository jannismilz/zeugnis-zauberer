<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('final_grades', function (Blueprint $table) {
            $table->float('weight')->default(1.0)->after('grade');
        });
    }

    public function down(): void
    {
        Schema::table('final_grades', function (Blueprint $table) {
            $table->dropColumn('weight');
        });
    }
};

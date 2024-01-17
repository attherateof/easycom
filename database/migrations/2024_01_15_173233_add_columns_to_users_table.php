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
        Schema::table('users', function (Blueprint $table) {
            $table->string('prefix')->after('id')->nullable();
            $table->string('middle_name')->after('name')->nullable();
            $table->string('last_name')->after('middle_name');
            $table->string('phone')->after('email')->nullable();
            $table->date('dob')->after('phone')->nullable();
            $table->renameColumn('name', 'first_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('first_name', 'name');
            $table->dropColumn('prefix');
            $table->dropColumn('middle_name');
            $table->dropColumn('last_name');
            $table->dropColumn('phone');
            $table->dropColumn('dob');
        });
    }
};

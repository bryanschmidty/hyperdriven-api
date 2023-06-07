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
            $table->string('phone')->nullable()->after('email');
            $table->string('type')->nullable()->after('name'); // 'student' or 'parent'

            // for students
            $table->unsignedBigInteger('parent_id')->nullable()->after('phone');
            $table->string('school')->nullable()->after('parent_id');
            $table->integer('age')->nullable()->after('school');
            $table->string('gender')->nullable()->after('age');
            $table->boolean('defer')->default(false)->after('gender');
            $table->boolean('active')->default(false)->after('defer');

            // Foreign key constraint for parent_id
            $table->foreign('parent_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('type');
            $table->dropForeign(['parent_id']);
            $table->dropColumn('parent_id');
            $table->dropForeign(['school_id']);
            $table->dropColumn('school_id');
            $table->dropColumn('age');
            $table->dropColumn('gender');
        });
    }
};

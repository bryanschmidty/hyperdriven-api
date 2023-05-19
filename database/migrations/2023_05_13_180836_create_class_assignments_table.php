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
        Schema::create('class_assignments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('class_id')->constrained('student_classes')->onDelete('cascade');
            $table->foreignId('type_id')->constrained('assignment_types')->onDelete('cascade');
            $table->string('name');
            $table->date('due_date');
            $table->integer('points');
            $table->enum('status', ['not_started', 'in_progress', 'completed', 'paused']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_assignments');
    }
};

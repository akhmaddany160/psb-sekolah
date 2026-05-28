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
        Schema::create('student_tests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('jenjang'); // SD, SMP, SMA
            $table->integer('score')->default(0);
            $table->enum('status', ['LULUS', 'TIDAK_LULUS', 'BELUM_TES'])->default('BELUM_TES');
            $table->json('answers')->nullable(); // {"q1":"A", "q2":"B", ...}
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_tests');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity_student', function (Blueprint $table) {
            $table->id();
            // syntax untuk mengubah menjadi foreign key
            // cascadeOnUpdate(), untuk update agar id nya tetap. cascadeOnDelete() kalo misal id 1 didelete maka id 2 berubah jadi id 1
            $table->foreignId('student_id')->constrained('students')->cascadeOnUpdate()->cascadeOnDelete(); 
            $table->foreignId('activity_id')->constrained('activities')->cascadeOnUpdate()->cascadeOnDelete(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activity_student');
    }
};

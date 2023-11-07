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
    // fungsi yang harus diperhatikan yaitu up and down
    public function up() // up untuk apa yang akan dilakukan saat menjalankan migration
                        // yaitu untuk membuat table baru judulnya "students" dan isinya "id, name, score,timestamps"
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id(); // atribut bawaan yaitu id dan timestamps
            $table->string('name');
            $table->integer('score');
            $table->foreignId('teacher_id')->constrained('teachers')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() // apa yang terjadi saat make:migration direverse
                            // table students akan di-delete jika di-reverse
    {
        Schema::dropIfExists('students');
    }
};

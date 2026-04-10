<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Modifikasi tabel users (tambah kolom nama & role, hapus name)
        Schema::table('users', function (Blueprint $table) {
            $table->string('nama')->after('id');
            $table->enum('role', ['admin', 'guru', 'siswa'])->default('siswa')->after('email');
            $table->dropColumn('name'); // ← TAMBAH: hapus kolom name
        });

        // 2. Tabel kategoris
        Schema::create('kategoris', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kategori');
            $table->timestamps();
        });

        // 3. Tabel aspirasis
        Schema::create('aspirasis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('kategori_id')->constrained()->onDelete('cascade');
            $table->text('isi');
            $table->enum('status', ['pending', 'diproses', 'selesai', 'ditolak'])->default('pending');
            $table->timestamps();
        });

        // 4. Tabel umpan_baliks
        Schema::create('umpan_baliks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('aspirasi_id')->constrained()->onDelete('cascade');
            $table->text('isi');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('umpan_baliks');
        Schema::dropIfExists('aspirasis');
        Schema::dropIfExists('kategoris');
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['nama', 'role']);
            $table->string('name')->nullable(); // ← Kembalikan kolom name saat rollback
        });
    }
};

<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Kategori;
use App\Models\Alat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin User
        User::create([
            'name' => 'Admin Pinjamdulu',
            'email' => 'admin@pinjamdulu.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'nomor_identitas' => '1234567890123456',
            'alamat' => 'Jl. Admin, Jakarta',
            'no_telepon' => '081234567890',
        ]);

        // Create Petugas Users
        User::create([
            'name' => 'Petugas 1',
            'email' => 'petugas1@pinjamdulu.com',
            'password' => Hash::make('password'),
            'role' => 'petugas',
            'nomor_identitas' => '1234567890123457',
            'alamat' => 'Jl. Petugas 1, Jakarta',
            'no_telepon' => '081234567891',
        ]);

        // Create Peminjam Users
        for ($i = 1; $i <= 5; $i++) {
            User::create([
                'name' => "Peminjam $i",
                'email' => "peminjam$i@pinjamdulu.com",
                'password' => Hash::make('password'),
                'role' => 'peminjam',
                'nomor_identitas' => "123456789012345$i",
                'alamat' => "Jl. Peminjam $i, Jakarta",
                'no_telepon' => "0812345678" . sprintf('%02d', $i),
            ]);
        }

        // Create Kategoris
        $kategoris = [
            ['nama' => 'Peralatan Laboratorium', 'deskripsi' => 'Alat-alat untuk praktik laboratorium'],
            ['nama' => 'Peralatan Olahraga', 'deskripsi' => 'Alat-alat untuk kegiatan olahraga'],
            ['nama' => 'Peralatan Kantor', 'deskripsi' => 'Alat-alat untuk keperluan kantor'],
            ['nama' => 'Peralatan Elektronik', 'deskripsi' => 'Alat-alat elektronik'],
        ];

        foreach ($kategoris as $kategori) {
            Kategori::create($kategori);
        }

        // Create Alats
        $alats = [
            // Laboratorium
            ['nama' => 'Mikroskop', 'kategori_id' => 1, 'stok' => 10, 'kondisi' => 'baik', 'nomor_seri' => 'MICRO-001', 'deskripsi' => 'Mikroskop untuk praktik biologi'],
            ['nama' => 'Bunsen Burner', 'kategori_id' => 1, 'stok' => 20, 'kondisi' => 'baik', 'nomor_seri' => 'BUNSEN-001', 'deskripsi' => 'Pembakar Bunsen untuk praktik kimia'],
            ['nama' => 'Beaker Glass', 'kategori_id' => 1, 'stok' => 50, 'kondisi' => 'baik', 'nomor_seri' => 'BEAKER-001', 'deskripsi' => 'Gelas beaker untuk praktik lab'],
            
            // Olahraga
            ['nama' => 'Bola Basket', 'kategori_id' => 2, 'stok' => 15, 'kondisi' => 'baik', 'nomor_seri' => 'BASKET-001', 'deskripsi' => 'Bola basket standar'],
            ['nama' => 'Bola Voli', 'kategori_id' => 2, 'stok' => 15, 'kondisi' => 'baik', 'nomor_seri' => 'VOLI-001', 'deskripsi' => 'Bola voli standar'],
            ['nama' => 'Matras Yoga', 'kategori_id' => 2, 'stok' => 10, 'kondisi' => 'baik', 'nomor_seri' => 'YOGA-001', 'deskripsi' => 'Matras untuk yoga dan senam'],
            
            // Kantor
            ['nama' => 'Projector', 'kategori_id' => 3, 'stok' => 5, 'kondisi' => 'baik', 'nomor_seri' => 'PROJ-001', 'deskripsi' => 'Proyektor untuk presentasi'],
            ['nama' => 'Papan Tulis', 'kategori_id' => 3, 'stok' => 8, 'kondisi' => 'baik', 'nomor_seri' => 'BOARD-001', 'deskripsi' => 'Papan tulis whiteboard'],
            
            // Elektronik
            ['nama' => 'Laptop', 'kategori_id' => 4, 'stok' => 5, 'kondisi' => 'baik', 'nomor_seri' => 'LAPTOP-001', 'deskripsi' => 'Laptop untuk keperluan presentasi dan kerja'],
            ['nama' => 'USB Hub', 'kategori_id' => 4, 'stok' => 10, 'kondisi' => 'baik', 'nomor_seri' => 'USBHUB-001', 'deskripsi' => 'USB hub multi-port'],
        ];

        foreach ($alats as $alat) {
            $alat['stok_tersedia'] = $alat['stok'];
            Alat::create($alat);
        }
    }
}

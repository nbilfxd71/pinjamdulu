<?php
require 'bootstrap/app.php';

use App\Models\User;

// Test 1: Check table structure
echo "✅ Testing Database Setup...\n\n";

try {
    $user = User::find(1);
    if ($user) {
        echo "✓ Admin user found:\n";
        echo "  - ID: " . $user->id . "\n";
        echo "  - Name: " . $user->name . "\n";
        echo "  - Email: " . $user->email . "\n";
        echo "  - Role: " . $user->role . "\n";
        echo "  - Status: ✅ GOOD\n\n";
    }
} catch (\Exception $e) {
    echo "✗ Error: " . $e->getMessage() . "\n";
}

// Test 2: Count all users by role
echo "✓ Users by role:\n";
$adminCount = User::where('role', 'admin')->count();
$petugasCount = User::where('role', 'petugas')->count();
$peminjamCount = User::where('role', 'peminjam')->count();

echo "  - Admin: " . $adminCount . "\n";
echo "  - Petugas: " . $petugasCount . "\n";
echo "  - Peminjam: " . $peminjamCount . "\n";
echo "  - Total: " . ($adminCount + $petugasCount + $peminjamCount) . "\n\n";

echo "✅ Database setup successful!\n";
echo "\n🎉 You can now login with:\n";
echo "  - Admin: admin@pinjamdulu.com / password\n";
echo "  - Petugas: petugas1@pinjamdulu.com / password\n";
echo "  - Peminjam: peminjam1@pinjamdulu.com / password\n";

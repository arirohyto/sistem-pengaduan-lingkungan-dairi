<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "📊 Database Seeding Check\n";
echo "=" . str_repeat("=", 50) . "\n\n";

try {
    $userCount = DB::table('users')->count();
    $kategoriCount = DB::table('kategori')->count();
    $areaCount = DB::table('area')->count();
    $lokasiCount = DB::table('lokasi')->count();
    
    echo "✅ Users: {$userCount}\n";
    echo "✅ Kategori: {$kategoriCount}\n";
    echo "✅ Area: {$areaCount}\n";
    echo "✅ Lokasi: {$lokasiCount}\n\n";
    
    echo "👥 User List:\n";
    $users = DB::table('users')->select('name', 'email', 'role')->get();
    foreach ($users as $user) {
        echo "   - {$user->name} ({$user->email}) [{$user->role}]\n";
    }
    
    echo "\n📁 Kategori List:\n";
    $kategoris = DB::table('kategori')->whereNull('parent_id')->get();
    foreach ($kategoris as $kat) {
        echo "   - {$kat->name}\n";
        $children = DB::table('kategori')->where('parent_id', $kat->id)->get();
        foreach ($children as $child) {
            echo "     └─ {$child->name}\n";
        }
    }
    
} catch (\Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}

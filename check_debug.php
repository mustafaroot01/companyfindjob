<?php
// Load Laravel's autoloader
require __DIR__ . '/vendor/autoload.php';

// Bootstrap Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Diagnostics
echo "--- DB Check ---\n";
try {
    $user = \App\Models\User::first();
    print_r($user->toArray());
} catch (\Exception $e) {
    echo "DB Error: " . $e->getMessage() . "\n";
}

echo "\n--- File Check ---\n";
$path = $user->profile_photo_path ?? 'N/A';
echo "Profile Photo Path (DB): " . $path . "\n";

if ($path !== 'N/A') {
    $fullPath = storage_path('app/public/' . $path);
    echo "Full Path: " . $fullPath . "\n";
    
    if (file_exists($fullPath)) {
        echo "File Exists: YES\n";
        echo "Permissions: " . substr(sprintf('%o', fileperms($fullPath)), -4) . "\n";
        echo "Owner: " . fileowner($fullPath) . "\n";
        echo "Is Readable: " . (is_readable($fullPath) ? "YES" : "NO") . "\n";
    } else {
        echo "File Exists: NO\n";
        // Check directory existence
        $dir = dirname($fullPath);
        echo "Directory Exists ($dir): " . (is_dir($dir) ? "YES" : "NO") . "\n";
    }
}

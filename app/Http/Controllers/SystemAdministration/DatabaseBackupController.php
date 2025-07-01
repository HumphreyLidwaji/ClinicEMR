<?php

namespace App\Http\Controllers\SystemAdministration;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use App\Models\SystemAdministration\DatabaseBackup;
use Illuminate\Http\Request;

class DatabaseBackupController extends Controller
{
    public function index()
    {
        $backups = DatabaseBackup::orderBy('created_at', 'desc')->get();
        return view('system_administration.database_backups.index', compact('backups'));

    }

    public function createBackup()
    {
      $filename = 'backup_' . date('Y_m_d_His') . '.sql';
$filePath = storage_path("app/backups/{$filename}");

$user = env('DB_USERNAME');
$pass = env('DB_PASSWORD');
$db = env('DB_DATABASE');

$command = "mysqldump -u {$user} -p'{$pass}' {$db} > {$filePath}";
exec($command);


        DatabaseBackup::create([
            'file_name' => $filename,
            'file_path' => "backups/{$filename}",
            'created_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Backup created successfully.');
    }

public function restoreBackup($id)
{
    $backup = DatabaseBackup::findOrFail($id);
    $filePath = storage_path("app/{$backup->file_path}");

    $user = env('DB_USERNAME');
    $pass = env('DB_PASSWORD');
    $db = env('DB_DATABASE');

    // Use shell command for restoring the DB
    $command = "mysql -u {$user} -p'{$pass}' {$db} < {$filePath}";

    // Capture the command's result
    $output = null;
    $returnVar = null;
    exec($command, $output, $returnVar);

    // Determine status
    $status = $returnVar === 0 ? 'success' : 'failed';

    // Update the database with the restore result
    $backup->update([
        'restore_status' => $status,
        'restored_at' => now(),
    ]);

    if ($status === 'success') {
        return redirect()->back()->with('success', 'Database restored successfully.');
    } else {
        return redirect()->back()->with('error', 'Database restore failed.');
    }
}

}

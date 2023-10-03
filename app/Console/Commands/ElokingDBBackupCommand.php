<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ElokingDBBackupCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'eloking:database:backup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'It will backup database.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info("Starting eloking database backup.");
        $this->info("Checking and deleting for old backups");
        $this->deleteOldBackup();
        $this->info("Creating new backup");
        $this->createNewDBBackup();
        $this->info("Done!");
        return 0;
    }

    /**
     * It will delete files older than given days
     * @return void
     */
    private function deleteOldBackup()
    {
        collect(Storage::disk('local')->allFiles('backup'))
            ->each(function($file) {
                $fileLife = Carbon::parse(str_replace(['backup/backup-', '.sql'], '', $file));

                if ($fileLife->diffInDays(now()) > $this->getFileExpiry()) {
                    Storage::disk('local')->delete($file);
                }
            });
    }

    /**
     * It will create new backup for current time for database
     * @return void
     */
    private function createNewDBBackup()
    {
        $filename = "backup-" . Carbon::now()->format('Y-m-d') . ".sql";

        $command = "mysqldump --user=" . env('DB_USERNAME') . " --password=" . env('DB_PASSWORD') . " --host=" . env('DB_HOST') . " --no-tablespaces " . env('DB_DATABASE') . "  > " . storage_path() . "/app/backup/" . $filename;

        $returnVar = NULL;
        $output = NULL;

        File::ensureDirectoryExists(storage_path('/app/backup'));
        exec($command, $output, $returnVar);
    }

    /**
     * By reading .env it will give configurable time for backup file deletion
     * @return mixed
     */
    private function getFileExpiry()
    {
        return env('DELETE_DB_BACKUP_AFTER_DAYS', 3);
    }
}

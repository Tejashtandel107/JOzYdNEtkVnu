<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\DatabaseBackup;

class CronJobController extends Controller
{
    /*
     * Backup database for cron job
     */
    public function BackupDB(Request $request) {
        error_reporting(0);
        set_time_limit(0);
        $obj_database_backup =new DatabaseBackup();
        $obj_database_backup->artisanClear();
        $obj_database_backup->backup();
    }
    public function CleanBackup(Request $request) {
        error_reporting(0);
        set_time_limit(0);
        $obj_database_backup =new DatabaseBackup();
        $obj_database_backup->artisanClear();
        $obj_database_backup->cleanBackups();
    }
}

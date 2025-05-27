<?php
	namespace App\Helpers;

	use Illuminate\Support\Facades\Schema;
	use Illuminate\Support\Facades\Storage;
    use Artisan;

	class DatabaseBackup {

		function __construct() {
			//
		}

        public function artisanClear() {
            Artisan::call('cache:clear');
            Artisan::call('config:clear');
            Artisan::call('route:clear');
        }

		public function backup() {
			Artisan::call('backup:run', ['--only-db' => true]);
		}

		public function cleanBackups() {
			Artisan::call('backup:clean');
        }
	}
?>

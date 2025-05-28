<?php


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/test', 'TestController@index');
Route::get('/', 'Auth\LoginController@showLoginForm')->name('home');

Route::get('cron/backup-db', 'CronJobController@BackupDB')->name('cron.backup_db');
Route::get('cron/clean-backup', 'CronJobController@CleanBackup')->name('cron.clean_backup');

Auth::routes();

/*** ----------------ADMIN ROUTES START---------------------------------***/
require __DIR__.'/admin.php';

/*** ----------------USER ROUTES START---------------------------------***/
require __DIR__.'/user.php';


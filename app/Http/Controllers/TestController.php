<?php

namespace App\Http\Controllers;

use App\Helpers\DatabaseBackup;
use Illuminate\Http\Request;
use Notification;
use App\Notifications\DatabaseBackupSuccessful;
use App\Models\User;
use App\Mail\OrderShipped;
use Mail;
use App\Http\Controllers\Controller;

class TestController extends Controller
{
    /*
    *   A Testing Controller Only
    */
    public function index(){
		Notification::route('mail', 'dev.jiteshtandel@gmail.com')->notify(new DatabaseBackupSuccessful("http://www.google.com")); 
		//$user = User::findOrFail(1);
		//Mail::to($user)->send(new OrderShipped());
    }
}
?>

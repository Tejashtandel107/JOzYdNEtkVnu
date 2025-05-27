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
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Illuminate\Support\Facades\Log;

class TestController extends Controller
{
    /*
    *   A Testing Controller Only
    */
   
    public function index()
    {
        try {
            Notification::route('mail', 'dev.jiteshtandel@gmail.com')
                ->notify(new DatabaseBackupSuccessful("http://www.google.com"));
                  	//$user = User::findOrFail(1);
		                //Mail::to($user)->send(new OrderShipped());
        } catch (TransportExceptionInterface $e) {
            // Handle mail sending failure, e.g., log the error
            Log::error('Mail sending failed: ' . $e->getMessage());
            // Optionally return some error response or message
            return response()->json(['error' => 'Notification could not be sent.'], 500);
        }
        
        return response()->json(['success' => 'Notification sent successfully.']);
    }
}
?>

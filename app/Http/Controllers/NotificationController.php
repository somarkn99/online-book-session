<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
   public function index()
   {
    User::where('country', $request->country)->chunk(100, function ($users) use ($notificationData, $notification) {
        SendNotificationJob::dispatch($users, $notificationData, $notification->id);
    });

   }
}

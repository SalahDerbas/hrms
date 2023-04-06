<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Pushnotification;
use App\User;
use Illuminate\Http\Request;


class PushNotificationController extends Controller
{
    // get all Notifications from database
    public function index()
    {
        $Pushnotifications = Pushnotification::orderBy('id', 'DESC')->get();
        $Users = User::all();
        return view ('Pages.PushNotifications.index' , compact('Pushnotifications' , 'Users'));
    }

    // Push Notifications to users
    public function pushNotification (Request $request)
    {
        try {
            $users = $request->users;
            if (is_array($users) || is_object($users))
            {
                foreach ($users as $user)
                {
                    $firebaseToken = User::where(['id' => $user ])->pluck('fcm_token')->all();
                    if($firebaseToken)
                    {
                        $SERVER_API_KEY =env('SERVER_API_KEY');
                        $data = [
                            "registration_ids" => $firebaseToken,
                            "notification" => [
                                "title"       => $request->title,
                                "body"        => $request->body,
                                "created_at"  => date('Y-m-d H:i:s'),
                            ]
                        ];
                        $dataString = json_encode($data);
                        $headers = [
                            'Authorization: key=' . $SERVER_API_KEY,
                            'Content-Type: application/json',
                        ];
                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
                        curl_setopt($ch, CURLOPT_POST, true);
                        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
                        $response = curl_exec($ch);
                    }

                    $Pushnotifications = new Pushnotification();
                    $Pushnotifications->title = $request->title;
                    $Pushnotifications->body = $request->body;
                    $Pushnotifications->user_id = $user;
                    $Pushnotifications->save();
                }
            }
            return back()->with('message','Data added Successfully');
        }
        catch (\Exception $e){
                return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            }

    }


    // read notification by id
    public function readNotification($id)
    {
        if ($id )
        {
            Auth::user()->unreadNotifications->where('id', $id)->markAsRead();
        }
        return view ('Pages.Users.profile');

    }
}

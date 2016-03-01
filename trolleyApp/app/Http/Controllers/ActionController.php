<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Sentinel;
use App\User;
use App\Feedback;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ActionController extends Controller
{
    public function newfeedback(Request $request){
        $this->validate($request, [
            'feedback' => 'required|min:10'
        ]);
        $user = Sentinel::check();
        $user = User::findorfail($user->id);
        if($request->ajax())
        {
            $feedback = ['user_id'=>$user->id, 'feedback'=>$request->feedback];
            
            $hasfeedback = Feedback::where('user_id', $user->id)->first();

            if($hasfeedback){
                $hasfeedback->feedback = $request->feedback;
                $hasfeedback->save();
            }
            else
            {
                Feedback::create($feedback);
            }
            return response()->json(['success'=>'posted feedback']);
        }
        return redirect()->route('home');
    }
}

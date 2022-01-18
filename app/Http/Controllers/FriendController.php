<?php


namespace chatty\Http\Controllers;
use Illuminate\Http\Request;
use chatty\Models\User;
use DB;
use Auth;

/**
* 
*/
class FriendController extends Controller
{
    	public function getIndex (){

        $friends=Auth::user()->friends();
        $requests=Auth::user()->friendRequests();

        return view('friends.index')
        ->with('friends',$friends)
        ->with('requests',$requests);
      }

      public function getAdd($username){
       
         $user=User::where('username',$username)->first();
         if (!$user) {
           return redirect()->route('home')->with('info','this user cant be found');
         }

         if (Auth::user()->id ==$user->id) {
           return redirect()->route('home');
         }
         if (Auth::user()->hasFriendRequestsPending($user)||$user->hasFriendRequestsPending(Auth::user())) {
            return redirect()->route('profile.index',['username'=>$user->username])->with('info','friend Request already pending');       
          }
          if (Auth::user()->isFriendsWith($user)) {
            return redirect()->route('profile.index',['username'=>$user->username])->with('info','You Are already friends');     
               }
               Auth::user()->addFriend($user);
             return redirect()->route('profile.index',['username'=>$user->username])->with('info','friend Request Sent -_-');     
              
       }

       public function getAccept($username){

          $user=User::where('username',$username)->first();

         if (!$user)
          {
           return redirect()->route('home')->with('info','this user cant be found');
          }
        if (!Auth::user()->hasFriendRequestsReceived($user)) {
            return redirect()->route('home');       
          }
          Auth::user()->acceptFriendRequest($user);
          return redirect()->route('profile.index',['username'=>$username])->with('info','friend Request accepted');

       }

       public function postDelete($username){

        $user=User::where('username',$username)->first();
        if (!Auth::user()->isFriendsWith($user)) {
            return redirect()->back(); 
       }

        Auth::user()->deleteFriend($user);
         return redirect()->back()->with('info','Friend Deleted (-_-) ');
       }
 
}

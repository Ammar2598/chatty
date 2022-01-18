<?php


namespace chatty\Http\Controllers;
use Auth;
use chatty\Models\Status;

/**
* 
*/
class HomeController extends Controller
{
	
	public function index(){

   if (Auth::check()) {
   $Statuses=Status::notReply()->where(function($query){
    return $query->where('user_id',Auth::user()->id)
                 ->orWhereIn('user_id',Auth::user()->friends()
                 ->pluck('id'));

   })->orderBy('created_at','desc')->paginate(7);
   
   return view ('timeline.index')->with('statuses',$Statuses);

   }

		return view('home');

	}
}

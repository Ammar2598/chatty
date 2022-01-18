
@extends('templates.default')

@section('content')
<center>
<div class="row">
 <div class="col-lg-5">

@include('user.partials.userblock')
 <hr>
   
  @if(!$statuses->count())
      <p>{{ $user->getNameOrUsername() }} hasn't posted anything yet </p>
   @else
     @foreach($statuses as $status)
        <div class="media">
           <a href=" {{ route('profile.index',['username'=>$status->user->username]) }} " class="pull-left">
             <img class="media-object" alt="{{ $status->user->getFirstNameOrUsername() }}" src=" {{ $status->user->getAvatarUrl() }} ">

           </a>
           <div class="media-body">
             <h4 class="media-heading"><a href="{{ route('profile.index',['username'=>$status->user->username]) }} ">{{ $status->user->getNameOrUsername() }}</a></h4>
             <p> {{ $status->body }} </p>
             <ul class="list-inline">
               <li class="list-inline-item">{{ $status->created_at->diffForHumans() }}</li>
                 @if($status->user->id !== Auth::user()->id)
                 <li class="list-inline-item"><a href=" {{ route('status.like',['statusId'=>$status->id]) }} ">like</a></li>
                 @endif
                  <li class="list-inline-item">{{$status->likes->count()}} {{str_plural('like','$status->likes->count()')}}</li>
             </ul>
      @foreach($status->replies as $reply)
        <div class="media">
             <a href=" {{ route('profile.index',['username'=>$reply->user->username]) }} " class="pull-left">
               <img class="media-object" alt=" {{ $reply->user->getNameOrUsername() }} " src=" {{ $reply->user->getAvatarUrl() }} ">
             </a>
             <div class="media-body">
               <h5 class="media-heading"><a href="  {{ route('profile.index',['username'=>$reply->user->username]) }}">{{ $reply->user->getNameOrUsername() }}</a></h5>
               <p> {{ $reply->body }} </p>
               <ul class="list-inline">
                 <li class="list-inline-item">{{ $reply->created_at->diffForHumans() }}</li>
                 @if($reply->user->id !== Auth::user()->id)
                 <li class="list-inline-item"><a href="{{ route('status.like',['statusId'=>$reply->id]) }}">like</a></li>
                 @endif
                   <li class="list-inline-item">{{$reply->likes->count()}} {{str_plural('like','$reply->likes->count()')}}</li>
               </ul>
             </div>
          </div>
      @endforeach
      @if($authUserIsFriend || Auth::user()->id === $status->user_id )
         <form role="form" action="{{ route('status.reply',['statusId'=>$status->id]) }}" method="post">
          <div class="form-group">
            
             <textarea name="reply-{{$status->id}}" class="form-control" row="2" placeholder="Reply to this status"></textarea>

            @if($errors->has("reply-{$status->id}"))
              <span class="help-block text-danger"> {{ $errors->first("reply-{$status->id}") }} </span>
            @endif
             <input type="submit" value="replay" class="btn btn-primary btn-sm">
          </div>
             <input type="hidden" name="_token" value="{{ Session::token() }} ">
         </form>
         @endif 
           </div>
        </div>
     @endforeach
    
   @endif

 </div>
 <div class="col-lg-4 col-lg-offset-3" >
 	@if(Auth::user()->hasFriendRequestsPending($user))
 	<p>Waiting For {{ $user->getFirstNameOrUsername() }} to accecpt Your request</p>
 	@elseif(Auth::user()->hasFriendRequestsReceived($user))

 	<a href="{{ route('friend.accept',['username'=>$user->username]) }}" class="btn btn-primary">Accept Friend Request</a>

 	@elseif(Auth::user()->isFriendsWith($user))
 	<h4>You And {{ $user->getFirstNameOrUsername() }} Are Friends</h4>
      <form action=" {{ route('friend.delete',['username'=>$user->username]) }} " method="post">
       <input type="submit" value="Delete Friend" class="btn btn-danger">
       <input type="hidden" name="_token" value="{{ csrf_token() }} ">
      </form>
 	@elseif(Auth::user()->id !==$user->id)
 	<a href="{{ route('friend.add',['username'=>$user->username]) }}" class="btn btn-primary">Add As Friend </a>

    @endif
 	<h4> {{ $user->getFirstNameOrUsername() }}'s friends </h4>

		  @if(!$user->friends()->count())
		   <p> {{ $user->getFirstNameOrUsername() }} has no friends </p>
		  @else
		  @foreach($user->friends() as $user)
		  @include('user.partials.userblock')
		  <br>
		  @endforeach
		  @endif

 </div>
</div>
</center>

@stop








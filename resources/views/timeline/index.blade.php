@extends('templates.default')

@section('content')
 <div class="row">
  <div class="col-lg-6">
   <form role="form" action=" {{ Route('status.post') }} " method="post">
   <div class="form-group">
   	<br>
   
     <TEXTAREA placeholder="what's up {{Auth::user()->getFirstNameOrUsername()}} ?" name="status" class="form-control" row="2"></TEXTAREA>
     @if($errors->has('status'))
     <span class="help-block text-danger"> {{ $errors->first('status') }} </span>
     @endif
      <br>
      <button type="submit" class="btn btn-primary"> Update Status</button>
      <input type="hidden" name="_token" value=" {{ Session::token() }} ">
   </div> 

   </form>
  </div>
 </div>

 <div class="row">
  <div class="col-lg-5">
   @if(!$statuses->count())
      <p>there is nothing in your timeline </p>
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
           </div>
        </div>
     @endforeach
     {!! $statuses->render() !!}
   @endif
  </div>
 </div>


@stop
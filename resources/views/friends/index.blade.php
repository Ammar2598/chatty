@extends('templates.default')

@section('content')
 <center>
<div class="row">
 <div class="col-lg-6">
<h4> Your Friends </h4>
<hr>
          @if(!$friends->count())
		   <p> you have no friends </p>
		  @else
		  @foreach($friends as $user)
		  @include('user.partials.userblock')
		  <br>
		  @endforeach
		  @endif


 </div>
 <div class="col-lg-4 col-lg-6" >
 	<h4>Friend requests</h4>

 	 <hr>
 	  @if(!$requests->count())
		   <p> you have no requests </p>
		  @else
		  @foreach($requests as $user)
		  @include('user.partials.userblock')
		  <br>
		  @endforeach
		  @endif
 </div>
</div>
</center>

@stop
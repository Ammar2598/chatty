@extends('templates.default')

@section('content')
<center>
	<h1>UPDATE YOUR  PROFILE</h1>
</center>
<div class="row">
 <div class="col-lg-6">

<form class="form-vertical" role="form" method="post" action=" {{ route('profile.edit') }} ">
  <div class="form-group row">
    <label for="first_name" class="col-sm-2 col-form-label">first name</label>&nbsp;&nbsp;
    <div class="col-sm-10">
      <input type="text"  class="form-control" name="first_name" value=" {{ Request::old('first_name') ?: Auth::user()->first_name }} 
      " placeholder="first name">
    @if($errors->has('first_name'))
     <span> {{ $errors->first('first_name') }} </span>
    @endif
    </div>
    <div class="form-group row">
    <label for="last_name" class="col-sm-2 col-form-label">last name</label>&nbsp;&nbsp;
    <div class="col-sm-10">
      <input type="text"  class="form-control" name="last_name" value="{{ Request::old('last_name') ?:  Auth::user()->last_name}} "
       placeholder="last name">
    @if($errors->has('last_name'))
     <span> {{ $errors->first('last_name') }} </span>
    @endif
    </div>
  </div>
  <div class="form-group row">
    <label for="location" class="col-sm-2 col-form-label">location</label>&nbsp;&nbsp;
    <div class="col-sm-10">
      <input type="text" class="form-control" name="location" placeholder="location" value="{{ Request::old('location') ?: Auth::user()->location }} ">
@if($errors->has('location'))
     <span> {{ $errors->first('location') }} </span>
    @endif
    </div>
  </div>

  <div class="form-group row">
   <button >Update</button>
  </div>

  <input type="hidden" name="_token" value =" {{ Session::token() }} ">
</form>

 </div>
</div>

@stop
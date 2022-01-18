@extends('templates.default')

@section('content')

<form class="form-horizontal" action= "{{ route('auth.signup') }}" method="POST">
  <fieldset>
  	<center>
      <div id="legend">
      <legend class="">Register</legend>
      </div>
  	</center>
    
    <div class="control-group {{$errors->has('username')?'text-danger':''}}">
      <!-- Username -->
      <label class="control-label"  for="username" >Username</label>
      <div class="controls">
        <input type="text" id="username" name="username" placeholder="" class="input-xlarge" value="{{ old('username') }}" autocomplete="false" >
        @if($errors->has('username'))
        <p class="help-block"> {{ $errors->first('username') }} </p>
        @endif
      </div>
    </div>
 
    <div class="control-group {{$errors->has('email')?'text-danger':''}}">
      <!-- E-mail -->
      <label class="control-label" for="email">E-mail</label>
      <div class="controls">
        <input type="text" id="email" name="email" placeholder="" class="input-xlarge" value="{{ Request::old('email') }}"autocomplete="false">
        @if($errors->has('email'))
        <p class="help-block"> {{ $errors->first('email') }} </p>
        @endif
      </div>
    </div>
 
    <div class="control-group {{$errors->has('password')?'text-danger':''}}">
      <!-- Password-->
      <label class="control-label" for="password">Password</label>
      <div class="controls">
        <input type="password" id="password" name="password" placeholder="" class="input-xlarge" >
      @if($errors->has('password'))
        <p class="help-block"> {{ $errors->first('password') }} </p>
        @endif
      </div>
    </div>
 <br>
    
 
    <div class="control-group">
      <!-- Button -->
      <div class="controls">
       <input type="submit" name="submit" value="register" class="form-control">

      </div>
    </div>

   
    </fieldset>
    <input type="hidden" name="_token" value="{{Session::token() }}">
        </form>

@stop
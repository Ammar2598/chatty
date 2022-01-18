<style>
  .topnav {
  background-color: #333;
  overflow: hidden;
  height: 70px;
}
.topnav a {
  float: left;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}
.topnav a:hover {
  background-color: #ddd;
  color: black;
}
.topnav a.active {
  background-color: #04AA6D;
  color: white;

  .searchnav {
  overflow: hidden;
  background-color: #e9e9e9;
}
.form-groupe {
 right: 0px;
 top: 120px;
}
}
</style>
<nav  class="topnav navbar navbar-expand-sm ">
<div class="container">

 <div class="navbar-header">
  <a class="navbar-brand" href="{{ route('home') }}">chatty</a>
 </div>
 <div class="collapse navbar-collapse">
@if(Auth::check())
   <ul class="nav navbar-nav">
    <li><a href="{{ route('home') }}">Timline</a></li><br>
    <li><a href=" {{ route('friend.index') }} ">Friends</a></li><br>
   </ul>
   
   @endif
   <ul  class="nav2 nav navbar-nav" >
    @if(Auth::check())
    <li><a href=" {{ route('profile.index' ,['username'=>Auth::user()->username]) }} ">{{Auth::user()->getNameOrUsername()}}</a></li>
    <li><a href="{{ route('profile.edit')}}">Update profile</a></li>
    <li><a href="{{ route('auth.signout') }}">sign out</a></li>
    @else
    <li><a href="{{ route('auth.signup') }}">sign up</a></li>
    <li><a href="{{ route('auth.signin') }}">sign in</a></li>
     @endif

     <form class=" searchnav "  role="search" action="{{ route('search.results') }}">
     <div class="form-groupe" >
      <input type="text" name="query" class="form-control" placeholder="find people">
     </div>
     <button type="submit" class="btn btn-primary"> search</button>
   </form>
   </ul>
 </div>
</div>
</nav>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="{{ URL::asset('/css/all.css') }}" />

</head>
<body>
	<div>
		<nav class="navbar navbar-default navbar-fixed-top">
		  <div class="container">
		    <div class="navbar-header">
		      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span> 
		      </button>
		      <a class="navbar-brand" href="list-match">Socer bet</a>
		    </div>
		    <div class="collapse navbar-collapse" id="myNavbar">
		      <ul class="nav navbar-nav navbar-right">
		      	<li>
		        	<a href="../user/list-match" target="_self"> user </a> </li>
		        <li>
		        	<a href="public-list-match" target="_self"> list public match </a> </li>
		        <li> <a href="create-match" target="_self"> create match </a></li>
		        <li> <a href="	update-score" target="_self"> update score </a> </li>
                <li>
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
		      </ul>
		    </div>
		  </div>
		</nav>
	</div>

	<div style="margin: 150px; margin-left: 350px;">
	    @if (count($errors) > 0)
	      <div class="alert alert-danger">
	          <h4> Error!!! </h4>
	          <ul>
	              @foreach ($errors->all() as $error)
	                  <li>{{ $error }}</li>
	              @endforeach
	          </ul>
	      </div>
	    @endif
		<table border = "1px" cellpadding = "5px">
	     	<tr>
		      	<th  colspan = "2"> Home </th>
		     	<th  colspan = "2"> draw</th>
		     	<th  rowspan = 2 colspan = "1"> Time start match </th>
		      	<th   rowspan = 2 colspan = "1"> time end match </th>
	      	</tr>
	     	<tr>
		      	<th  colspan = "1"> name </th>
		     	<th  colspan = "1"> score </th>
		     	<th  colspan = "1"> score </th>
		      	<th  colspan = "1"> name </th>
	      	</tr>

	      	@foreach ($matches as $match)
	      	@if ($match->home_score == null)
	     	<tr>
	     	<form action="update-score/{{$match->id}}" method="post">
	     	{{csrf_field()}}
		      	<th  colspan = "1"> {{$match->home}} </th>
		     	<th class="input-score" colspan = "1">
		     		@if ($match->time_end_match < $time_now)
		     		<input type="text" name="home_score" style="width: 100px;">
		     		@else 
		     		------
		     		@endif
		     	</th>
		     	<th class="input-score" colspan = "1"> 	
		     		@if ($match->time_end_match < $time_now)
		     		<input type="text" name="away_score" style="width: 100px;">
		     		@else 
		     		------
		     		@endif
		     	</th>
		      	<th  colspan = "1"> {{$match->away}}  </th>
		      	<th  colspan = "1"> {{$match->time_start_match}}  </th>
		      	<th  colspan = "1">  {{$match->time_end_match}}</th>
		      	<th  colspan = "1"> <input type="submit" name="submit" value="update" class="btn btn-primary"> </th>
		    </form>
	      	</tr>
	      	@endif
	      	@endforeach

	    </table>

	</div>
</body>
</html>
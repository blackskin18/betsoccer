<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="{{ URL::asset('/css/all.css') }}" />
</head>
<body>
<div>
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

	<h3> admin - list match</h3>
	<div id = "content">
		<table border = "1px" cellpadding = "5px">
	     	<tr>
		      	<th  colspan = "1"> Home </th>
		     	<th  colspan = "1"> draw</th>
		     	<th  colspan = "1"> away </th>
		      	<th  colspan = "1"> time start match </th>
		        <th  colspan = "1"> time end match </th>
		      	<th  colspan = "1"> closing bet time </th>
	      	</tr>
	      	
			@foreach ($matches as $match)
				@if ($match->public == 0)

	    	<tr>
		      	<th  colspan = "1"> {{$match->home}} - rate: {{$match->home_rate}} </th>
		     	<th  colspan = "1"> draw - Rate:{{$match->draw_rate}}</th>
		     	<th  colspan = "1"> {{$match->away}} - rate: {{$match->away_rate}} </th>
		      	<th  colspan = "1"> {{$match->time_start_match}} </th>
		        <th  colspan = "1"> {{$match->time_end_match}}  </th>
		      	<th  colspan = "1">	{{$match->closing_bet_time}} </th>
		      	<th  colspan = "1"> 
		      		<a href="public-match/{{$match->id}}" target="_self" class="btn btn-primary"> public </a>
		      	</th>
		      	<th  colspan = "1">
		      		
		      		 <a href="edit-match/{{$match->id}}" target="_self" class="btn btn-primary"> edit </a> 
		      	</th>
		        <th  colspan = "1"> 
		        	<a href="delete-match/{{$match->id}}" target="_self" class="btn btn-primary">	delete </a> 
		        </th>
	     	</tr>
		     	@endif
	    	@endforeach
	    </table>
	</div>
</div>
</body>
</html>
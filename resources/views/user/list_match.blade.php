<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="{{ URL::asset('/css/all.css') }}" />
</head>
<body>
    {{ csrf_field() }}
	<div>
		<nav class="navbar navbar-default navbar-fixed-top">
		  <div class="container">
		    <div class="navbar-header">
		      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span> 
		      </button>
		      <a class="navbar-brand" href="list-match">Soccer Bet</a>
		    </div>
		    <div class="collapse navbar-collapse" id="myNavbar">
		      <ul class="nav navbar-nav navbar-right">
		      	@if (Auth::user()->level == 0)
		      		<li> <a> {{Auth::user()->name}} </a> </li>
		      	@else
		      		<li> <a href="../admin/list-match" target="_self"> admin </a> </li>
		      	@endif
		        <li> <a href="user-info" target="_self"> user info </a> </li>
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

<h3> List match </h3>
	
	<div id = "content">
		<table border = "1px" cellpadding = "5px">
	     	<tr>
		      	<th  colspan = "1"> Home </th>
		     	<th  colspan = "1"> draw</th>
		     	<th  colspan = "1"> away </th>
		      	<th  colspan = "1"> time start match </th>
		        <th  colspan = "1"> time end match </th>
		      	<th  colspan = "1"> closing bet time </th>
		      	<th  colspan = "1"> </th>
		      	<th  colspan = "1"> </th>
	      	</tr>
			@foreach ($matches as $match)
				@if ($match->public == 1)
					@if ($match->closing_bet_time >= $time_now)
				    	<tr>
					      	<th  colspan = "1"> {{$match->home}} - rate: {{$match->home_rate}} </th>
					     	<th  colspan = "1"> draw - Rate:{{$match->draw_rate}}</th>
					     	<th  colspan = "1"> {{$match->away}} - rate: {{$match->away_rate}} </th>
					      	<th  colspan = "1"> {{$match->time_start_match}} </th>
					        <th  colspan = "1"> {{$match->time_end_match}}  </th>
					      	<th  colspan = "1">	{{$match->closing_bet_time}} </th>
					        <th  colspan = "1"> 
					       <?php
					       $a=Auth::user()->id
					       ?>
					        	<a href="bet-match/{{$a}}/{{$match->id}}"  class="btn btn-primary">Bet match </a>
					        </th>
					      	<th  colspan = "1"> 
					      		<a href="match-info/{{$match->id}}"  class="btn btn-primary">match info</a>
					      	</th>
				     	</tr>
				     @else
				     		<tr style="color: red">
					      	<th  colspan = "1"> {{$match->home}} - rate: {{$match->home_rate}} </th>
					     	<th  colspan = "1"> draw - Rate:{{$match->draw_rate}}</th>
					     	<th  colspan = "1"> {{$match->away}} - rate: {{$match->away_rate}} </th>
					      	<th  colspan = "1"> {{$match->time_start_match}} </th>
					        <th  colspan = "1"> {{$match->time_end_match}}  </th>
					      	<th  colspan = "1">	{{$match->closing_bet_time}}
					        <th  colspan = "1"> 
						        <?php
						        $a=Auth::user()->id
						        ?>
					        	<a href="#"  class="btn btn-primary" disabled="true" title="can't bet">Bet match </a>
					        </th>
					      	<th  colspan = "1"> 
					      		<a href="match-info/{{$match->id}}"  class="btn btn-primary">match info</a>
					      	</th>
				     	</tr>
				     	@endif
		     	@endif
	    	@endforeach
	    </table>
	</div>

</body>
</html>
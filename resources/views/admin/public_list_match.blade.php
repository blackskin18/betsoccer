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
	<h3> List public matches</h3>
	<div id = "content">
		<table border = "1px" cellpadding = "5px">
	     	<tr> 
	     		<th  colspan = "1"> </th>
		      	<th  colspan = "1"> Home </th>
		     	<th  colspan = "1"> draw</th>
		     	<th  colspan = "1"> away </th>
		      	<th  colspan = "1"> time start match </th>
		        <th  colspan = "1"> time end match </th>
		      	<th  colspan = "1"> closing bet time </th>

	      	</tr>
	      	<?php
	      	use Carbon\Carbon;
	      	$time_now = new Carbon();
	      	$sum = 0;
	      	?>
			@foreach ($matches as $match)
				@if ($match->public == 1)
		    	<tr>
		    		@if ($match->time_end_match < $time_now )
		    		<th  colspan = "1"> <b style="color: red">done</b></th>
		    		@else
		    		<th  colspan = "1"></th>
		    		@endif
			      	<th  colspan = "1"> {{$match->home}} - rate: {{$match->home_rate}} </th>
			     	<th  colspan = "1"> draw - Rate:{{$match->draw_rate}}</th>
			     	<th  colspan = "1"> {{$match->away}} - rate: {{$match->away_rate}} </th>
			      	<th  colspan = "1"> {{$match->time_start_match}} </th>
			        <th  colspan = "1"> {{$match->time_end_match}}  </th>
			      	<th  colspan = "1">	{{$match->closing_bet_time}} </th>
			        <th  colspan = "1">
			        <?php 
			        $i = 0;
			         ?>
			        @foreach ($user_matches as $user_match)
			        	@if($user_match->match_id == $match->id)
			        		<?php $i = $i + 1 ?>	
			        	@endif
			        @endforeach
					@if ($i == 0)
			        	<a href="delete-public-match/{{$match->id}}" target="_self" class="btn btn-primary"> delete </a>
			        @else
			        	<a href="delete-public-match/{{$match->id}}" target="_self" class="btn btn-primary" disabled="true" title="can't delete"> delete </a>
			        @endif
			        </th>
			      	<th  colspan = "1"> <a href="match-info/{{$match->id}}" target="_self" class="btn btn-primary"> info </a> </th>
		     	</tr>
		     	@endif
	    	@endforeach
	    </table>

	</div>

</body>
</html>
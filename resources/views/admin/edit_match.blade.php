<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="{{ URL::asset('/css/all.css') }}" />
	<link rel="stylesheet" href="{{ URL::asset('/css/admin/create_match.css') }}" />
</head>
<body>
<div id="body">
	<div>
		<nav class="navbar navbar-default navbar-fixed-top">
		  <div class="container">
		    <div class="navbar-header">
		      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span> 
		      </button>
		      <a class="navbar-brand" href="../list-match">Socer bet</a>
		    </div>
		    <div class="collapse navbar-collapse" id="myNavbar">
		      <ul class="nav navbar-nav navbar-right">
		      	<li>
		        	<a href="../../user/list-match" target="_self"> user </a> </li>
		        <li>
		        	<a href="../public-list-match" target="_self"> list public match </a> </li>
		        <li> <a href="../create-match" target="_self"> create match </a></li>
		        <li> <a href="../update-score" target="_self"> update score </a> </li>
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
	<h3>Edit match: <b style="color: red"> {{$match->home}} </b> vs 
					<b style="color: red"> {{$match->away}} </b>
					<br> time to start: <b style="color: red"> {{$match->time_start_match}} </b>
	</h3 >
	<div id="errors">
	<b style="color: red"> 
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
	</b>
	</div>
	 <?php 	
    $noti = 'errors in here'
     ?>
	<div id="content">
		<form action="edit/{{$id}}" class="form-horizontal" method="post">
		{{ csrf_field() }}
		<div class="form-group {{ $errors->has('home_name') ? 'has-error' : '' }} ">
		    <label class="control-label col-sm-2" for="text">Home:</label>
		    <div class="col-sm-10">
		      	<input type="text" class="form-control" id="text" placeholder="Enter name's home team" name="home_name" value="{{$match->home}}">
		      	<span class="text-danger">
	      			@if ($errors->first('home_name') != null)
	      				{{$noti}}
	      			@endif
	      		</span>
		    </div>
  		</div>
  		<div class="form-group  {{ $errors->has('away_name') ? 'has-error' : '' }} ">
		    <label class="control-label col-sm-2" for="text">Away:</label>
		    <div class="col-sm-10">
		      	<input type="text" class="form-control" id="text" placeholder="Enter name's away team" name="away_name" value="{{$match->away}}">
	      		<span class="text-danger">
	      			@if ($errors->first('away_name') != null)
	      				{{$noti}}
	      			@endif
	      		</span>
		    </div>
  		</div>
  		<div class="form-group {{ $errors->has('closing_bet_time') ? 'has-error' : '' }}">
		    <label class="control-label col-sm-2" for="text">Closing time bet:</label>
		    <div class="col-sm-10">
		      	<input name="closing_bet_time" class="form-control" id="text" placeholder="clossing bet time"  value="{{$match->closing_bet_time}}" >
		      	<span class="text-danger">
	      			@if ($errors->first('closing_bet_time') != null)
	      				{{$noti}}
	      			@endif
	      		</span>
		    </div>
  		</div>
  		<div class="form-group {{ $errors->has('time_end_match') ? 'has-error' : '' }}">
		    <label class="control-label col-sm-2" for="text">time end match:</label>
		    <div class="col-sm-10">
		      	<input name="time_end_match" class="form-control" placeholder="time to end match"  value="{{$match->time_end_match}}">
		      	<span class="text-danger">
	      			@if ($errors->first('time_end_match') != null)
	      				{{$noti}}
	      			@endif
	      		</span>
		    </div>
  		</div>
  		<div id="rate">
			<h5> rate: </h5><br>
			<div id="input_rate">
					home rate 	<input type="text" name="home_rate" class="rate" placeholder="Enter home rate" value="{{$match->home_rate}}"/>
							      	<span class="text-danger">
						      			@if ($errors->first('home_rate') != null)
						      				{{$noti}}
						      			@endif
						      		</span>
					draw rate	<input type="text" name="draw_rate" class="rate" placeholder="Enter draw rate" value="{{$match->draw_rate}}"/>
									<span class="text-danger">
						      			@if ($errors->first('draw_rate') != null)
						      				{{$noti}}
						      			@endif
						      		</span>
					away rate	<input type="text" name="away_rate" class="rate" placeholder="Enter away rate" value="{{$match->away_rate}}"/>
									<span class="text-danger">
						      			@if ($errors->first('away_rate') != null)
						      				{{$noti}}
						      			@endif
						      		</span><br>
			</div>
		</div>
			<input type="submit" name="submit" value="submit">
		</form>
	</div>
</div>
</body>
</html>
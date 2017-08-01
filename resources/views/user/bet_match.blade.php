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
		      <a class="navbar-brand" href="../../list-match">Soccer Bet</a>
		    </div>
		    <div class="collapse navbar-collapse" id="myNavbar">
		      <ul class="nav navbar-nav navbar-right">
		      	@if (Auth::user()->level == 0)
		      		<li> <a> {{Auth::user()->name}} </a> </li>
		      	@else
		      		<li> <a href="../../../admin/list-match" target="_self"> admin </a> </li>
		      	@endif
		        <li> <a href="../../user-info" target="_self"> user info </a> </li>
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
<div style="width: 700px;
			margin: 130px;
			margin-left: 300px;">

	<h3 style="text-align: center; margin-left: 100px"> 
		<b style="color: red;"> 
			{{$match[0]->home}} 
		</b> vs 
		<b style="color: red">
		 	{{$match[0]->away}} 
		</b> 
	</h3>
	<h3 style="margin-top: 0px; text-align: center;  margin-left: 100px">
		Rate: {{$match[0]->home_rate}} - {{$match[0]->draw_rate}} - {{$match[0]->away_rate}} 
	</h3>
	<h3 style="margin-top: 0px;text-align: center;  margin-left: 100px"> 
		sum money: {{Auth::user()->sum_money}} APC
	</h3>
	@if (count($errors) > 0)
		      <div class="alert alert-danger">
		          <h4> error!!! </h4>
		          <ul>
		                @foreach ($errors->all() as $error)
			                <li>{{ $error }}</li>
			            @endforeach
		          </ul>
		      </div>
	@endif
	<form class="form-horizontal" action="{{$match_id}}" method="post">
	    {{ csrf_field() }}
	    <div class="form-group">
	      	<label class="control-label col-sm-2" for="text">Money bet:</label>
	      	<div class="col-sm-10">
	        	<input type="text" class="form-control" id="text" placeholder="Enter email" name="money_bet" value="{{ old('money_bet') }}">
	      	</div>
	    </div>
	    <div class="form-group">
	      	<label class="control-label col-sm-2" for="email">Bet For:</label>
	      	<div class="col-sm-10">
				<input name="bet_for" type="radio" value="1" />Home<br />
				<input name="bet_for" type="radio" value="0" />Draw<br />
				<input name="bet_for" type="radio" value="-1" />Away<br />
	      	</div>
	    </div>
		<input type="submit" name="submit" value="submit" style="font-size: 20px;background: red;color: white;padding: 7px;margin: 10px;margin-left: 200px;border-radius: 10px; ">
	</form>
</div>


</body>
</html>
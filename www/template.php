<html>
	<head>
		<title>Wildbook</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- will use bootstrap later -->
		<link href = "css/bootstrap.css" rel = "stylesheet">
	</head>
	<body>
	<nav class="navbar navbar-default" role="navigation">
		<div class="container-fluid">
		  <ul class="nav navbar-nav">
			<li>
		  		<a href="home.php">
				<button id="home" type="button" class="btn btn-default btn-lg">
				<span class="glyphicon glyphicon-home"></span>
				</button>
				</a>
				<style>
				#home {
					background-color: hsl(221, 69%, 37%) !important;
					background-repeat: repeat-x;
					filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#3d6fdb", endColorstr="#1d469f");
					background-image: -khtml-gradient(linear, left top, left bottom, from(#3d6fdb), to(#1d469f));
					background-image: -moz-linear-gradient(top, #3d6fdb, #1d469f);
					background-image: -ms-linear-gradient(top, #3d6fdb, #1d469f);
					background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #3d6fdb), color-stop(100%, #1d469f));
					background-image: -webkit-linear-gradient(top, #3d6fdb, #1d469f);
					background-image: -o-linear-gradient(top, #3d6fdb, #1d469f);
					background-image: linear-gradient(#3d6fdb, #1d469f);
					border-color: #1d469f #1d469f hsl(221, 69%, 32.5%);
					color: #fff !important;
					text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.29);
					-webkit-font-smoothing: antialiased;
				}
				</style>
			</li>
			<li class="profile"><a href="profile.php">Profile</a></li>
			<li class="dropdown">
			  <a href="#" class="dropdown-toggle" data-toggle="dropdown">More <b class="caret"></b></a>
			  <ul class="dropdown-menu">
				<li><a href="friends.php">Friends</a></li>
				<li><a href="locations.php">Locations</a></li>
				<li><a href="activities.php">Activities</a></li>
			  </ul>
			</li>
		  </ul>
		  <form class="navbar-form navbar-left" role="search">
			<div class="form-group">
			  <input type="text" class="form-control" placeholder="Search">
			</div>
			<button type="submit" class="btn btn-default">Submit</button>
		  </form>
		  <ul class="nav navbar-nav navbar-right">
			<li>
				<a href="postDiary.php">
				<button type="button" class="btn btn-default btn-md">
				<span class="glyphicon glyphicon-plus"></span> Post New Diary
				</button>
				</a>
			</li>
			<li>
				<a href="postActivity.php">
				<button type="button" class="btn btn-default btn-md">
				<span class="glyphicon glyphicon-plus"></span> Post New Activity
				</button>
				</a>
			</li>
			<li class="dropdown">
			  <a class="dropdown-toggle" data-toggle="dropdown">Settings <b class="caret"></b></a>
			  <ul class="dropdown-menu">
				<li><a href="account.php">Change Profile</a></li>
				<li><a href="password.php">Change password</a></li>
				<li class="divider"></li>
				<li><a href="logout.php">Log Out</a></li>
			  </ul>
			</li>
			
		  </ul>
		</div>
	</nav>
	<style>
	.navbar .nav > li > a {
		@elementHeight: 20px;
		padding: ((@navbarHeight - @elementHeight) / 2 - 1) 10px ((@navbarHeight - @elementHeight) / 2 + 1);
		line-height: 35px;
	}
	.navbar-form {
		@elementHeight: 20px;
		padding: ((@navbarHeight - @elementHeight) / 2 - 1) 10px ((@navbarHeight - @elementHeight) / 2 + 1);
		line-height: 45px;
	}
	</style>
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.js"></script>

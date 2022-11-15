<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}
?>
<!DOCTYPE html>
<html>
<head>
		<meta charset="utf-8">
		<title>Home Page</title>
		<link href="style.css?ts=<?=time()?>" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	</head>
	<body class="loggedin">
		<div class="ninja">
	 
		<nav class="navtop">
			<div>
				<h1>OmniShea</h1>
				<a href="submit.php"><i class="fa fa-plus-circle" aria-hidden="true"></i>Create Post</a>
				<a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
		</nav>

		</div>
		<div class="home">
	<div class="content-container">
		<?php
		
		function timeSince($times) {
			date_default_timezone_set('Asia/Kolkata');
			$time = time() - $times; // to get the time since that moment
			$time = ($time<1)? 1 : $time;
			// echo '<h1> '.time()." - ".$times." - ".$time. '</h1>';
			$tokens = array (31536000 => 'year', 2592000 => 'month', 604800 => 'week', 86400 => 'day', 3600 => 'hour', 60 => 'minute', 1 => 'second');//73446
			foreach ($tokens as $unit => $text) {
				if ($time < $unit) continue;
				$numberOfUnits = floor($time / $unit);
				return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
			}
		}

		$link = mysqli_connect("localhost", "root", "", "phplogin");
		$query = "SELECT postid, postuser, postcontent, postts, posttitle, upvotes,postscore, postimage ,downvotes FROM post ORDER BY postid DESC";
		//ORDER BY log10(abs(upvotes-downvotes) + 1)*sign(upvotes-downvotes)+(unix_timestamp(postts)/300000) DESC";
		$result = mysqli_query($link, $query);
		if ($link === false) {
			die("ERROR: Could not connect. " . mysqli_connect_error());
		}
		//each post gets on Home page
		if(mysqli_query($link, $query)) {
			while ($row = mysqli_fetch_array($result))
			{
				$id = htmlspecialchars($row['postid'], ENT_QUOTES, 'UTF-8');
				$username = htmlspecialchars($row['postuser'], ENT_QUOTES, 'UTF-8');
				$title = htmlspecialchars($row['posttitle'], ENT_QUOTES, 'UTF-8');
				$content=htmlspecialchars($row['postcontent'], ENT_QUOTES, 'UTF-8');
				$score = htmlspecialchars($row['postscore'], ENT_QUOTES, 'UTF-8');
				$postts= htmlspecialchars($row['postts'], ENT_QUOTES, 'UTF-8');
				$postimage=htmlspecialchars($row['postimage'], ENT_QUOTES, 'UTF-8');
				echo '<div class="home2">';
				echo '<div class="row" id="post_' . $id  . '"' . '>
						<div class="score-container">

						<form method="POST" id= "votearrow"  ' . '">
							<input name="updoot" class="upvoteinput" type="image" id="updoot-'.  $id  . '" value="updoot" src="images/upvote.gif"/>
						</form>

						<br>

						<span class="score">' . $score . '</span>

						<form method="post" id="votearrow"  ' . '">
							<input name="downdoot" class="upvoteinput" type="image" id="downdoot-'. $id . '" value="downdoot" src="images/downvote.gif"/>
						</form>

						<br>

						</div>

						<div class="post-container">';
						
						echo '<p id="submission-info">
						
						<i class="fa fa-user"></i><a href="?profile= '. $username . '">' .' '. $username . '</a> ';
						
						echo timeSince($postts). ' ago, ';
						
					
						echo '<br>';
						 
						
						echo '<a href="viewpost.php?postid=' . $id . '">' . $title . ' </a> <br>';
						if($content!=null) {
							echo '<a href="viewpost.php?postid=' . $id . '">' . $content . ' </a> ';
							echo '<br>';}
						else {
							echo '<a href="viewpost.php?postid=' . $id . '"><img src="'.$postimage.'" width="500" height="600"></a> ';
							echo '<br>';
							}
						
						
						
						
						

				echo '<a href="viewpost.php?postid=' . $id  . '"> <i class="fa fa-comment" ></i> Add a Comment </a> </p></div></div>';
				echo '</div>';
			}
		}
		else
		{
			echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
		}
		
		?>
		<?php if (isset($_SESSION['name'])) { echo "<input type='hidden' id='username' value='".$_SESSION['name']."'/>"; }?>
	</div>
	<script>
		$(document).ready(function() {
			$('.upvoteinput').click(function() { //line 72 and 80....upvotee and downvote class
				var id2 = $(this).attr('id');
				var id = id2.substr(id2.sindexOf("-") + 1);
				var username = $('#username').val();
				if (username == null) {
					return false;
				}
				var votevalue = 0;
				if (id2.startsWith("updoot")) votevalue = 1;
				if (id2.startsWith("downdoot")) votevalue = -1;
				$.ajax({
					type: "POST",
					url: "vote.php?postid=" + id + "&username=" + username +"&vote=" + votevalue,
					data: "",
					success: function(msg){},
					error: function(msg){}
				});
			});
		});
		</script>
		</div>
	</div>
	</body>
</html>
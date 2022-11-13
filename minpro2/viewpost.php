<?php
    session_start();
    if (!isset($_SESSION['loggedin'])) {
        header('Location: index.html');
        exit;
    }
    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $db = 'phplogin';
    $mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);

    // Check connection
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error());
    } 
    echo "Connected successfully";
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>OmniShea</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=yes">
	<meta name="description" content="Reddit" />
	<link rel="shortcut icon" href="images/favicon.ico">
	<link rel="stylesheet" href="styles/style.css" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
	<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>


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
?>


    <body>
		<nav class="navtop">
			<div>
				<h1>OmniShea</h1>
				<a href="submit.php"><i class="fa-solid fa-poo"></i>Create Post</a>
				<a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
		</nav>
        <div class="home">
            <div class="content-container">

        <?php
		$link = mysqli_connect("localhost", "root", "", "phplogin");
        $postid = $_REQUEST['postid'];
        $postid = mysqli_real_escape_string($link, $postid);
		$query = "SELECT * FROM post WHERE postid=$postid";
		$result = mysqli_query($link, $query);
		if ($link === false) {
			die("ERROR: Could not connect. " . mysqli_connect_error());
		}
        if(mysqli_query($link, $query))
        {
    		while($row = mysqli_fetch_array($result))
            {
    				echo '<div class="row" id="post_' . htmlspecialchars($row['postid'], ENT_QUOTES, 'UTF-8') . '"><div class="score-container"><form method="POST" id="votearrow"';
    				echo '"><input name="updoot" class="upvoteinput" type="image" id="updoot-' . htmlspecialchars($row['postid'], ENT_QUOTES, 'UTF-8');
    			 	echo '" value="updoot" src="images/upvote.gif"/></form><span class="score">' . htmlspecialchars($row['score'], ENT_QUOTES, 'UTF-8');
    				echo '</span><form method="post" id="votearrow"><input name="downdoot" class="upvoteinput" type="image" id="downdoot-' . htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8');
    				echo '" value="downdoot" src="images/downvote.gif"/></form></div><div class="post-container"><p>' . htmlspecialchars($row['posttitle'], ENT_QUOTES, 'UTF-8');
    				echo '</p><p id="submission-info"><i class="fa fa-user"></i> submitted by <a href="#">' . htmlspecialchars($row['postuser'], ENT_QUOTES, 'UTF-8') . '</a> <i class="fa fa-calendar"></i> ';
                    echo timeSince(strtotime($row['postts'])) . ' ago</p><p>' . htmlspecialchars($row['content'], ENT_QUOTES, 'UTF-8') . '</p></div></div>';
    		}

        }
        else echo "ERROR: Could not able to execute $query. " . mysqli_error($link);
        ?>

        <!-- posting new comments -->

        <?php
        if (isset($_SESSION['logged_in'])) {
            echo '<div class="post-comment"><form id="comment-form" method="POST"><textarea id="comment-content" type="text" placeholder="write your comment" name="comment" rows="5" cols="150"></textarea>
                    <button type="submit" class="btnblue" id="sign-up-in-btn" value="Post comment" name="post-comment">Post comment</button></form></div><div id="failure"></div>';
		}
    	if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['post-comment'])){
            $link = mysqli_connect("localhost", "root", "", "phplogin");
            // Check connection
            if($link === false){
                die("ERROR: Could not connect. " . mysqli_connect_error());
            }
            // Escape user inputs for security
            $commentuser = $_SESSION['name'];
            $postid = $_REQUEST['postid'];
            $comment = mysqli_real_escape_string($link, $_REQUEST['comment']);
            // attempt insert query execution
            if ($comment === '') {
				echo "<script>document.getElementById('failure').innerHTML = '<p>You didn't write anything in comment field.</p>';</script>";
			} else {
                $sql = "INSERT INTO comment (commentuser, postid, comment) VALUES ('$commentuser', '$postid', '$comment')";
                if(mysqli_query($link, $sql)) {
                    // echo "Records added successfully.";
                    $msg = 'Comment submitted successfully!';
                    header('Refresh: 0');
                    alert("$msg");
                } else {
                    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                }
            }
    	}

    	?>
        <?php
		$link = mysqli_connect("localhost", "root", "", "phplogin");
        $postid = $_REQUEST['postid'];
        $postid = mysqli_real_escape_string($link, $postid);
		$query = "SELECT * FROM comment WHERE postid=$postid";
		$result = mysqli_query($link, $query);
		if ($link === false) {
			die("ERROR: Could not connect. " . mysqli_connect_error());
		}
        if(mysqli_query($link, $query)) {
            if ($result->num_rows == 0) {
                echo "<div class='empty-comments'><p>there doesn't seem to be anything here yet</p></div>";
            }
            else {
                echo '<div class="comments-container">';
        		while($row = mysqli_fetch_array($result)){
                    $postid = htmlspecialchars($row['postid'], ENT_QUOTES, 'UTF-8');
                    $commentuser = htmlspecialchars($row['commentuser'], ENT_QUOTES, 'UTF-8');
                    $score = htmlspecialchars($row['score'], ENT_QUOTES, 'UTF-8');
                    $comment = htmlspecialchars($row['comment'], ENT_QUOTES, 'UTF-8');
                    echo '<div class="comment-row" id="comment_' . $postid;
                    echo '"><div class="comment-score-container"><form method="POST" id="votearrow"><input name="updoot" class="upvoteinput" type="image" id="updoot-';
                    echo $id . '" value="updoot" src="images/upvote.gif"/></form><form method="post" id="votearrow"><input name="downdoot" class="upvoteinput" type="image" id="downdoot-';
                    echo $id . '" value="downdoot" src="images/downvote.gif"/></form></div><div class="comments-container" id="comment-title-container"><p id="submission-info"><a id="comment-title-container" href="profile?user=';
                    echo $postuser . '"> ' . $postuser;
                    echo timeSince(strtotime($row['postts'])) . ' ago</p></div><div class="comments-container" id="comment-content-container"><p>' . $comment . '</p></div></div>';
        		}
            }
        } else {
			echo "ERROR: Could not able to execute $query. " . mysqli_error($link);
		}
        ?>
    </div>
    </div>
</body>
</html>

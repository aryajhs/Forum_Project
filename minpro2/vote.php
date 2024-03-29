<?php
$link = mysqli_connect("localhost","root","", "phplogin");
$id = $_REQUEST['postid'];
$username = $_REQUEST['username'];
$points = $_REQUEST['vote'];
// validates voting points value
if (!($points >= -1 && $points <= 1)) {
    $points = 0;
}
if ($link === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
$vote = "INSERT INTO vote (username, postid, score)
                    VALUES ('$username', '$id', $points)";
$check = "SELECT * FROM vote
                    WHERE postid='$id' AND postuser='$username'";
// finds row where given user has voted for given post
$result = mysqli_query($link, $check);
$row = mysqli_fetch_array($result);
// checks if user has already voted
if($result->num_rows === 0) {
    // not yet voted, will vote for first time
    // echo "New vote";
    mysqli_query($link, $vote);
    if ($points == 1) {
        $updatenews = "UPDATE post SET score=$points, upvotes=upvotes+1 WHERE postid='$id'";
    } elseif ($points == -1) {
        $updatenews = "UPDATE post SET score=$points, downvotes=downvotes-1 WHERE postid='$id'";
    }
    mysqli_query($link, $updatenews);
//user has already voted
} elseif ($result->num_rows > 0)
{
    $currentvote = $row['score'];
    // if user hasn't already voted in this manner, new score will be added
    if ($currentvote != $points) {
        $update = "UPDATE post SET score=score + $points WHERE postid='$id' AND postuser='$username'";
        if ($points == 1 && $currentvote == -1) {
            $updatenews = "UPDATE post SET score=score + $points, downvotes=downvotes-1 WHERE postid='$id'";
        } elseif ($points == -1 && $currentvote == 1) {
            $updatenews = "UPDATE post SET score=score + $points, upvotes=upvotes-1 WHERE postid='$id'";
        } elseif ($points == -1 && $currentvote == 0) {
            $updatenews = "UPDATE post SET score=score + $points, downvotes=downvotes+1 WHERE postid='$id'";
        } elseif ($points == 1 && $currentvote == 0) {
            $updatenews = "UPDATE post SET score=score + $points, upvotes=upvotes+1 WHERE postid='$id'";
        }
        mysqli_query($link, $update);
        mysqli_query($link, $updatenews);
        // echo "Vote changed";
    }
} 
else
{
    echo "ERROR: Could not able to execute" . mysqli_error($link);
}
?>
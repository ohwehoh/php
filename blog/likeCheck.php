<?php
    include "../connect/connect.php";
    include "../connect/session.php";
    include "../connect/sessionCheck.php";

    //변수 설정
    $check = $_POST['check'];
    $blogID = $_POST['blogID'];
    $likeID = $_POST['likeID'];
    $memberID = $_SESSION['memberID'];

    if($check == 1){
        // echo "<script>alert('좋아요');</script>";
        $sql = "UPDATE myBlog SET blogLike = blogLike + 1 WHERE blogID = {$blogID}";
        $result = $connect -> query($sql);

        $sql = "INSERT INTO blogLike(memberID, blogID) VALUES('$memberID', '$blogID')";
        $result = $connect -> query($sql);
    } else {
        // echo "<script>alert('좋아요 취소');</script>";
        $sql = "UPDATE myBlog SET blogLike = blogLike - 1 WHERE blogID = {$blogID}";
        $result = $connect -> query($sql);

        $sql = "DELETE FROM blogLike WHERE likeID = {$likeID}";
        $result = $connect -> query($sql);
    }

    $sql = "SELECT blogLike FROM myBlog WHERE blogID = {$blogID}";
    $result = $connect -> query($sql);
    $bloglike = $result -> fetch_array(MYSQLI_ASSOC);
    $bloglike = $bloglike['blogLike'];

    echo json_encode(array("result" => $bloglike));
?>
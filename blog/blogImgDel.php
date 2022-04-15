<?php
    include "../connect/connect.php";

    //변수 설정
    $blogID = $_POST['blogID'];
    $delImg = $_POST['delImg'];

    $sql = "UPDATE myBlog SET blogImgFile = 'default.svg' WHERE blogID = {$blogID}";
    $result = $connect -> query($sql);

    echo json_encode(array("result" => true));
?>
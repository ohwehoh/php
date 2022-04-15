<?php
    include "../connect/connect.php";
    include "../connect/session.php";

    $blogID = $_GET['blogID'];
    $blogCategory = $_POST['blogCate'];
    $blogTitle = $_POST['blogTitle'];
    $blogContents = nl2br($_POST['blogContents']);
    $blogModTime = time();

    $blogTitle = $connect -> real_escape_string($blogTitle);
    $blogContents = $connect -> real_escape_string($blogContents);

    $blogImgFile = $_FILES['blogFile'];
    $blogImgSize = $_FILES['blogFile']['size'];
    $blogImgType = $_FILES['blogFile']['type'];
    $blogImgName = $_FILES['blogFile']['name'];
    $blogImgTmp = $_FILES['blogFile']['tmp_name'];

    //이미지 파일명 확인
    $fileTypeExtension = explode("/", $blogImgType); //문자열쪼개기
    $fileType = $fileTypeExtension[0]; //image
    $fileExtension = $fileTypeExtension[1]; //jpeg

    $check = false;


    //이미지 확인 작업 / 이미지 확장자 확인 작업 / 용량 확인
    if($blogImgSize > 1000000){
        echo "<script>alert('이미지 용량이 1메가를 초과합니다. 수정해주세요!'); history.back(1)</script>";
        exit;
    }
    if($fileType == "image"){
        if($fileExtension == "jpg" || $fileExtension == "jpeg" || $fileExtension == "png" || $fileExtension == "gif"){
            $blogImgDir = "../assets/img/blog/";
            $blogImgName = "Img_".time().rand(1,99999)."."."{$fileExtension}";
            echo "이미지 파일이 맞습니다.";
            $sql = "UPDATE myBlog SET blogCategory = '{$blogCategory}', blogTitle = '{$blogTitle}', blogContents = '{$blogContents}', blogImgFile = '{$blogImgName}', blogModTime = '{$blogModTime}' WHERE blogID = '{$blogID}'";
        } else {
            echo "<script>alert('지원하는 이미지 파일 형식이 아닙니다. jpg, png, gif 사진 파일만 지원 합니다.'); history.back(1)</script>";
        }
    } else if($fileType == "" || $fileType == null){
        //echo "이미지를 첨부하지 않았습니다.";
        $sql = "UPDATE myBlog SET blogCategory ='{$blogCategory}', blogTitle ='{$blogTitle}', blogContents ='{$blogContents}', blogModTime = '{$blogModTime}' WHERE blogID = '{$blogID}'";
    } else {
        echo "<script>alert('지원하는 이미지 파일 형식이 아닙니다. jpg, png, gif 사진 파일만 지원 합니다.'); history.back(1)</script>";
    }
    $result = $connect -> query($sql);
    $result = move_uploaded_file($blogImgTmp, $blogImgDir.$blogImgName);
    Header("Location: blog.php");
?>
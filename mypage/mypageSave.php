<?php
    include "../connect/connect.php";
    include "../connect/session.php";
    include "../connect/sessionCheck.php";
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>회원정보세이브</title>
</head>
<body>
    <?php
        $youEmail = $_POST['youEmail'];
        $youName = $_POST['youName'];
        $youBirth = $_POST['youBirth'];
        $youPhone = $_POST['youPhone'];
        $password = $_POST['youPass'];
        $youIntro = $_POST['youIntro'];
        $memberID = $_SESSION['memberID'];

        $youImgFile = $_FILES['youPhoto'];
        $youImgSize = $_FILES['youPhoto']['size'];
        $youImgType = $_FILES['youPhoto']['type'];
        $youImgName = $_FILES['youPhoto']['name'];
        $youImgTmp = $_FILES['youPhoto']['tmp_name'];

        echo "<pre>";
        var_dump($youImgFile);
        echo "</pre>";

        $fileTypeExtension = explode("/", $youImgType); //문자열쪼개기
        $fileType = $fileTypeExtension[0]; //image
        $fileExtension = $fileTypeExtension[1]; //jpeg
    
        $sql = "SELECT youPass FROM myMember WHERE memberID = {$memberID}";
        $result = $connect -> query($sql);
        if($result){
            $youPass = $result -> fetch_array(MYSQLI_ASSOC);
            // echo "<pre>";
            // var_dump($memberInfo);
            // echo "</pre>";
            //비밀번호 확인
            if($password == $youPass['youPass']){
                //이미지 확인 작업 / 이미지 확장자 확인 작업 / 용량 확인
                if($fileType == "image"){
                    //확장자 확인
                    if($fileExtension == "jpg" || $fileExtension == "jpeg" || $fileExtension == "png" || $fileExtension = "gif"){
                        $youImgDir = "../assets/img/mypage/";
                        $youImgName = "Img_".time().rand(1,99999)."."."{$fileExtension}";

                        if($youImgSize <= 1000000){
                            $sql = "UPDATE myMember SET youPhoto = '{$youImgName}' WHERE memberID = '{$memberID}'";
                            $check = true;
                        } else {
                            echo "<script>alert('이미지의 용량이 너무 큽니다. 1MB이하의 사진 파일만 지원합니다..'); history.back(1)</script>";
                            $check = false;
                        }
                    } else {
                        echo "<script>alert('지원하는 이미지 파일 형식이 아닙니다. jpg, png, gif 사진 파일만 지원 합니다.'); history.back(1)</script>";
                        $check = false;
                    }
                } else {
                    echo "<script>alert('이미지 파일이 아닙니다.');</script>";
                }
                if($check == true){
                $result = $connect-> query($sql);
                $result = move_uploaded_file($youImgTmp, $youImgDir.$youImgName);
                Header("Location: mypageModify.php");
                }

                //수정(쿼리문 작성)
                $sql = "UPDATE myMember SET youEmail = '{$youEmail}', youName = '{$youName}', youBirth = '{$youBirth}', youPhone = '{$youPhone}', youIntro = '{$youIntro}' WHERE memberID = '{$memberID}'";
                $connect -> query($sql);
                echo "<script>alert('수정이 완료되었습니다.'); history.back(1);</script>";
            } else {
                echo "<script>alert('비밀번호오류입니다. 다시 한번 확인해주세요.');history.back(1);</script>";
            }
        }
     ?>
 </body>
</html> 
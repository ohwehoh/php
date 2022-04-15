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
    <title>수정세이브</title>
</head>
<body>
    <?php
        $boardID = $_POST['boardID'];
        $boardTitle = $_POST['boardTitle'];
        $boardContents = $_POST['boardContents'];
        $youPass = $_POST['youPass'];
        $memberID = $_SESSION['memberID'];
        $regTime = time();
        $contentMemberId = $_POST['memberID'];

        $boardTitle = $connect -> real_escape_string($boardTitle);
        $boardContents = $connect -> real_escape_string($boardContents);
        
        //쿼리문 작성
        $sql = "SELECT youPass, memberID FROM myMember WHERE memberID = {$memberID}";
        $result = $connect -> query($sql);

        if($result){
            $memberInfo = $result -> fetch_array(MYSQLI_ASSOC);

            echo "<pre>";
            var_dump($memberInfo);
            echo "</pre>";

            //아이디 비밀번호 확인
            if($memberInfo['youPass'] == $youPass && $memberInfo['memberID'] == $memberID && $memberInfo['memberID'] == $contentMemberId){
                //수정(쿼리문 작성)
                $sql = "UPDATE myBoard SET boardTitle = '{$boardTitle}', boardContents = '{$boardContents}', regTime = '{$regTime}' WHERE boardID = '{$boardID}'";
                $connect -> query($sql);
                echo "수정이 완료되었습니다.";
            } else if($memberInfo['youPass'] != $youPass) {
                echo "<script>alert('비밀번호가 일치하지 않습니다. 다시 한번 확인해주세요.'); history.back(1)</script>";
            } else if($memberInfo['memberID'] != $contentMemberId) {
                echo "<script>alert('당신은 작성자가 아닙니다.')</script>";
            } else if($memberInfo['memberID'] != $memberID){
                echo "<script>alert('아이디가 다르대')</script>";
                
            } else {
                echo "<script>alert('오류입니다. 다시 한번 확인해주세요.');history.back(1)</script>";
            }
        }
    ?>
    <script>
        location.href = "board.php";
    </script>
</body>
</html>
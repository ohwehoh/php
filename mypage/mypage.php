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
    <title>회원 정보</title>

    <!-- style -->
    <?php
        include "../include/style.php";
    ?>
    <!-- //style -->
</head>
<body>
    <?php
        include "../include/skip.php";
    ?>
    <!-- //skip -->

    <?php
        include "../include/header.php";
    ?>
    <!-- //header -->

    <main id="contents">
        <h2 class="ir_so">컨텐츠 영역</h2>
        <section class="join-type gray">
            <div class="member-form">
                <h3>회원 정보</h3>
                
                <div class="join-intro">
                    <?php
                        //youEmail, youNickName, youName, youBirth, youPhone, youGender, youSite, youIntro
                        $memberID = $_SESSION['memberID'];
                        $sql = "SELECT youEmail, youNickName, youName, youBirth, youPhone, youGender, youSite, youIntro, youPhoto FROM myMember WHERE memberID = {$memberID}";
                        $result = $connect -> query($sql);
                        // echo "{$memberID}";

                        if($result) {
                            $memberInfo = $result -> fetch_array(MYSQLI_ASSOC);
                        }
                    ?>
                    <div class="face">
                        <?php if($memberInfo == null) {?><img src="../assets/img/mypage/default.svg" alt="기본이미지">
                        <?php } else {?><img src="../assets/img/mypage/<?=$memberInfo['youPhoto']?>" alt="프로필이미지">

                        <?php ;} ?>
                    </div>
                    
                    <div class="intro"><?=$memberInfo['youNickName']?>님의 자기소개 : <?=$memberInfo['youIntro']?></div>
                </div>

                <div class="join-info">
                    <ul>
                        <?php
                            //이메일 닉네임 이름 생일 번호 성별 사이트
                        ?>
                        <li>
                            <strong>이메일</strong>
                            <span><?=$memberInfo['youEmail']?></span>
                        </li>
                        <li>
                            <strong>닉네임</strong>
                            <span><?=$memberInfo['youNickName']?></span>
                        </li>
                        <li>
                            <strong>이름</strong>
                            <span><?=$memberInfo['youName']?></span>
                        </li>
                        <li>
                            <strong>생일</strong>
                            <span><?=$memberInfo['youBirth']?></span>
                        </li>
                        <li>
                            <strong>번호</strong>
                            <span><?=$memberInfo['youPhone']?></span>
                        </li>
                        <li>
                            <strong>성별</strong>
                            <span><?=$memberInfo['youGender']?></span>
                        </li>
                        <li>
                            <strong>사이트</strong>
                            <span><?=$memberInfo['youSite']?></span>
                        </li>
                    </ul>
                </div>

                <div class="join-btn">
                    <a href="mypageModify.php">수정하기</a>
                    <a href="../login/logout.php">로그아웃</a>
                    <a href="mypageLeave.php">탈퇴하기</a>
                </div>
            </div>
        </section>
    </main>
    <!-- //main -->

    <!-- footer -->
    <?php
        include "../include/footer.php";
    ?>
    <!-- //footer -->
</body>
</html>
<?php

    include "../connect/session.php";
    //세션지우기
    unset($_SESSION['memberID']);
    unset($_SESSION['youName']);
    unset($_SESSION['youEmail']);

    //메인으로 이동
    Header("Location: ../pages/main.php");
?>
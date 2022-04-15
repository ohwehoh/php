<?php
    include "../connect/connect.php";

    for($i=1; $i<=300; $i++){
        $regTime = time();

        $sql = "INSERT INTO myBoard(memberID, boardTitle, boardContents, boardView, regTime) values(1, '게시판 타이틀${i}입니다.', '게시판 내용${i}입니다. 전염병 코로나의 영향으로 온라인 수업을 듣고있는데 개꿀이네요.', '1', '$regTime')";
        $connect -> query($sql);
    }

?>
<?php
    include "../connect/connect.php";
    include "../connect/session.php";
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시글보기</title>

    <?php
        include "../include/style.php";
    ?>
    <style>
        .footer {
            background: #f5f5f5;
        }
    </style>
</head>
<body>
    <?php
        include "../include/skip.php";
    ?>

    <?php
        include "../include/header.php";
    ?>

    <main id="contents">
        <h2 class="ir_so">컨텐츠 영역</h2>
        <section id="board-type" class="section center mb100">
            <div class="container">
                <h3 class="section__title">게시글 보기</h3>
                <p class="section__desc">음식 게시판 게시글 보기 영역입니다.</p>
                <div class="board_inner">
                    <div class="board__table">
                        <table>
                            <colgroup>
                                <col style="width: 30%">
                                <col style="width: 70%">
                            </colgroup>
                            <tbody>
                                <?php
                                    $boardID = $_GET['boardID'];
                                    $memberID = $_GET['memberID'];

                                    //echo "??????????????????????????{$memberID}";

                                    // echo $boardID;

                                    $sql = "SELECT b.boardTitle, m.youName, b.regTime, b.boardView, b.boardContents FROM myBoard b JOIN myMember m ON(m.memberID = b.memberID) WHERE b.boardID = {$boardID}";
                                    $result = $connect -> query($sql);
                                    
                                    $sql = "UPDATE myBoard SET boardView = boardView + 1 WHERE boardID = {$boardID}";
                                    $connect -> query($sql);

                                    if($result){
                                        $boardInfo = $result -> fetch_array(MYSQLI_ASSOC);

                                        // echo "<pre>";
                                        // var_dump($boardInfo);
                                        // echo "</pre>";

                                        echo "<tr><th>제목</th><td class='left'>".$boardInfo['boardTitle']."</td></tr>";
                                        echo "<tr><th>글쓴이</th><td class='left'>".$boardInfo['youName']."</td></tr>";
                                        echo "<tr><th>등록일</th><td class='left'>".date('Y-m-d H:i', $boardInfo['regTime'])."</td></tr>";
                                        echo "<tr><th>조회수</th><td class='left'>".$boardInfo['boardView']."</td></tr>";
                                        echo "<tr><th>내용</th><td class='left height'>".$boardInfo['boardContents']."</td></tr>";


                                    }
                                ?>
                                <!-- <tr>
                                    <th>제목</th>
                                    <td class="left">오늘 저녁입니다.</td>
                                </tr>
                                <tr>
                                    <th>글쓴이</th>
                                    <td class="left">이연우</td>
                                </tr>
                                <tr>
                                    <th>등록일</th>
                                    <td class="left">2022-03-16</td>
                                </tr>
                                <tr>
                                    <th>조회수</th>
                                    <td class="left">10</td>
                                </tr>
                                <tr>
                                    <th>내용</th>
                                    <td class="left height">오늘 저녁에는 치킨을 먹었습니다.<br>
                                        XX치킨 신메뉴입니다.<br>
                                        지점마다 차이가 있겠지만<br>
                                        OO점은 바삭하고 맛있었습니다.</td>
                                </tr> -->
                            </tbody>
                        </table>
                    </div>
                    <div class="board__btn">
                        <a href="board.php">목록보기</a>
                        <a href="boardRemove.php?boardID=<?=$boardID?>" onclick="return noticeRemove();">삭제하기</a>
                        <a href="boardModify.php?boardID=<?=$boardID?>&memberID=<?=$memberID?>">수정하기</a>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php
        include "../include/footer.php";
    ?>

    <script>
        function noticeRemove(){
            let notice = confirm("정말 삭제하시겠습니까?", "");

            return notice;
        }
    </script>
    
</body>
</html>
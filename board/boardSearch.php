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
    <title>게시판 검색</title>

    <?php
        include "../include/style.php";
    ?>
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
                <h3 class="section__title">검색 결과 게시판</h3>
                <p class="section__desc">음식에 관련된 검색 결과입니다.</p>
                <div class="board_inner">
                    <div class="board__search">
                        <?php
                            function msg($alert){
                                echo "<p class='result'>총 ".$alert."건이 검색되었습니다.</p>";
                            }

                            $searchKeyword = $_GET['searchKeyword'];
                            $searchOption = $_GET['searchOption'];

                            $searchKeyword = $connect -> real_escape_string(trim($searchKeyword));
                            $searchOption = $connect -> real_escape_string(trim($searchOption));

                            //쿼리문 작성
                            //b.boardID, b.boardTitle, b.boardContents, m.youName, b.regTime, b.boardView
                            // $sql = "SELECT b.boardID, b.boardTitle, b.boardContents, m.youName, b.regTime, b.boardView FROM myBoard b JOIN myMember m ON(b.memberID = m.memberID) WHERE b.boardTitle LIKE '%{$searchKeyword}%' ORDER BY boardID DESC LIMIT 10";
                            // $sql = "SELECT b.boardID, b.boardTitle, b.boardContents, m.youName, b.regTime, b.boardView FROM myBoard b JOIN myMember m ON(b.memberID = m.memberID) WHERE b.boardContents LIKE '%{$searchKeyword}%' ORDER BY boardID DESC LIMIT 10";
                            // $sql = "SELECT b.boardID, b.boardTitle, b.boardContents, m.youName, b.regTime, b.boardView FROM myBoard b JOIN myMember m ON(b.memberID = m.memberID) WHERE m.youName LIKE '%{$searchKeyword}%' ORDER BY boardID DESC LIMIT 10";

                            $sql = "SELECT b.boardID, b.boardTitle, b.boardContents, m.youName, b.regTime, b.boardView FROM myBoard b JOIN myMember m ON(b.memberID = m.memberID) ";

                            switch($searchOption){
                                case 'title':
                                    $sql .= "WHERE b.boardTitle LIKE '%{$searchKeyword}%' ORDER BY boardID DESC ";
                                    break;
                                case 'content':
                                    $sql .= "WHERE b.boardContents LIKE '%{$searchKeyword}%' ORDER BY boardID DESC ";
                                    break;
                                case 'name':
                                    $sql .= "WHERE m.youName LIKE '%{$searchKeyword}%' ORDER BY boardID DESC ";
                                    break;
                            }

                            $result = $connect -> query($sql);

                            if($result){
                                $count = $result -> num_rows;
                                msg($count);
                            }
                        ?>
                    </div>
                    <div class="board__table">
                        <table class="hover">
                            <colgroup>
                                <col style="width: 5%;">
                                <col>
                                <col style="width: 10%;">
                                <col style="width: 12%;">
                                <col style="width: 7%;">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th>번호</th>
                                    <th>제목</th>
                                    <th>등록자</th>
                                    <th>등록일</th>
                                    <th>조회수</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if(isset($_GET['page'])){
                                        $page = (int) $_GET['page'];
                                    } else {
                                        $page = 1;
                                    }
                                    $pageView = 10;
                                    $pageLimit = ($pageView * $page) - $pageView;

                                    $sql2 = $sql."LIMIT {$pageLimit}, {$pageView}";

                                    $result = $connect -> query($sql2);
                                    if($result) {
                                        $countt = $result -> num_rows;
                                        if($countt > 0){
                                            for($i=1; $i<=$countt; $i++){
                                                $boardInfo = $result -> fetch_array(MYSQLI_ASSOC);
                                                echo "<tr>";
                                                echo "<td>".$boardInfo['boardID']."</td>";
                                                echo "<td class='left'><a href='boardView.php?boardID={$boardInfo['boardID']}&memberID={$boardInfo['memberID']}'>".$boardInfo['boardTitle']."</a></td>";
                                                echo "<td>".$boardInfo['youName']."</td>";
                                                echo "<td>".date('Y-m-d', $boardInfo['regTime'])."</td>";
                                                echo "<td>".$boardInfo['boardView']."</td>";
                                                echo "</tr>";
                                            }
                                        }
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="board__pages">
                    <ul>
                    <?php
                        $sql = "SELECT b.boardID, b.boardTitle, b.boardContents, m.youName, b.regTime, b.boardView FROM myBoard b JOIN myMember m ON(b.memberID = m.memberID) ";

                        switch($searchOption){
                            case 'title':
                                $sql .= "WHERE b.boardTitle LIKE '%{$searchKeyword}%' ORDER BY boardID DESC ";
                                break;
                            case 'content':
                                $sql .= "WHERE b.boardContents LIKE '%{$searchKeyword}%' ORDER BY boardID DESC ";
                                break;
                            case 'name':
                                $sql .= "WHERE m.youName LIKE '%{$searchKeyword}%' ORDER BY boardID DESC ";
                                break;
                        }$result = $connect -> query($sql);
                        
                        $count = $result -> num_rows;

                        // echo "<pre>";
                        // var_dump($boardCount);
                        // echo "</pre>";

                        //페이지 넘버 갯수
                        //300/10 = 30
                        //301/10 = 31
                        //309/10 = 31

                        //echo $boardCount;

                        //총 페이지 갯수
                          
                        $count = ceil($count / $pageView);

                        //echo $boardCount;

                        //현재 페이지를 기준으로 보여주고 싶은 갯수
                        $pageCurrent = 5;
                        $startPage = $page - $pageCurrent;
                        $endPage = $page + $pageCurrent;

                        //처음 페이지 초기화
                        if($startPage < 1) $startPage = 1;

                        //마지막 페이지 초기화
                        if($endPage >= $count) $endPage = $count;

                        //처음 페이지
                        if($page != 1){
                            echo "<li><a href='boardSearch.php?page=1&searchKeyword={$searchKeyword}&searchOption={$searchOption}'>처음으로</a></li>";
                        }

                        //이전 페이지
                        if($page != 1){
                            $prePage = $page - 1;
                            echo "<li><a href='boardSearch.php?page={$prePage}&searchKeyword={$searchKeyword}&searchOption={$searchOption}'>이전</a></li>";
                        }

                        //페이지 넘버 표시
                        for($i=$startPage; $i<=$endPage; $i++){
                            $active = "";
                            if($i == $page){
                                $active = "active";
                            }
                            echo "<li class ='{$active}'><a href='boardSearch.php?page={$i}&searchKeyword={$searchKeyword}&searchOption={$searchOption}'>{$i}</a></li>";
                        }

                        //다음 페이지
                        if($count != 0 && $page != $count){
                            $nextPage = $page + 1;
                            echo "<li><a href='boardSearch.php?page={$nextPage}&searchKeyword={$searchKeyword}&searchOption={$searchOption}'>다음</a></li>";
                        }

                        //마지막 페이지
                        if($count != 0 && $page != $count){
                            echo "<li><a href='boardSearch.php?page={$count}&searchKeyword={$searchKeyword}&searchOption={$searchOption}'>마지막으로</a></li>";
                        }
                    ?>
                    </ul>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php
        include "../include/footer.php";
    ?>
</body>
</html>
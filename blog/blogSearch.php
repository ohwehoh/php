<?php
    include "../connect/connect.php";
    include "../connect/session.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>블로그</title>

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
        <section id="blog-type" class="section center">
            <div class="container">
                <h3 class="section__title">블로그 검색결과</h3>
                <p class="section__desc">음식에 관련된 블로그입니다. 다양한 정보를 확인하세요!</p>
                <div class="blog__inner">
                <?php
                    function msg($alert){
                        echo "<p class='result'>총 ".$alert."건이 검색되었습니다.</p>";
                    }

                    $searchKeyword = $_GET['blogSearch'];

                    $searchKeyword = $connect -> real_escape_string(trim($searchKeyword));
                    
                    $sql = "SELECT blogID, blogCategory, blogTitle, blogContents, blogAuthor, blogRegTime, blogView, blogImgFile FROM myBlog WHERE blogTitle LIKE '%{$searchKeyword}%' OR blogContents LIKE '%{$searchKeyword}%' ORDER BY blogID DESC";

                    $result = $connect -> query($sql);

                    if($result){
                        $count = $result -> num_rows;
                        msg($count);
                    }
                ?>
                <?php
                    if(isset($_SESSION['memberID'])){
                ?>
                    <div class="blog__btn">
                        <a href="blogWrite.php">글쓰기</a>
                    </div>
                <?php
                    ;}
                ?>
                    <div class="blog__cont">
                        <?php
                            if(isset($_GET['page'])){
                                $page = (int) $_GET['page'];
                            } else {
                                $page = 1;
                            }

                            $pageView = 5;
                            $pageLimit = ($pageView * $page) - $pageView;

                            $sql2 = $sql." LIMIT {$pageLimit}, {$pageView}";

                            $result = $connect -> query($sql2);                            
                            if($result) {
                                $countt = $result -> num_rows;
                                if($countt > 0){
                                    foreach($result as $blog){?>
                                <article class="blog">
                                    <figuer class="blog__header" aria-hidden="true">
                                        <a href="blogView.php?blogID=<?=$blog['blogID']?>" style="background-image: url(../assets/img/blog/<?=$blog['blogImgFile']?>);"></a></figuer>
                                    <div class="blog__body">
                                        <span class="blog__cate"><?=$blog['blogCategory']?></span>
                                        <a href="blogView.php?blogID=<?=$blog['blogID']?>">
                                            <div class="blog__title">
                                                <?=$blog['blogTitle']?>
                                            </div>
                                        </a>
                                        <div class="blog__desc"><?=$blog['blogContents']?></div>
                                        <div class="blog__info">
                                            <span class="author"><a href="#"><?=$blog['blogAuthor']?></a></span>
                                            <span class="date"><?=date('Y-m-d', $blog['blogRegTime'])?></span>
                                            <span class="modify"><a href="blogModify.php?blogID=<?=$blog['blogID']?>">수정</a></span>
                                            <span class="delete"><a href="blogRemove.php?blogID=<?=$blog['blogID']?>">삭제</a></span>
                                        </div>
                                    </div>
                                    </a>
                                </article>
                            <?php }
                            }
                        } ?>
                       
                    </div>
                    
                    <div class="blog__pages">
                        <ul>
                        <?php
                            $sql = "SELECT * FROM myBlog WHERE blogTitle LIKE '%{$searchKeyword}%' OR blogContents LIKE '%{$searchKeyword}%'";
    
                            $result = $connect -> query($sql);
                            
                            $count = $result -> num_rows;

                            //총 페이지 갯수
                            $count = ceil($count / $pageView);
    
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
                                echo "<li><a href='blogSearch.php?page=1&blogSearch={$searchKeyword}'>&lt;&lt;</a></li>";
                            }
    
                            //이전 페이지
                            if($page != 1){
                                $prePage = $page - 1;
                                echo "<li><a href='blogSearch.php?page={$prePage}&blogSearch={$searchKeyword}'>>&lt;</a></li>";
                            }
    
                            //페이지 넘버 표시
                            for($i=$startPage; $i<=$endPage; $i++){
                                $active = "";
                                if($i == $page){
                                    $active = "active";
                                }
                                echo "<li class ='{$active}'><a href='blogSearch.php?page={$i}&blogSearch={$searchKeyword}'>{$i}</a></li>";
                            }
    
                            //다음 페이지
                            if($count != 0 && $page != $count){
                                $nextPage = $page + 1;
                                echo "<li><a href='blogSearch.php?page={$nextPage}&blogSearch={$searchKeyword}'>&gt;</a></li>";
                            }
    
                            //마지막 페이지
                            if($count != 0 && $page != $count){
                                echo "<li><a href='blogSearch.php?page={$count}&blogSearch={$searchKeyword}'>&gt;&gt;</a></li>";
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
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
                <h3 class="section__title">음식 블로그</h3>
                <p class="section__desc">음식에 관련된 블로그입니다. 다양한 정보를 확인하세요!</p>
                <div class="blog__inner">
                    <div class="blog__search">
                        <form action="blogSearch.php" method="get">
                            <fieldset>
                                <legend class="ir_so">검색 영역</legend>
                                <input type="search" name="blogSearch" id="blogSearch" class="search" placeholder="검색어를 입력해주세요!">
                                <label for="blogSearch" class="ir_so">검색</label>
                                <button type="submit" class="button">검색버튼</button>
                            </fieldset>
                        </form>
                    </div>
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
                            
                            $sql = "SELECT blogImgFile, blogCategory, blogTitle, blogContents, blogAuthor, blogRegTime, blogID, blogView, blogLike FROM myBlog WHERE blogDelete = 1 ORDER BY blogID DESC LIMIT {$pageLimit}, {$pageView}";
                            $result = $connect -> query($sql);

                            foreach($result as $blog){?>
                                <article class="blog">
                                    <figure class="blog__header" aria-hidden="true">
                                        <a href="blogView.php?blogID=<?=$blog['blogID']?>" style="background-image: url(../assets/img/blog/<?=$blog['blogImgFile']?>);"></a></figure>
                                    <div class="blog__body">
                                        <span class="blog__cate"><?=$blog['blogCategory']?></span>
                                        <a href="blogView.php?blogID=<?=$blog['blogID']?>">
                                            <div class="blog__title">
                                                <?=$blog['blogTitle']?>
                                            </div>
                                            <div class="blog__att">
                                                <span class="view">VIEW : <?=$blog['blogView']?></span>
                                                <span class="like">LIKE : <?=$blog['blogLike']?></span>
                                            </div>
                                        </a>
                                        <div class="blog__desc"><?=$blog['blogContents']?></div>
                                        <div class="blog__info">
                                            <span class="author"><?=$blog['blogAuthor']?></span>
                                            <span class="date"><?=date('Y-m-d', $blog['blogRegTime'])?></span>
                                            <span class="modify"><a href="blogModify.php?blogID=<?=$blog['blogID']?>">수정</a></span>
                                            <span class="delete"><a href="blogRemove.php?blogID=<?=$blog['blogID']?>">삭제</a></span>
                                        </div>
                                    </div>
                                    </a>
                                </article>
                            <?php } ?>
                       
                        
                        
                        <!-- <article class="blog">
                            <figuer class="blog__header"><img src="../assets/img/cardImg1.jpg" alt="블로그 이미지"></figuer>
                                
                            <div class="blog__body">
                                <span class="blog__cate">빵</span>
                                <div class="blog__title">오스트리아 크루아상</div>
                                <div class="blog__desc">오스트리아의 수도 빈이 오스만 제국의 침략을 받았지만 오스만 제국을 잘 막아 내어 그 기념으로 오스만 제국의 그려진 초승달 모양을 본따 만들어진 것이다.</div>
                                <div class="blog__info">
                                    <span class="author"><a href="#">이연우</a></span>
                                    <span class="date">2022-02-02</span>
                                    <span class="modify"><a href="#">수정</a></span>
                                    <span class="delete"><a href="#">삭제</a></span>
                                </div>
                            </div>
                        </article> -->
                    </div>
                    
                    <div class="blog__pages">
                        <ul>
                        <?php
                            include "blogPage.php";  //에러있어도 불러냄
                        ?>
                            <!-- <li><a href="">&lt;&lt;</a></li>
                            <li><a href="">&lt;</a></li>
                            <li class="active"><a href="">1</a></li>
                            <li><a href="">2</a></li>
                            <li><a href="">3</a></li>
                            <li><a href="">4</a></li>
                            <li><a href="">5</a></li>
                            <li><a href="">6</a></li>
                            <li><a href="">&gt;</a></li>
                            <li><a href="">&gt;&gt;</a></li> -->
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
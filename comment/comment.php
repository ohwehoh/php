<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>댓글</title>

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
        <section id="card-type" class="section center">
            <div class="container">
                <h3 class="section__title">세계의 음식 문화</h3>
                <p class="section__desc">
                여러나라의 음식 문화는 아주 다양하고 각양각색이다.<br>영국에서는 모기 눈알로 스프를 만들어 먹는다고도 한다.
                </p>
                <div class="card__inner">
                    <article class="card">
                        <figure class="card__header">
                            <img class="card__img" src="../assets/img/cardImg1.jpg" alt="이미지1">
                        </figure>
                        <div class="card__body">
                            <h3 class="card__title">오스트리아 크루아상</h3>
                            <p class="card__desc">오스트리아의 수도 빈이 오스만 제국의 침략을 받았지만 오스만 제국을 잘 막아 내어 그 기념으로 오스만 제국의 그려진 초승달 모양을 본따 만들어진 것이다.</p>
                            <a class="card__btn" href="#">
                                더 자세히 보기
                                <svg width="52" height="8" viewBox="0 0 52 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M51.3536 4.35355C51.5488 4.15829 51.5488 3.84171 51.3536 3.64645L48.1716 0.464466C47.9763 0.269204 47.6597 0.269204 47.4645 0.464466C47.2692 0.659728 47.2692 0.976311 47.4645 1.17157L50.2929 4L47.4645 6.82843C47.2692 7.02369 47.2692 7.34027 47.4645 7.53553C47.6597 7.7308 47.9763 7.7308 48.1716 7.53553L51.3536 4.35355ZM0 4.5H51V3.5H0V4.5Z" fill="#5B5B5B"/>
                                </svg>
                            </a>
                        </div>
                    </article>
                    <article class="card">
                        <figure class="card__header">
                            <img class="card__img" src="../assets/img/cardImg2.jpg" alt="이미지2">
                        </figure>
                        <div class="card__body">
                            <h3 class="card__title">멕시코 타코</h3>
                            <p class="card__desc">멕시코의 타코 요리는 신분을 구분하는 음식이었다고 한다. 귀족들은 옥수수를 먹는 사람들은 천하게 생각하여 타코를 먹지 않았다고 한다.</p>
                            <a class="card__btn" href="#">
                                더 자세히 보기
                                <svg width="52" height="8" viewBox="0 0 52 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M51.3536 4.35355C51.5488 4.15829 51.5488 3.84171 51.3536 3.64645L48.1716 0.464466C47.9763 0.269204 47.6597 0.269204 47.4645 0.464466C47.2692 0.659728 47.2692 0.976311 47.4645 1.17157L50.2929 4L47.4645 6.82843C47.2692 7.02369 47.2692 7.34027 47.4645 7.53553C47.6597 7.7308 47.9763 7.7308 48.1716 7.53553L51.3536 4.35355ZM0 4.5H51V3.5H0V4.5Z" fill="#5B5B5B"/>
                                </svg>
                            </a>
                        </div>
                    </article>
                    <article class="card">
                        <figure class="card__header">
                            <img class="card__img" src="../assets/img/cardImg3.jpg" alt="이미지3">
                        </figure>
                        <div class="card__body">
                            <h3 class="card__title">터키의 케밥</h3>
                            <p class="card__desc">터키는 이슬람의 교리에 따라 돼지고기를 먹지 않는다. 대신 양고기와 닭고기를 먹는데 그것을 이용하여 케밥을 만들어 먹는다. 터키의 대표음식이다.</p>
                            <a class="card__btn" href="#">
                                더 자세히 보기
                                <svg width="52" height="8" viewBox="0 0 52 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M51.3536 4.35355C51.5488 4.15829 51.5488 3.84171 51.3536 3.64645L48.1716 0.464466C47.9763 0.269204 47.6597 0.269204 47.4645 0.464466C47.2692 0.659728 47.2692 0.976311 47.4645 1.17157L50.2929 4L47.4645 6.82843C47.2692 7.02369 47.2692 7.34027 47.4645 7.53553C47.6597 7.7308 47.9763 7.7308 48.1716 7.53553L51.3536 4.35355ZM0 4.5H51V3.5H0V4.5Z" fill="#5B5B5B"/>
                                </svg>
                            </a>
                        </div>
                    </article>
                </div>
            </div>
        </section>
        <!-- //card-type -->

        <section id="comment-type" class="section center purple">
            <h3 class="section__title">음식 지식 공유하기</h3>
            <p class="section__desc">음식 지식 공유는 누구나 댓글을 달 수 있습니다. 회원가입 하지 않아도 공유 할 수 있습니다. 100글자 이내로 써주세요</p>
            <div class="comment__inner">
                <div class="comment__form">
                    <form action="commentSave.php" method="post" name="comment">
                        <fieldset>
                            <legend class="ir_so">댓글쓰기</legend>
                            <div class="comment__wrap">
                                <div>
                                    <label for="youName" class="ir_so">이름</label>
                                    <input type="text" name="youName" id="youName" class="input__style" placeholder="이름" autocomplete="off" required>
                                </div>
                                <div>
                                    <label for="youText" class="ir_so">댓글 쓰기</label>
                                    <input type="text" name="youText" id="youText" class="input__style width" placeholder="알고 있는 정보를 입력해주세요." autocomplete="off" required>
                                </div>
                                <button class="comment__btn" type="submit" value="댓글 작성하기">작성하기</button>
                            </div>
                        </fieldset>
                    </form>
                </div>
                <div class="comment__list">
                    <!-- <div class="list">
                        <p class="comment_desc">뱃살도둑 샐러드 진짜 맛있어요..!! 하지만 마라탕이 100배 더 맛있음.</p>
                        <div class="comment__icon">
                            <span class="face"><img src="../assets/face.png" alt="얼굴"></span>
                            <span class="name">이연우</span>
                            <span class="date">2022-03-11</span>
                        </div>
                    </div> -->
                    <?php
                        include "../connect/connect.php";

                        $sql = "SELECT * FROM myComment order by commentID DESC";
                        $result = $connect -> query($sql);
                        // $count = $result -> num_rows;
                        // $commentInfo = $result -> fetch_array(MYSQLI_ASSOC);

                        // echo "<pre>";
                        // var_dump($commentInfo);
                        // echo "</pre>";
                        
                        //for문으로 댓글 출력.
                        if($result) {
                            $count = $result -> num_rows;

                            if($count > 0){
                                for($i=1; $i<=$count; $i++){
                                    $commentInfo = $result -> fetch_array(MYSQLI_ASSOC);
                                    echo "<div class='list'>";
                                    echo "<p class='comment_desc'>".$commentInfo['youText']."</p>";
                                    echo "<div class='comment__icon'>";
                                    echo "<span class='face'><img src='../assets/img/face.png' alt='얼굴'></span>";
                                    echo "<span class='name'>".$commentInfo['youName']."</span>";
                                    echo "<span class='date'>".date('Y-m-d', $commentInfo['regTime'])."</span>";
                                    echo "</div>";
                                    echo "</div>";
                                }
                            }
                        }
                    ?>
                </div>
            </div>
        </section>
    </main>
    
    <?php
        include "../include/footer.php";
    ?>
</body>
</html>
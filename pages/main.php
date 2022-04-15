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
    <title>PHP 사이트</title>
    <?php
        include "../include/style.php";
    ?>
    <link rel="stylesheet" href="assets/quizComment.css">
    <style>
        .footer {
            background: #f5f5f5;
        }

        /* slider */
        #slider-type {
            
        }
        .slider__wrap {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            /* height: 100vh; */
        }
        .slider__img {          /* 화면 보이는 구간 */
            position: relative;
            width: 100vw;
            overflow: hidden;
        }
        .slider__inner {        /* 이미지 움직이는 영역 */
            position: relative;
            display: flex;
            width: 800vw;          /* 이미지 총 길이 */
            left: -100vw;
        }
        .slider__inner.transition {
            transition: all 600ms;
        }
        .slider {
            position: relative;
            height: 600px;
            /* width: 100vw; */
            /* height: 500px; */
            /* background-position: center center; */
        }
        .slider.s1 {background-image: url(../assets/img/sliderimg1.png); background-size: cover;}
        .slider.s2 {background-image: url(../assets/img/sliderimg2.png); background-size: cover;}
        .slider.s3 {background-image: url(../assets/img/sliderimg3.png); background-size: cover;}
        .slider.s4 {background-image: url(../assets/img/sliderimg4.png); background-size: cover;}
        .slider.s5 {background-image: url(../assets/img/sliderimg5.png); background-size: cover;}
        .slider.s6 {background-image: url(../assets/img/sliderimg6.png); background-size: cover;}

        .swiper-slide {
            width: 100vw;
            margin: 0 auto;
        }

        .swiper-slide .desc {
            margin: 0 auto;
            max-width: 1200px;
            padding: 50px 0;
            color: #fff;
            font-family: 'NexonLv1Gothic';
        }

        .swiper-slide .desc span {
            font-size: 18px;
        }

        .swiper-slide .desc h4 {
            font-size: 110px;
            font-weight: 300;
            margin-left: -8px;
            margin-bottom: 20px;
        }

        .swiper-slide .desc p {
            font-size: 24px;
            font-weight: 300;
            margin-bottom: 5vw;
        }

        .swiper-slide .desc .btn a {
            font-size: 16px;
            padding: 11px 40px;
            display: inline-block;
        }

        .swiper-slide .desc .btn .white {
            background: #fff;
            color: #000;
        }

        .swiper-slide .desc .btn .black {
            background: #000;
            color: #fff;
        }
        .slider::before {
            position: absolute;
            left: 5px;
            top: 5px;
            background: rgba(0,0,0,0.4);
            color: #fff;
            padding: 5px 10px 3px;
        }
        .slider.s1::before {content: '이미지1';}
        .slider.s2::before {content: '이미지2';}
        .slider.s3::before {content: '이미지3';}
        .slider.s4::before {content: '이미지4';}
        .slider.s5::before {content: '이미지5';}
        .slider.s6::before {content: '이미지6';}

        .slider__btn {
            height: 100%;
        }
        .slider__btn a {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            z-index: 100;
            width: 30px;
            height: 57px;
            transition: all 0.2s;
            display: block;
            text-indent: -9999px;
        }
        .slider__btn a.prev {
            left: 20px;
            background-image: url(../assets/img/prev.svg);
        }
        .slider__btn a.next {
            right: 20px;
            background-image: url(../assets/img/next.svg);
        }
        .slider__btn a:hover {
            background-color: rgba(0,0,0,0.25);
        }
        .slider__dot {
            display:block;
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            bottom: 2vw;
        }
        .slider__dot .dot {
            display: inline-block;
            width: 14px; height: 14px;
            background-image: url(../assets/img/dot.svg);
            transition: all 0.3s;
            margin: 0 3px;
        }
        .slider__dot .dot.active {
            background-image: url(../assets/img/dotactive.svg);
        }
        .slider__dot .play {
            background-image: url(../assets/img/play.svg);
            background-position: center center;
            background-size: cover;
            width: 14px; height: 14px;
            display: inline-block;
            margin: 3px;
            text-indent: -9999px;
            position: relative;
            display: none;
        }
        .slider__dot .play.show {
            display: inline-block;
        }
        .slider__dot .stop {
            background-image: url(../assets/img/stop.svg);
            background-position: center center;
            background-size: cover;
            width: 14px; height: 14px;
            display: inline-block;
            margin: 3px;
            text-indent: -9999px;
            position: relative;
            display: none;
        }
        .slider__dot .stop.show {
            display: inline-block;
        }
    </style>
</head>
<body>
    <?php
        include "../include/header.php";
    ?>
    <!-- //header -->

    <main id="contents">
        <h2 class="ir_so">컨텐츠 영역</h2>

        <section id="slider-type">
            <div class="slider__wrap">
                <div class="slider__img">
                    <div class="slider__inner">
                        <div class="slider s1">
                            <div class="swiper-slide">
                                <div class="desc">
                                    <span>DEVELOPER</span>
                                    <h4>NEW PROJECT</h4>
                                    <p>너무 무리하지 말아요!<br>이미 당신은 해내고 있고!<br>앞으로도 잘 할 수 있어요!</p>
                                    <div class="btn">
                                        <a href="#" class="white">자세히 보기</a>
                                        <a href="#" class="black">사이트 보기</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="slider s2">
                            <div class="swiper-slide">
                                <div class="desc">
                                    <span>DEVELOPER</span>
                                    <h4>NEW PROJECT</h4>
                                    <p>너무 무리하지 말아요!<br>이미 당신은 해내고 있고!<br>앞으로도 잘 할 수 있어요!</p>
                                    <div class="btn">
                                        <a href="#" class="white">자세히 보기</a>
                                        <a href="#" class="black">사이트 보기</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="slider s3">
                            <div class="swiper-slide">
                                <div class="desc">
                                    <span>DEVELOPER</span>
                                    <h4>NEW PROJECT</h4>
                                    <p>너무 무리하지 말아요!<br>이미 당신은 해내고 있고!<br>앞으로도 잘 할 수 있어요!</p>
                                    <div class="btn">
                                        <a href="#" class="white">자세히 보기</a>
                                        <a href="#" class="black">사이트 보기</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="slider s4">
                            <div class="swiper-slide">
                                <div class="desc">
                                    <span>DEVELOPER</span>
                                    <h4>NEW PROJECT</h4>
                                    <p>너무 무리하지 말아요!<br>이미 당신은 해내고 있고!<br>앞으로도 잘 할 수 있어요!</p>
                                    <div class="btn">
                                        <a href="#" class="white">자세히 보기</a>
                                        <a href="#" class="black">사이트 보기</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="slider s5">
                            <div class="swiper-slide">
                                <div class="desc">
                                    <span>DEVELOPER</span>
                                    <h4>NEW PROJECT</h4>
                                    <p>너무 무리하지 말아요!<br>이미 당신은 해내고 있고!<br>앞으로도 잘 할 수 있어요!</p>
                                    <div class="btn">
                                        <a href="#" class="white">자세히 보기</a>
                                        <a href="#" class="black">사이트 보기</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="slider s6">
                            <div class="swiper-slide">
                                <div class="desc">
                                    <span>DEVELOPER</span>
                                    <h4>NEW PROJECT</h4>
                                    <p>너무 무리하지 말아요!<br>이미 당신은 해내고 있고!<br>앞으로도 잘 할 수 있어요!</p>
                                    <div class="btn">
                                        <a href="#" class="white">자세히 보기</a>
                                        <a href="#" class="black">사이트 보기</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="slider__btn">
                    <a href="#" class="prev">prev</a>
                    <a href="#" class="next">next</a>
                </div>
                <div class="slider__dot">
                    <!-- <a href="#" class="dot active"></a>
                    <a href="#" class="dot"></a>
                    <a href="#" class="dot"></a>
                    <a href="#" class="dot"></a>
                    <a href="#" class="dot"></a> -->
                </div>
            </div>
        </section>
        <!-- //banner -->
        <section id="blog-type" class="section center type">
            <div class="container">
                <h3 class="section__title">음식 블로그</h3>
                <p class="section__desc">음식에 관련된 블로그입니다. 다양한 정보를 확인하세요!</p>
                <div class="blog__inner">
                    <div class="blog__cont">
                        <?php
                            $sql = "SELECT blogImgFile, blogCategory, blogTitle, blogContents, blogAuthor, blogRegTime, blogID, blogView, blogLike FROM myBlog WHERE blogDelete = 1 ORDER BY blogID DESC LIMIT 3";
                            $result = $connect -> query($sql);

                            foreach($result as $blog){?>
                                <article class="blog">
                                    <figure class="blog__header" aria-hidden="true">
                                        <a href="../blog/blogView.php?blogID=<?=$blog['blogID']?>" style="background-image: url(../assets/img/blog/<?=$blog['blogImgFile']?>);"></a></figure>
                                    <div class="blog__body">
                                        <span class="blog__cate"><?=$blog['blogCategory']?></span>
                                        <a href="../blog/blogView.php?blogID=<?=$blog['blogID']?>">
                                            <div class="blog__title">
                                                <?=$blog['blogTitle']?>
                                            </div>
                                        </a>
                                        <div class="blog__desc"><?=$blog['blogContents']?></div>
                                        <div class="blog__info">
                                            <span class="author"><?=$blog['blogAuthor']?></span>
                                            <span class="date"><?=date('Y-m-d', $blog['blogRegTime'])?></span>
                                            <div class="blog__att">
                                                <span class="view">VIEW : <?=$blog['blogView']?></span>
                                                <span class="like">LIKE : <?=$blog['blogLike']?></span>
                                            </div>
                                        </div>
                                    </div>
                                    </a>
                                </article>
                            <?php } ?>
                    </div>
                </div>
            </div>
        </section>
        <!-- //blog-type -->
        <section id="quiz-type" class="section center gray">
            <div class="container">
                <h3 class="section__title">퀴즈</h3>
                <p class="section__desc">
                여러나라의 음식 문화는 아주 다양하고 각양각색이다.<br>영국에서는 모기 눈알로 스프를 만들어 먹는다고도 한다.
                </p>
                <div class="quiz__inner">
                    <div class="quiz__header">
                        <!-- <span class="quiz__subject">javascript</span> -->
                        <div class="quiz__subject">
                            <label for="quizSubject">과목 선택</label>
                            <select name="quizSubject" id="quizSubject"> <!--  onchange="quizData(this.value);" -->
                                <option value="javascript">javascript</option>
                                <option value="jquery">jquery</option>
                                <option value="html">html</option>
                                <option value="css">css</option>
                            </select>
                        </div>
                    </div>
                    <div class="quiz__body">
                        <div class="title">
                            <span class="quiz__num"></span>.
                            <span class="quiz__ask"></span>
                            <div class="quiz__desc"></div>
                        </div>
                        <div class="contents">
                            <div class="quiz__selects">
                                <label for="select1">
                                    <input class="select" type="radio" id="select1" name="select" value="1">
                                    <span class="choice"></span>
                                </label>
                                <label for="select2">
                                    <input class="select" type="radio" id="select2" name="select" value="2">
                                    <span class="choice"></span>
                                </label>
                                <label for="select3">
                                    <input class="select" type="radio" id="select3" name="select" value="3">
                                    <span class="choice"></span>
                                </label>
                                <label for="select4">
                                    <input class="select" type="radio" id="select4" name="select" value="4">
                                    <span class="choice"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="comment_wrap none">
                        <div class="comment_box">
                            <textarea id="comment_text" readonly></textarea>
                            <button class="comment_close">닫기</button>
                        </div>
                    </div>
                    <div class="quiz__footer">
                        <div class="quiz__btn">
                            <button class="comment green none">해설 보기</button>
                            <button class="next orange right ml10 none">다음 문제</button>
                            <button class="confirm green right">정답 확인</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- //quiz -->
        <section id="notice-type" class="section center">
            <div class="container">
                <h3 class="section__title">음식 게시판</h3>
                <p class="section__desc">음식과 관련된 게시판입니다. 다양한 정보를 확인하세요!</p>
                <div class="notice__inner">
                    <article class="notice">
                        <h4>공지사항</h4>
                        <ul>
                        <?php
                            $sql = "SELECT boardTitle, regTime, boardID FROM myBoard ORDER BY boardID DESC LIMIT 4";
                            $result = $connect -> query($sql);

                            foreach($result as $board){ ?>
                                <li>
                                    <a href="../board/boardView.php?boardID=<?=$board['boardID']?>">
                                        <?=$board['boardTitle']?>
                                    </a>
                                    <span class="time">
                                        <?=date('Y-m-d', $board['regTime'])?>
                                    </span>
                                </li>
                        <?php ; } ?>
                        </ul>
                        <a href="../board/board.php" class="more">더보기</a>
                    </article>
                    <article class="notice">
                        <h4>댓글</h4>
                        <?php
                            $sql = "SELECT youText, regTime FROM myComment ORDER BY commentID DESC LIMIT 4";
                            $result = $connect -> query($sql);

                            foreach($result as $comment){?>
                                <li><a href="../comment/comment.php"><?=$comment['youText']?></a><span class="time"><?=date('Y-m-d', $comment['regTime'])?></span></li>
                                <?php } ?>
                        </ul>
                        <a href="../comment/comment.php" class="more">더보기</a>
                    </article>
                </div>
            </div>
        </section>
        <!-- //notice-type -->

    </main>
    <!-- //main -->

    <?php
        include "../include/footer.php";
    ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        let quizAnswer = "";

        function quizView(view){
            $(".quiz__num").text(view.quizID);
            $(".quiz__ask").text(view.quizAsk);
            $("#select1 + span").text(view.quizChoice1);
            $("#select2 + span").text(view.quizChoice2);
            $("#select3 + span").text(view.quizChoice3);
            $("#select4 + span").text(view.quizChoice4);
            quizAnswer = view.quizAnswer;
        }

        //정답 체크 : 
        // function quizNext(){

        // }

        //정답 체크
        function quizCheck(){
            let selectCheck = $(".quiz__selects input:checked").val();
            //정답을 체크 안했으면
            if(selectCheck == null || selectCheck == ''){
                alert("정답을 체크해주세요!!!");
                $(".quiz__selects input").attr("disabled", false);
            } else {
                $(".quiz__btn .next").fadeIn();
                $(".quiz__btn .comment").fadeIn();
                $(".quiz__selects input").attr("disabled", true);
                //정답을 체크 했으면
                if(selectCheck == quizAnswer){
                    //정답
                    $(".quiz__selects #select"+quizAnswer).addClass("correct");
                } else {
                    //오답
                    $(".quiz__selects #select"+selectCheck).addClass("incorrect");
                    $(".quiz__selects #select"+quizAnswer).addClass("correct");
                }
            }
        }

        //문제 데이터 가져오기
        function quizData(){
            let quizSubject = $("#quizSubject").val();
            $.ajax({
                url: "../quiz/quizInfo.php",
                method: "POST",
                data: {"quizSubject": quizSubject},
                dataType: "json",
                success: function(data){
                    console.log(data);
                    // $(".section__title").text(data.quiz.quizSubject + " 퀴즈");
                    quizView(data.quiz);
                    commentDesc(data.quiz);
                },
                error: function(request, status, error){
                    console.log('request' + request);
                    console.log('status' + status);
                    console.log('error' + error);
                }
            })
        }
        // quizData("javascript");
        quizData();

        //해설보이기
        function showComment(comment){
            $(".comment_wrap").slideDown();
            $(".comment_close").click(function(){
                $(".comment_wrap").slideUp();
            });
        }

        function commentDesc(comment){
            if(comment.quizComment){
                var text = comment.quizComment;
                var regExp = /[\{\}\[\]\/?,;:|\)*~`!^\-_+<>@\#$%&\\\=\(\'\"]/gi;
                text = text.replace(regExp, "");
                text = text.replace(/br/gi, "");
                $("#comment_text").text(text);
            }else{
                $(".comment_text").text("해설 없음");
            }
        }

        //과목 선택
        $("#quizSubject").change(function(){
            quizData();
            $(".quiz__selects input").attr("disabled", false);
            $(".quiz__selects input").prop("checked", false);
            $(".quiz__selects input").removeClass("incorrect");
            $(".quiz__selects input").removeClass("correct");
            $(".quiz__btn .next").fadeOut();
            $(".quiz__btn .comment").fadeOut();
        })

        //정답 확인
        $(".quiz__btn .confirm").click(function(){
            //정답을 클릭했는지 안했는지 판단
            quizCheck();
              //  fadeOut  //  afdeToggle
            // $(".quiz__btn .comment").fadeIn();
            // $(".quiz__btn .next").slideDown();  //slideUp  //slideToggle
            //$(".quiz__btn .next").show();   //hide()  //toggle()
        });

        //다음 문제
        $(".quiz__btn .next").click(function(){
            quizData();
            $(".quiz__selects input").attr("disabled", false);
            $(".quiz__selects input").prop("checked", false);
            $(".quiz__selects input").removeClass("incorrect");
            $(".quiz__selects input").removeClass("correct");
            $(".quiz__btn .next").fadeOut();
            $(".quiz__btn .comment").fadeOut();
        });

        //해설 보기
        $(".quiz__btn .comment").click(function(){
            showComment();
        });
    </script>
    <!-- //퀴즈 -->

    <script>
        // slider07
        const sliderWrap = document.querySelector(".slider__wrap");
        const sliderImg = document.querySelector(".slider__img");
        const sliderInner = document.querySelector(".slider__inner");
        const slider = document.querySelectorAll(".slider");
        const sliderBtn = document.querySelector(".slider__btn");
        const sliderBtnPrev = sliderBtn.querySelector(".prev");
        const sliderBtnNext = sliderBtn.querySelector(".next");
        const sliderDot = document.querySelector(".slider__dot");
        
        let currentIndex = 0;
        // let sliderWidth = sliderImg.offsetWidth;        //이미지 가로 값
        let sliderLength = slider.length;               //이미지 갯수
        let sliderFirst = slider[0];                    //첫 번째 이미지
        let sliderLast = slider[sliderLength - 1];      //마지막 이미지
        let cloneFirst = sliderFirst.cloneNode(true);   //첫 번째 이미지 복사
        let cloneLast = sliderLast.cloneNode(true);     //마지막 이미지 복사
        let posInitial = "";
        let dotIndex = "";
        let sliderTimer = "";
        let interval = 2000;

        let dotbtn = 0;

        //이미지 복사
        sliderInner.appendChild(cloneFirst);
        sliderInner.insertBefore(cloneLast, sliderFirst);

        //닷 메뉴 셋탕
        function dotInit(){
            for(let i=0; i<sliderLength; i++){
                dotIndex += "<a href='#' class='dot'></a>";
            }
            dotIndex += "<a href='#' class='play'>play</a>";
            dotIndex += "<a href='#' class='stop show'>stop</a>";
            sliderDot.innerHTML = dotIndex;
            sliderDot.firstElementChild.classList.add("active");
        }
        dotInit();

        dotActive = document.querySelectorAll(".slider__dot .dot");
        
        //이미지 움직이기
        function gotoSlider(index){
            dotActive.forEach(el => {
                el.classList.remove("active");
            });

            if(index == sliderLength){
                dotActive[0].classList.add("active");
            }else {
                dotActive[index].classList.add("active");
            }
            
            sliderInner.classList.add("transition");
            sliderInner.style.left = -100 * (index+1) + "vw";

            // console.log(currentIndex);
            currentIndex = index;

            //두 번째 이미지 : left: -1600px
            //세 번째 이미지 : left: -2400px
            //네 번째 이미지 : left: -3200px
            //다섯 번째 이미지 : left: -4000px
        }

        document.querySelectorAll(".slider__dot .dot").forEach((dot, index) => {
            dot.addEventListener("click", () => {
                gotoSlider(index);
            })
        })

        //자동재생
        function autoPlay(){
            sliderTimer = setInterval(()=>{
                gotoSlider(currentIndex + 1);
            }, interval);
        }
        autoPlay();

        function stopPlay(){
            clearInterval(sliderTimer);
        }

        sliderBtnPrev.addEventListener("click", () => {
            let prevIndex = currentIndex - 1;
            gotoSlider(prevIndex);
        });

        sliderBtnNext.addEventListener("click", () => {
            let nextIndex = currentIndex + 1;
            gotoSlider(nextIndex);
        });

        sliderInner.addEventListener("transitionend", () => {
            sliderInner.classList.remove("transition");
            if(currentIndex == -1){
                sliderInner.style.left = -(sliderLength * 100) + "vw";
                currentIndex = sliderLength -1;
            }
            if(currentIndex == sliderLength){
                sliderInner.style.left = -(1 * 100) + "vw";
                currentIndex = 0;
            }
        });

        sliderInner.addEventListener("mouseenter", () => {
            if(document.querySelector(".play").classList.contains("show")){
                stopPlay();
            } else {
                document.querySelector(".stop").classList.remove("show");
                document.querySelector(".play").classList.add("show");
                stopPlay();
            }
            // document.querySelector(".stop").classList.remove("show");
            // document.querySelector(".play").classList.add("show");
            // stopPlay();
        });

        sliderInner.addEventListener("mouseleave", () => {
            if(document.querySelector(".play").classList.contains("show") && dotbtn == 0){
                document.querySelector(".play").classList.remove("show");
                document.querySelector(".stop").classList.add("show");
                autoPlay();
            } else if(dotbtn == 0){
                document.querySelector(".stop").classList.remove("show");
                document.querySelector(".play").classList.add("show");
                autoPlay();
            }
            // if(document.querySelector(".play").classList.contains("show")){
            //     stopPlay();
            // } else {
            //     document.querySelector(".stop").classList.remove("show");
            //     document.querySelector(".play").classList.add("show");
            //     autoPlay();
            // }
        });

        document.querySelector(".play").addEventListener("click", () => {
            document.querySelector(".play").classList.remove("show");
            document.querySelector(".stop").classList.add("show");
            dotbtn = 0;
            autoPlay();
        });

        document.querySelector(".stop").addEventListener("click", () => {
            document.querySelector(".stop").classList.remove("show");
            document.querySelector(".play").classList.add("show");
            dotbtn = 1;
            stopPlay();
        });
    </script>
</body>
</html>
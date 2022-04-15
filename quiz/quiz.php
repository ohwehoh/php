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
    <title>PHP 퀴즈사이트</title>
    <?php
        include "../include/style.php";
    ?>
    <link rel="stylesheet" href="../pages/assets/quizComment.css">
</head>
<body>
    <?php
        include "../include/header.php";
    ?>
    <!-- //header -->

    <main id="contents">
        <h2 class="ir_so">컨텐츠 영역</h2>
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
</body>
</html>
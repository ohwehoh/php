<?php
    include "../connect/connect.php";
    include "../connect/session.php";
    include "../connect/sessionCheck.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>블로그 수정하기</title>

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
        $blogID = $_GET['blogID'];
    ?>

    <main id="contents">
        <h2 class="ir_so">컨텐츠 영역</h2>
        <section id="blog-type" class="section center">
            <div class="container">
                <h3 class="section__title">블로그 수정하기</h3>
                <p class="section__desc">블로그에 올린 글을 수정합니다.</p>
                <div class="blog__inner">
                    <div class="blog__write">
                        <form action="blogModifySave.php?blogID=<?=$blogID?>" name="blogWrite" method="post" enctype="multipart/form-data">
                            <fieldset>
                                <legend class="ir_so">블로그 게시글 수정 영역</legend>
                                <?php
                                     $sql = "SELECT blogImgFile, blogCategory, blogTitle, blogContents, blogRegTime FROM myBlog WHERE blogID = '{$blogID}'";
                                     $result = $connect -> query($sql);

                                     $blogInfo = $result -> fetch_array(MYSQLI_ASSOC);
                                ?>
                                <div>
                                    <label for="blogCate">카테고리</label>
                                    <select name="blogCate" id="blogCate">
                                        <?php
                                            switch($blogInfo['blogCategory']){
                                                case 'daily':
                                        ?>          <option value="daily" selected>일상</option>
                                                    <option value="info">정보</option>
                                                    <option value="news">소식</option>
                                                    <option value="dish">요리</option>
                                        <?php       break; 
                                                case 'info': ?>
                                                    <option value="daily">일상</option>
                                                    <option value="info" selected>정보</option>
                                                    <option value="news">소식</option>
                                                    <option value="dish">요리</option>
                                        <?php        break;
                                                case 'news': ?>
                                                    <option value="daily">일상</option>
                                                    <option value="info">정보</option>
                                                    <option value="news" selected>소식</option>
                                                    <option value="dish">요리</option>
                                        <?php        break;
                                                case 'dish': ?>
                                                    <option value="daily">일상</option>
                                                    <option value="info">정보</option>
                                                    <option value="news">소식</option>
                                                    <option value="dish" selected>요리</option>
                                        <?php        break;
                                            }
                                        ?>
                                    </select>
                                <div>
                                    <label for="blogTitle">제목</label>
                                    <input type="text" name="blogTitle" id="blogTitle" placeholder="제목을 넣어주세요" value="<?=$blogInfo['blogTitle']?>" required>
                                </div>
                                <div>
                                    <label for="blogContents">내용</label>
                                    <?php
                                        $txt = $blogInfo['blogContents'];   //대상 문자열
                                        $result = str_replace('<br />' , '', $txt);
                                        // str_replace('바껴서 없어질 문자' , '변경 완료 될 문자', '대상 문자열');
                                    ?>
                                    <textarea name="blogContents" id="blogContents" placeholder="내용을 넣어주세요!" required><?=$result?></textarea>
                                </div>
                                <div style="margin-bottom:40px;">
                                    <label for="blogImg">현재파일</label>
                                    <img src="../assets/img/blog/<?=$blogInfo['blogImgFile']?>" alt="현재이미지" style="margin-bottom:20px;" class="modifyImg">
                                    <button type="button" onclick="delImg()">현재파일 지우기</button>
                                </div>
                                <div>
                                    <label for="blogFile">파일바꾸기</label>
                                    <input type="file" name="blogFile" id="blogFile" placeholder="사진을 넣어주세요! 사진은 jpg, gif, png 파일만 지원이 됩니다.">
                                </div>
                                <button type="submit" value="저장하기">저장하기</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php
        include "../include/footer.php";
    ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        function delImg() {
            var delImg = "<? echo $blogInfo['blogImgFile'];?>";
            var blogID = "<? echo $blogID;?>";
            $.ajax({
            type : "POST",           
            url : "blogImgDel.php",     
            data : {"blogID": blogID, "delImg": delImg},
            dataType : "json",
            success : function(data){ 
                $(".modifyImg").attr("src", "../assets/img/blog/default.svg");
            },
            error : function(request, status, error){
                console.log("request" + request);
                console.log("status" + status);
                console.log("error" + error);
            }
            });
        }
    </script>
</body>
</html>
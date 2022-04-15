<?php
    $sql = "SELECT count(blogID) FROM myBlog WHERE blogDelete = 1";
    $result = $connect -> query($sql);
    
    $blogCount = $result -> fetch_array(MYSQLI_ASSOC);
    $blogCount = $blogCount['count(blogID)'];

    //총 페이지 갯수
    $blogCount = ceil($blogCount / $pageView);

    //현재 페이지를 기준으로 보여주고 싶은 갯수
    $pageCurrent = 5;
    $startPage = $page - $pageCurrent;
    $endPage = $page + $pageCurrent;

    //처음 페이지 초기화
    if($startPage < 1) $startPage = 1;

    //마지막 페이지 초기화
    if($endPage >= $blogCount) $endPage = $blogCount;

    //처음 페이지
    if($page != 1){
        echo "<li><a href='blog.php?page=1'>&lt;&lt;</a></li>";
    }

    //이전 페이지
    if($page != 1){
        $prePage = $page - 1;
        echo "<li><a href='blog.php?page{$prePage}'>&lt;</a></li>";
    }

    //페이지 넘버 표시
    for($i=$startPage; $i<=$endPage; $i++){
        $active = "";
        if($i == $page){
            $active = "active";
        }
        echo "<li class='{$active}'><a href='blog.php?page={$i}'>{$i}</a></li>";
    }

    //다음 페이지
    if($page != $blogCount){
        $nextPage = $page + 1;
        echo "<li><a href='blog.php?page={$nextPage}'>&gt;</a></li>";
    }

    //마지막 페이지
    if($page != $blogCount){
        echo "<li><a href='blog.php?page={$blogCount}'>&gt;&gt;</a></li>";
    }
?>
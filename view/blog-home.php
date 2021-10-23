<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("helper/head.php");
    session_start(); ?>
</head>

<body>
    <?php
    include("helper/navbar.php");
    require_once("../model/post.php");
    require_once("../model/banco.php");

    if(!isset($_SESSION['idUser'])){
      echo '  <div class="container">
        <div class="panel panel-default text center">
            <div class="panel-body">
            <h3>To access the blog you need to login or create an account</h3>
            <a href="login.php" class="text-center btn btn-md btn-primary">Sign in or Create an account </a>
            </div>
            </div>
        </div>';
        exit();
    }
    ?>
    

    <div class="container">
        <div class="row">
            <div class="leftcolumn">
                <?php
                $post = new Post();
                //for pagination
                if (isset($_GET['page_no']) && $_GET['page_no'] != "") {
                    $page_no = $_GET['page_no'];
                } else {
                    $page_no = 1;
                }
                //Start - Insane calc of pagination
                $total_records_per_page = 4; //num of post per page
                $offset = ($page_no - 1) * $total_records_per_page;
                $previous_page = $page_no - 1;
                $next_page = $page_no + 1;
                $adjacents = "2";

                $total_records = $post->countPosts();
                $total_no_of_pages = ceil($total_records / $total_records_per_page);
                $second_last = $total_no_of_pages - 1; // total page minus 1
                //Finish calc of pagination

                $all = $post->list($total_records_per_page, $offset);

                foreach ($all as $key => $value) {
                    $dt = date_create($value['date']); //criando obj tipo data para formatar 

                    if (strlen($value['description']) > 500) {
                        $descr = strip_tags($value['description']);
                        $d =  substr($descr, 0, 500);
                    } else $d = $value['description'];

                    echo '<div class="card">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h2 class="text-center">' . strtoupper($value['title']) . '</h2>
                                <hr>
                                <h5>
                                    <div class="row">
                                        <div class="col-sm-11 text-left"><b>' . date_format($dt, 'H:i:s  l, d-m-Y') . '</b></div>
                                        <div class="col-sm-1">
                                            <span class="glyphicon glyphicon-heart"></span> <span id="like-' . $value['idpost'] . '"> ' . $value['likes'] . '</span>
                                        </div>
                                    </div>
                                </h5>
                            </div>
                            <div class="panel-body">
                                <p>
                                ' . $d /*description*/ . '
                                </p>
                            </div>
                            <div>
                                <div class="btn-group btn-group-justified">
                                    <div class="btn-group">
                                        <form method="get" action="blog-post-page.php">
                                            <input type="hidden" name="idpost" value="' . $value['idpost'] . '">
                                            <button id="comment" type="submit" class="btn btn-primary"> <span class="glyphicon glyphicon-comment"></span> Comment</button>
                                        </form>
                                    </div>
                                    <div class="btn-group">
                                        <button data-post-id="' . $value['idpost'] . '" type="button" class="btn btn-primary tipolikeid"><span class="glyphicon glyphicon-heart"></span> Like</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>';
                }
                ?>
                <?php include("helper/pagination.php") ?>

                <script type="text/javascript">
                    $(function() {
                        $(".tipolikeid").click(function() {
                            postID = $(this).attr("data-post-id");
                            $.ajax({
                                method: "post",
                                url: "../controller/ControllerPost.php",
                                data: {
                                    idPost: postID,
                                    postOp: "2",
                                },
                                success: function(retorno) {
                                    $("#like-" + postID).html(retorno);
                                }
                            })
                        });
                    });
                </script>
            </div>

            <div class="rightcolumn">
                <div class="card text-center">
                    <h3>POPULAR POST'S</h3>
                    <?php
                    $all = $post->listPopular();

                    foreach ($all as $key => $value) {
                        echo '
                        <div class="panel panel-default">
                            <div class=" panel-heading">
                                <div class="row">
                                    <div class="col-sm-10"><h5 class="text-center" style="text-size-adjust: auto;">
                                        ' . strtoupper($value['title']) . '
                                        </h5>
                                    </div>
                                    <div class="col-sm-1">
                                        <span class="glyphicon glyphicon-heart"></span>' . $value['likes'] . '
                                    </div>
                                </div>
                                <div class="row">
                                    <form method="get" action="blog-post-page.php">
                                        <input type="hidden" name="idpost" value="' . $value['idpost'] . '">
                                        <button type="submit" class="btn btn-block btn-link btn-sm" style="padding:0px">Read</button>
                                    </form>
                                </div>
                            </div>
                            
                        </div>';
                    }
                    ?>
                </div>
                <div class="card text-center">
                    <h3>SUGGESTION</h3>
                    <h5 class="text-justify"><p>Suggest new access points to the library and laboratories in your region, or suggestions for improvements to the site, praise and complaints</p></h5>
                    <div class="panel panel-default">
                        <div class=" panel-body">
                            <a href="suggestion.php">
                                <button class="btn btn-block btn-success btn-md" style="padding:0px">I want to suggest</button>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card text-center">
                    <h2>ABOUT US</h2>
                    <div class="panel panel-default">
                        <p class="bg-success">We develop this page with great care for the best user experience! <b>Follow us</b></p>
                        <div class=" panel-body">
                            <div class="row">
                                <a href="https://www.linkedin.com/in/phelipe-rodovalho-ufu/">
                                    <img class="imag-responsive img-circle " src="img/ph.jpg" style="width: 60%; ">
                                </a>
                            </div>
                            <div class="row" style="margin-top: 10px;">
                                <a href="https://www.linkedin.com/in/g%C3%A9ssica-santos-47b7911b3/">
                                    <img class="imag-responsive img-circle " src="img/gess.jpg" style="width: 60%; ">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include("helper/footer.php") ?>
</body>

</html>
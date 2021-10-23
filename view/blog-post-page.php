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
    
    //$_SESSION['userId'] = 3;

    $id = filter_input(INPUT_GET, "idpost"); //recuperando id post a ser comentado

    $post = new Post();
    if (isset($_GET['idpost']) && $_GET['idpost'] != "") { //para recuperar post caso pag seja recarregada
        $id = $_GET['idpost'];
        $p = $post->listOnePost($id);
        $dt = date_create($p['date']);
    } else {
        echo "<script type='text/javascript'>alert('Fail to open post :( try again');window.location.href = 'blog-home.php';</script>";
    }

    ?>

    <div class="container panel panel-default">
        <div class="row">
            <div class="col-md card">

                <div class="text-center">
                    <h2><?php echo strtoupper($p['title']) ?></h2>
                    <hr style="height:2px;background-color:gray">
                </div>

                <div class="card">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h5>
                                <div class="row">
                                    <div class="col-sm-11 text-left"><b><?php echo date_format($dt, 'H:i:s  l, d-m-Y'); ?></b></div>
                                    <div class="col-sm-1">
                                        <span class="glyphicon glyphicon-heart"></span> <?php echo $p['likes'] ?>
                                    </div>
                                </div>
                            </h5>
                        </div>
                        <div class="panel-body">
                            <p>
                                <?php echo $p['description'] ?>
                            </p>
                        </div>

                    </div>
                </div>
                <div class="card">
                    <?php
                    $comment = new Comment();
                    //$com = $comment->list($id);
                    ?>
                    <h4 class="card">Leave a comment:</h4>
                    <form action=" " method="POST" role="form">
                        <div class="form-group">
                            <label class="checkbox-inline">
                                <input type="checkbox" name="tag" value="Positive">Positive
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" name="tag" value="Negative">Negative
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" name="tag" value="Impartial">Impartial
                            </label>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="idpost" value=<?php echo $id ?>>
                            <textarea name="descriptionC" class="form-control" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-success">Send a comment</button>
                    </form>
                    <br><br>
                    <?php
                    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["descriptionC"])) {
                        $descrip = filter_input(INPUT_POST, "descriptionC", FILTER_SANITIZE_STRING);
                        $idp = filter_input(INPUT_POST, "idpost");
                        $dt = date("Y-m-d H:i:s");
                        $tag = filter_input(INPUT_POST, "tag");

                        $comment->insert($descrip, $dt, $tag, $idp, $_SESSION['idUser']);
                    }
                    ?>

                    <p><span class="badge">
                            <?php
                            echo $count = $comment->countComment($id); //mostrando quantidade de comentarios
                            ?>
                        </span> Comments:</p><br>

                    <?php //listar comentarios
                    $com = $comment->list($id);
                    foreach ($com as $key => $value) {
                        $dt = date_create($value['date']);
                        echo '<div class="row">
                        <div class="col-sm-2 text-center">
                            <img src="img/img_avatar.png" class="img-circle" height="65" width="65" alt="Avatar">
                        </div>
                        <div class="col-sm-10">
                            <h4>' . $value['name'] . ' <small>' . date_format($dt, 'H:i:s  l, d-m-Y') . '    Tag: <b>' . $value['tag'] . '<b></small></h4>
                            <p> ' . $value['description'] . '
                            </p>
                            <br>
                        </div>
                        </div>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php include("helper/footer.php") ?>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("helper/head.php") ?>
    <script src="https://cdn.tiny.cloud/1/yurkwx6m9mhihtylqvdycmktq2zl3kh9tq8eied6qhuzetqd/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
</head>

<body>
    <?php
    session_start();
    require_once("../model/post.php");
    //Antes de carregar a pagina crio a verificação com as variaveis de sessão para saber se
    //o usuário tem permissão para escrever post's
    // userType values -> A= ADM; W = Writer/Escritor; P = Pattern/Padrão
    //$_SESSION["userType"] = 'A'; //Simulando um usuário Administrador

    if ($_SESSION['userType'] == 'P') {
        echo "<script type='text/javascript'>alert('User is not allowed to write new posts');window.location.href = 'blog-home.php';</script>";
    } else {
        $categ = new Category(); //instanciando obj category do model/post.php
        $_SESSION["postOp"] = 1;
    }

    ?>
    <?php include("helper/navbar.php") ?>

    <div class="container panel panel-default">
        <div class="row">
            <div class="col-md card">
                <div class="text-center">
                    <h2>CREATE POST</h2>
                    <hr style="height:2px;background-color:gray">
                </div>

                <form class="form-horizontal" method="post" action="../controller/ControllerPost.php">

                    <div class="form-group row">
                        <div class="col-sm-12">
                            <input id="focusedInput" class="form-control input-lg" type="text" name="txtTitle" placeholder="Insert Post Title" required />

                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-12">
                            <textarea id="edit-post" class="form-control" name="txtBody" required style="height: 500px;">Write your Post body here</textarea>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="control-label col-sm-1" for="category">Category:</label>
                        <div class="col-sm-2">
                            <select class="form-control" name="category" required>
                                <option>Select category</option>
                                <?php
                                foreach ($categ->listCategory() as $key => $line) { ?>
                                    <option value="<?php echo $line['idcategory'] ?>"><?php echo $line['category'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <input type="hidden" value="1" name="postOp">
                    <input type="hidden" value="<?php echo $_SESSION['idUser'] ?>" name="idUser">
                    <div class="form-group">
                        <div class="col">
                            <button class="btn btn-lg btn-success btn-block" type="submit">Finish and Save Post</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <?php include("helper/footer.php") ?>

    <script>
        tinymce.init({
            selector: '#edit-post'
        });
    </script>
</body>

</html>
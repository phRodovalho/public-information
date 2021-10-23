<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("helper/head.php");
    session_start();  ?>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
</head>

<body>
    <?php include("helper/navbar.php");?>

    <div class="container">
        <h2>Admin Post's</h2>

        <div class="panel-group" id="accordion">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Insert Post</a>
                    </h4>
                </div>
                <div id="collapse1" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <div class="btn-group">
                            <a href="blog-new-post.php" class="btn btn-primary">Go to write new post!</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Delete Post</a>
                    </h4>
                </div>
                <div id="collapse2" class="panel-collapse collapse">
                    <div class="panel-body">
                        <div class="container">
                            <form class="form-inline" action="../controller/ControllerPost.php" method="post">
                                <label>Inform <b>'IdPost'</b> to delete post:</label>
                                <input type="number" name="idPost">
                                <input type="hidden" value="3" name="postOp">
                                <input class="btn btn-danger" type="submit" value="Delete Post">
                            </form>
                            <br>
                        </div>
                        <table id="post" class="display" style="width:98%">
                            <thead>
                                <tr>
                                    <th>IdPost</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Date Hour</th>
                                    <th>Likes</th>
                                    <th>Category</th>
                                    <th>User Name</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                require_once("../model/post.php");
                                $post = new Post();

                                $posts = $post->listAllPost();

                                foreach ($posts as $key => $value) {
                                    $idpost = $value['idpost'];
                                    $title = $value['title'];
                                    $description = $value['description'];
                                    $date = $value['date'];
                                    $like = $value['likes'];
                                    $category = $value['category'];
                                    $name = $value['name'];

                                    echo "
                                            <tr>
                                                <td>$idpost</td>
                                                <td>$title</td>
                                                <td>$description</td>
                                                <td>$date</td>
                                                <td>$like</td>
                                                <td>$category</td>
                                                <td>$name</td>
                                                
                                            </tr>";
                                }
                                ?>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>IdPost</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Date Hour</th>
                                    <th>Likes</th>
                                    <th>Category</th>
                                    <th>User Name</th>
                                </tr>
                            </tfoot>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include("helper/footer.php") ?>
    <script>
        $(document).ready(function() {
            $('#post').DataTable();
        });
    </script>
</body>

</html>
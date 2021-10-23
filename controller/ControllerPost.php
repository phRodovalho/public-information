<?php
session_start();
require_once("../model/post.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (filter_input(INPUT_POST, "postOp") == 1) { //insert

        //pt-br relacionando as váriaveis input do formulário com as váriaveis do php - Post
        $title = filter_input(INPUT_POST, "txtTitle");
        $description = filter_input(INPUT_POST, "txtBody");
        $userId = $_SESSION['idUser'];
        $categoryId = filter_input(INPUT_POST, "category");

        // criando um novo obj do tipo post
        $post = new Post();
        //pt-br inserindo valores do formulário para o obj post
        $post->setTitle($title);
        $post->setDescription($description);
        $post->setUserId($userId);
        $post->setCategoryId($categoryId);
        //classe do tipo Date para formatar data e hora que serão enviados para o banco
        $data = new DateTime();
        // setando o horário de são paulo
        $data->setTimezone(new DateTimeZone('America/Sao_Paulo'));
        // formatando a data
        $dt = $data->format('Y-m-d H:i:s');

        // chamando a função insert do post que retorna true or false, passando seus devidos parametros
        if ($post->insert($post->getTitle(), $post->getDescription(), $dt, 0, $post->getUserId(), $post->getCategoryId()) == true) {
            echo "<script type='text/javascript'>alert('Post saved successfully!');window.location.href = '../view/blog-home.php';</script>";
        } else echo "<script type='text/javascript'>alert('Something went wrong, try again');window.location.href = '../view/blog-new-post.php';</script>";
    } else if (filter_input(INPUT_POST, "postOp") == 2) { //Se o postOp for igual a 2 então o usuário acabou de dar like em um post
        $idPost = filter_input(INPUT_POST, "idPost");    //pegando o id do post
        $post = new Post($idPost);                      // instânciando um obj do tipo post e passando o id do post
        echo $post->likePost();                        // se der certo então retorna a quantidade de likes, se não false

    } else if (filter_input(INPUT_POST, "postOp") == 3) {    // Se o postOp for igual a 3 então o usuário deseja deletar
        $idPost = filter_input(INPUT_POST, "idPost");       // pegando o id do post

        //para excluir um post preciso excluir os comentarios antes
        $post = new Post();             //instanciando um obj do tipo post
        $comment = new Comment();       //instanciando um obj do tipo Comentário

        if ($comment->countComment($idPost) > 0) {                //Contando comentarios na publicação que desejo excluir e verifico se tem comentários
            if ($comment->deleteComment($idPost) == true) {      // se entrou no if então tenho comentários, deleto os comentários passando o id do post
                if ($post->deletePost($idPost) == true) {       // depois de deletar os comentários então agora eu consigo excluir o post
                    echo "<script type='text/javascript'>alert('Post delete successfully!');window.location.href = '../view/blog-home.php';</script>";
                } else echo "<script type='text/javascript'>alert('Something went wrong to delete post, try again');window.location.href = '../view/blog-admin.php';</script>";
            } else echo "<script type='text/javascript'>alert('Something went wrong to delete comment and post, try again');window.location.href = '../view/blog-admin.php';</script>";
        } else { //se o post não tem comentarios então excluo normalmente passando o id
            if ($post->deletePost($idPost) == true) {
                echo "<script type='text/javascript'>alert('Post delete successfully!');window.location.href = '../view/blog-home.php';</script>";
            } else echo "<script type='text/javascript'>alert('Something went wrong to delete post, try again');window.location.href = '../view/blog-admin.php';</script>";
        }
    }
}

<?php
//metodos de envio para o banco com PDO
require_once("banco.php");



class Post  
{
    //pt-br iniciando a variavel de likes em 0
    //en-us starting the likes variable at 0
    public $likes = 0;

    //pt-br criando os atributos privados
    //en-us creating the private atributes
    private $title;
    private $description;
    private $userId;
    private $categoryId;
    private $idPost;
    private $conexao;

    public function __construct($idPost = null)
    {
        //pt-br após instanciar os atributos, crio um obj PDO para conexão com banco 
        //en-us after instantiating the attributes, I create a PDO obj for database connection
        $banco = new Banco();
        $this->conexao = $banco->getConnection();
    
        if ($idPost != null) { //pt-br se instaciar a classe com idPost set as variaveis | en-us 
            $sql = "Select * from post where idPost = $idPost";

            foreach ($this->conexao->query($sql) as $value) {
                
                //pt-br pegando os dados no formulário e seto no obj post
                //en-us 
                $this->title = $value['title'];
                $this->description = $value['description'];
                $this->userId = $value['user_idUser'];
                $this->categoryId = $value['category_idcategory'];
                $this->idPost = $value['idpost'];
                $this->likes = $value['likes'];
            }
        }
    }
    //pt-br Função que incrmenta o like
    //en-us Function that increments like
    public function likePost()
    {
        //pt-br se existir um post
        //en-us 
        if ($this->idPost != null) {

            //pt-br atualizando o valor do like
            //en-us 
            $sql = 'UPDATE post SET likes = ? WHERE idPost = ?';
            $prepare = $this->conexao->prepare($sql);

            //pt-br fazendo um like +1 e salvando no obj post
            //en-us
            $this->likes = $this->likes + 1;

            $prepare->bindParam(1, $this->likes);
            $prepare->bindParam(2, $this->idPost);

            
            //pt-br executando o sql no banco e salvando
            //
            if ($prepare->execute() == true) {
                return $this->likes; //se der certo então retorno a quantidade de likes
            } else {
                return false;
            }
        } else {
            return false;
        }
    }


    // pt-br atribuindo os valores com set

    public function setTitle($title)
    {
        $this->title = $title;
    }
    public function setDescription($description)
    {
        $this->description = $description;
    }
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }
    public function setCategoryId($categoryId)
    {
        $this->categoryId = $categoryId;
    }
    
    //pt-br pegando os dados com get
    public function getTitle()
    {
        return $this->title;
    }
    public function getCategoryId(): int
    {
        return $this->categoryId;
    }
    public function getUserId(): int
    {
        return $this->userId;
    }
    public function getPostId(): int
    {
        return $this->idPost;
    }
    public function getDescription()
    {
        return $this->description;
    }


    //pt-br criando a função de inserir 
    //en-us creating the insert function
    public function insert(string $title, string $description, string $data, int $like, int $idUser, int $idCategory): int
    {
        $sql = 'INSERT INTO post (title, description, date, likes, user_idUser, category_idcategory) VALUES (?,?,?,?,?,?)'; 
        $prepare = $this->conexao->prepare($sql);//pt-br prepara uma instrução para execução e retorna um obj de instrução | en-us prepares an instruction for execution and returns an instruction obj

        //pt-br vincula um parametro ao nome da variavel especificada
        //en-us binds a parameter to the specified variable name
        $prepare->bindParam(1, $title);
        $prepare->bindParam(2, $description);
        $prepare->bindParam(3, $data);
        $prepare->bindParam(4, $like);
        $prepare->bindParam(5, $idUser);
        $prepare->bindParam(6, $idCategory);

        if ($prepare->execute() == TRUE) {   //pt-br se executar então retorna true | en-us if run then return true
            return true;
        } else {
            return false;
        }
    }

    //pt-br criando a função listar post
    //en-us
    public function list($limit, $offset): array
    {
        //pt-br selecionando o post e ordenando de forma decrescente, utilizo o limite para controlar a quantidade de post e offset indica o inicio da leitura
        //en-us 
        $sql = "select * from post order by date desc limit $limit offset $offset ";


        $posts = [];

        foreach ($this->conexao->query($sql) as $key => $value) {
            array_push($posts, $value);
        }

        return $posts;
    }

    //pt-br criando a função que lista os posts mais curtidos
    //en-us
    public function listPopular()
    {
        $sql = "select idpost, title, likes from post order by likes desc limit 5; ";

        $posts = [];

        foreach ($this->conexao->query($sql) as $key => $value) {
            array_push($posts, $value);
        }

        return $posts;
    }

    //pt-br criando a função que lista todos os posts
    //en-us 
    public function listAllPost()
    {
        //pt-brselecionando todos os posts da tabela
        $sql = "SELECT p.idpost, p.title, p.description, p.date, p.likes, c.category, u.name FROM post p, category c, user u WHERE p.category_idcategory = c.idcategory and p.user_idUser = u.idUser";

        $posts = [];

        //pt-br conexão->query pega a lista de obj de post e passando para o arry posts
        //en-us 
        foreach ($this->conexao->query($sql) as $key => $value) { 
            array_push($posts, $value);
        }

        return $posts;
    }

    //pt-br criando a fução que lista somente um post
    public function listOnePost($idPost)
    {
        $sql = "select * from post where idpost = ? ";

        $stmt = $this->conexao->prepare($sql);
        $stmt->execute([$idPost]);
        $post = $stmt->fetch();

        return $post;
    }

    //pt-br criando a função que conta 
    //en-us 
    public function countPosts()
    {
        $sql = "SELECT COUNT(*) FROM post ";

        $prepare = $this->conexao->query($sql);
        return $prepare->fetchColumn();
    }

    //pt-br criando função update
    public function update(string $title, string $description, string $data, int $idCategory, int $idPost): int
    {
        $sql = 'UPDATE post SET title = ?, description = ?, data = ?, category_Idcategory = ?, WHERE idPost = ?';
        $prepare = $this->conexao->prepare($sql);

        //pt-br vincula um parametro ao nome da variavel especificada
        //en-us binds a parameter to the specified variable name
        $prepare->bindParam(1, $title);
        $prepare->bindParam(2, $description);
        $prepare->bindParam(3, $data);
        $prepare->bindParam(4, $idCategory);
        $prepare->bindParam(5, $idPost);

        if ($prepare->execute() == TRUE) {  //pt-br se executar então retorna true | en-us if run then return true
            return true;
        } else {
            return false;
        }
    }

    //pt-br criando a função que deleta o post 
    //en-us 
    public function deletePost(int $idPost)
    {
        //pt-br para excluir um post antes preciso excluir os comentarios
        $sql = 'delete from post where idpost = ?';

        //pt-br recebe o id, faz a conexão, prepara o sql e retorna true se der certo
        //en-us 
        $prepare = $this->conexao->prepare($sql);
        $prepare->bindParam(1, $idPost);
        if ($prepare->execute() == TRUE) {
            return true;
        } else {
            return false;
        }
    }
}

//pt-br criando a classe category 
//en-us 
class Category
{
    private $conexao;

    //pt-br o construtor instancia a conexão com o banco e retorna
    //
    public function __construct()
    {
        $banco = new Banco();
        $this->conexao = $banco->getConnection();
    }
    
    //pt-br função que lista a categoria
    //en-us 
    public function listCategory(): array
    {
        //pt-br query busca no obj category a lista de categorias  
        $sql = 'select * from category';

        $cat = [];

        //pt-br conexão->query pega a lista de obj de categoria e passando para o array cat
        //en-us 
        foreach ($this->conexao->query($sql) as $key => $value) {  
            array_push($cat, $value);
        }

        return $cat;
    }
}
//pt-br criando a classe comentário
Class Comment{

    //pt-br criando os atributos privados
    //en-us creating the private atributes
    private $conexao;
    private $description;
    private $like;
    private $date;
    private $tag;
    private $postId;
    private $userId;

    //pt-br o construtor instancia a conexão com o banco e retorna
    //en-us 
    public function __construct()
    {
        $banco = new Banco();
        $this->conexao = $banco->getConnection();
    }

    //pt-br criando o insert do comentário 
    public function insert($description, $date, $tag, $postId, $userId)
    {
        $sql = 'INSERT into comment (description, date, tag, post_idpost, user_idUser) values (?,?,?,?,?)';
        //pt-br isntancio a conexão e mando ela preparar o insert
        //en-us
        $prepare = $this->conexao->prepare($sql);

        //pt-br vincula um parametro ao nome da variavel especificada
        //en-us binds a parameter to the specified variable name
        $prepare->bindParam(1, $description);
        $prepare->bindParam(2, $date);
        $prepare->bindParam(3, $tag);
        $prepare->bindParam(4, $postId);
        $prepare->bindParam(5, $userId);

        if ($prepare->execute() == TRUE) {
            return true;
        } else {
            return false;
        }
    }

    //pt-br criando listar os comentários 
    //en-us 
    public function list($postId){
        $sql = "Select c.description, c.like, c.date, c.tag, c.post_idpost, u.name from comment c, user u where c.user_idUser = u.idUser  and c.post_idpost = $postId";
        $comment = [];

        foreach ($this->conexao->query($sql) as $value) {
            array_push($comment, $value);
        }
        return $comment;
    }

    //pt-br função que conta os comentários 
    //en-us 
    public function countComment($postId)
    {
        $sql = "SELECT COUNT(*) FROM comment where post_idpost = $postId ";

        $prepare = $this->conexao->query($sql);
        return $prepare->fetchColumn();
    }

    //pt-br função que deleta o comentário 
    public function deleteComment(int $idPost)
    {
        //pt-br para excluir um post antes preciso excluir os comentarios
        $sql = "delete from comment Where post_idpost = ?"; 
        
        $prepare = $this->conexao->prepare($sql);

        $prepare->bindParam(1, $idPost);
        
        if ($prepare->execute() == TRUE) {
            return true;
        } else {
            return false;
        }
    }
}

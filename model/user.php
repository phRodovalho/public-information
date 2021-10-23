<?php
require_once("banco.php");
class User
{
    ///pt-br criando os atributos privados
    /// en-us creating the private atributes
    private $name;
    private $email;
    private $password;
    private $user_type;
    private $birth_date;
    private $last_acess;
    private $location_idlocation;
    private $conexao;

    public function __construct()
    {
        //pt-br criando o objeto para conexão com o banco
        $banco = new Banco();
        $this->conexao = $banco->getConnection();
    }

    // pt-br atribuindo os valores com set

    public function set_name($name)
    {
        $this->name = $name;
    }

    public function set_email($email)
    {
        $this->email = $email;
    }

    public function set_password($password)
    {
        $this->password = $password;
    }

    public function set_usertype($user_type)
    {
        $this->user_type = $user_type;
    }

    public function set_birthdate($birth_date)
    {
        $this->birth_date = $birth_date;
    }

    //Função que atualiza o ultimo acesso do usuário
    public function set_lastacess($last_acess, $idUser)
    {
        //pt-br recebendo o ultimo acesso setando ele no obj usuário e atualizando com o update
        //en-us
        $this->last_acess = $last_acess;

        $sql = 'UPDATE user SET last_acess = ? WHERE idUser = ?';
        $prepare = $this->conexao->prepare($sql);

        $prepare->bindParam(1, $last_acess);
        $prepare->bindParam(2, $idUser);

        if ($prepare->execute() == TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function set_idlocation($location_idlocation)
    {
        $this->location_idlocation = $location_idlocation;
    }

    //pt-br pegando os dados com get
    public function getname()
    {
        return $this->name;
    }

    public function getemail()
    {
        return $this->email;
    }

    public function getpassword()
    {
        return $this->password;
    }

    public function getuser_type()
    {
        return $this->user_type;
    }

    public function getbirth_date()
    {
        return $this->birth_date;
    }

    public function getlast_acess()
    {
        return $this->last_acess;
    }

    public function getid_location()
    {
        return $this->location_idlocation;
    }

    //CRUD
    //Função de inserir usuário
    public function insert_user($name, $email, $password, $user_type, $birth_date, $last_acess, $location_idlocation)
    {

        $sql = 'INSERT INTO user (name , email , password , user_type , birth_date , last_acess , location_idlocation) VALUES (?,?,?,?,?,?,?)';
        $prepare = $this->conexao->prepare($sql);

        //pt-br vincula um parametro ao nome da variavel especificada
        //en-us binds a parameter to the specified variable name
        $prepare->bindParam(1, $name);
        $prepare->bindParam(2, $email);
        $prepare->bindParam(3, $password);
        $prepare->bindParam(4, $user_type);
        $prepare->bindParam(5, $birth_date);
        $prepare->bindParam(6, $last_acess);
        $prepare->bindParam(7, $location_idlocation);

        if ($prepare->execute() == TRUE) {
            return true;
        } else {
            return false;
        }
    }

    //Função usava para fazer o login
    public function select_user($email, $psw)
    {   
        //pt-br Ela verifica se o usuário e senha existem no bd
        $stmt = $this->conexao->prepare("SELECT * from user where email = ? and password = ?");
        $stmt->execute([$email, $psw]); 
        $user = $stmt->fetch();

        return $user;
    }

    public function listUsers()
    {
        //pt-br comando select do banco de dados buscando os atributos no banco
        //en-us database select command fetching the attributes in the database
        $sql = 'select * from user;';

        //pt-br declarando um array que vai ser preenchido e retornado
        //en-us declaring an array that will be filled and returned
        $user = [];

        foreach ($this->conexao->query($sql) as $value) {  //pt-br pegando a lista de obj do user e inserindo no user | en-us taking the user obj list and inserting it into the user array
            array_push($user, $value);
        }
        return $user;
    }

    public function delete($idUser){
         //para excluir um user antes preciso excluir os comentarios
         $sql = 'delete from user where idUser = ?';

         $prepare = $this->conexao->prepare($sql);
 
         $prepare->bindParam(1, $idUser);
 
         if ($prepare->execute() == TRUE) {
             return true;
         } else {
             return false;
         }
    }
}

Class Location
{
    ///pt-br criando os atributos privados
    /// en-us creating the private atributes
    private $state;
    private $country;
    private $city;
    private $adress;
    private $district;

    private $conex;

    public function __construct()
    {
        $banco = new Banco();
        $this->conex = $banco->getConnection();
    }

    // pt-br atribuindo os valores com set
    public function set_state($state)
    {
        $this->state = $state;
    }

    public function set_country($country)
    {
        $this->country = $country;
    }

    public function set_city($city)
    {
        $this->city = $city;
    }

    public function set_adress($adress)
    {
        $this->adress = $adress;
    }

    public function set_district($district)
    {
        $this->district = $district;
    }

    public function set_latitude($latitude)
    {
        $this->latitude = $latitude;
    }

    public function set_longitude($longitude)
    {
        $this->longitude = $longitude;
    }

    //pt-br pegando os dados com get

    public function getstate()
    {
        return $this->state;
    }

    public function getcountry()
    {
        return $this->country;
    }

    public function getcity()
    {
        return $this->city;
    }

    public function getadress()
    {
        return $this->adress;
    }

    public function getdistrict()
    {
        return $this->district;
    }

    public function getlatitude()
    {
        return $this->latitude;
    }

    public function getlongitude()
    {
        return $this->longitude;
    }

    //função que insere localização no banco
    public function insert_location($state, $country, $city, $adress, $district)
    {

        $sql = 'INSERT INTO location (state , country , city , adress , district) VALUES (?,?,?,?,?)';
        
        $prepare = $this->conex->prepare($sql);

        //pt-br vincula um parametro ao nome da variavel especificada
        //en-us binds a parameter to the specified variable name
        $prepare->bindParam(1, $state);
        $prepare->bindParam(2, $country);
        $prepare->bindParam(3, $city);
        $prepare->bindParam(4, $adress);
        $prepare->bindParam(5, $district);

        if ($prepare->execute() == TRUE) {

            //pt-br pega o id da linha que acabou de ser inserida e retorna
            $last_id = $this->conex->lastInsertId();
            return $last_id;
        } else {
            return false;
        }
    }
    public function deleteLoc($idLocation){
        {
            $sql = 'delete from location where idlocation = ?';
    
            $prepare = $this->conex->prepare($sql);
    
            $prepare->bindParam(1, $idLocation);
            
            if ($prepare->execute() == TRUE) {
                return true;
            } else {
                return false;
            }
        }
    }
}

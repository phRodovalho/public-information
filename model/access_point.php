<?php
require_once("banco.php");

//criando classe pontos de acesso
class Access_Point
{
    //pt-br criando os atributos privados
    //en-us creating the private atributes
    private $title;
    private $description;
    private $interAcces;
    private $idTypes;
    private $idLocation;
    private $conexao;

    public function __construct()
    {
        //pt-br criando o objeto para conexão com o banco
        //en-us creating the object to connect to the bank
        $banco = new Banco();
        $this->conexao = $banco->getConnection();
    }

    // pt-br atribuindo os valores com set
    // en-us assigning values ​​with set
    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function setInternetAcess($internA)
    {
        $this->interAcces = $internA;
    }

    public function setIdTypes($idTypes)
    {
        $this->idTypes = $idTypes;
    }

    public function setIdLocation($idLocation)
    {
        $this->idLocation = $idLocation;
    }

    //pt-br pegando os dados com get
    //en-us getting the data with get
    public function getTitle()
    {
        return  $this->title;
    }
    public function getDescription()
    {
        return  $this->description;
    }
    public function getInternetAccess()
    {
        return  $this->interAcces;
    }
    public function getIdTypes()
    {
        return  $this->idTypes;
    }
    public function getLocation()
    {
        return  $this->idLocation;
    }

    //CRUD
    //pt-br criando a função de inserir um novo ponto de acesso
    //en-us creating the function to insert a new access point
    public function insertPoint($title, $description, $interAcces, $idTypes, $idLocation)
    {
        $sql = 'INSERT INTO access_point (title, description, internet_access, types_idtypes, location_idlocation) VALUES (?, ?, ?, ?, ?)';

        $prepare = $this->conexao->prepare($sql);   //pt-br prepara uma instrução para execução e retorna um obj de instrução | en-us prepares an instruction for execution and returns an instruction obj

        //pt-br vincula um parametro ao nome da variavel especificada
        //en-us binds a parameter to the specified variable name
        $prepare->bindParam(1, $title);
        $prepare->bindParam(2, $description);
        $prepare->bindParam(3, $interAcces);
        $prepare->bindParam(4, $idTypes);
        $prepare->bindParam(5, $idLocation);

        if ($prepare->execute() == TRUE) { //pt-br se executar então retorna true | en-us if run then return true
            return true;
        } else {
            return false;
        }
    }
    //pt-br criando a função de listar os pontos de acesso 
    //en-us creating the function to list the hotspots
    public function listPoint()
    {
        //pt-br comando select do banco de dados buscando os atributos no banco
        //en-us database select command fetching the attributes in the database
        $sql = 'select a.idaccess_point,
         a.title, a.description, a.internet_access, t.type, l.idlocation, l.adress, l.district, l.city, l.state, l.country from access_point a, types t, location l where a.types_idtypes = t.idtypes and a.location_idlocation = l.idlocation;';

        //pt-br declarando um array que vai ser preenchido e retornado
        //en-us declaring an array that will be filled and returned
        $point = [];

        foreach ($this->conexao->query($sql) as $value) {  //pt-br pegando a lista de obj do ponto de acesso e inserindo no array point | en-us taking the access point's obj list and inserting it into the point array
            array_push($point, $value);
        }
        return $point;
    }

    public function delete($idPoint)
    {

        //para excluir um accessPoint antes preciso excluir os comentarios
        $sql = 'delete from access_point where idaccess_point = ?';

        $prepare = $this->conexao->prepare($sql);

        $prepare->bindParam(1, $idPoint);

        if ($prepare->execute() == TRUE) {
            return true;
        } else {
            return false;
        }
    }
}
//pt-br criando classe localização
//en-us creating location class
class Location
{
    //pt-br criando os atributos privados
    // en-us creating the private atributes
    private $state;
    private $country;
    private $city;
    private $adress;
    private $district;

    private $conex;

    public function __construct()
    {
        //pt-br criando o obj de conexão com o banco
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

    //criando a função de inserir nova loalização
    public function insert_location($state, $country, $city, $adress, $district)
    {

        $sql = 'INSERT INTO location (state , country , city , adress , district) VALUES (?,?,?,?,?)';

        $prepare = $this->conex->prepare($sql);     //prepara uma instrução para execução e retorna um obj de instrução

        //vincula um parametro ao nome da variavel especificada
        $prepare->bindParam(1, $state);
        $prepare->bindParam(2, $country);
        $prepare->bindParam(3, $city);
        $prepare->bindParam(4, $adress);
        $prepare->bindParam(5, $district);

        if ($prepare->execute() == TRUE) {
            $last_id = $this->conex->lastInsertId();    //usando a função nativa do PDO lastinsertId que retorna o id da ultima linha inserida
            return $last_id;                           // retornando ess ultimo id
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

//pt-br criando a classe tipo 
//en-us creating the type class
class Type
{

    //pt-br criando os atributos privados
    // en-us creating the private atributes
    private $conexao;
    private $typeName;

    public function __construct()
    {
        //pt-br criando o objeto para conexão com o banco
        //en-us creating the object to connect to the bank
        $banco = new Banco();
        $this->conexao = $banco->getConnection();
    }

    // pt-br atribuindo os valores com set
    // en-us assigning values ​​with set

    public function setTypeName($name)
    {

        $this->typeName = $name;
    }
    //pt-br pegando os dados com get
    //en-us getting the data with get

    public function getTypeName()
    {

        return $this->typeName;
    }

    // pt-br criando a função de listar os tipos
    // en-us en-us getting the data with get 
    public function listType()
    {
        $sql = 'select * from types;';

        $type = [];

        foreach ($this->conexao->query($sql) as $value) { //pt-br pegando os obj do tipo e inserindo no array type, retorno o type | en-us taking the type's obj and inserting it into the type array, I return the type
            array_push($type, $value);
        }
        return $type;
    }
}

<?php
require_once("banco.php");

Class Suggestion {
    
    private $conexao;
    private $description;
    private $date;
    private $userId;
    private $locationId;

    public function __construct()
    {
        //pt-br criando o objeto para conexão com o banco
        $banco = new Banco();
        $this->conexao = $banco->getConnection();
    }

    //set
    public function setDescription($descrip){
        $this->description = $descrip;
    }
    public function setDate($date){
        $this->date = $date;
    }

    public function setUserId($userId){
        $this->userId = $userId;
    }

    public function setLocationId($locId){
        $this->locationId = $locId;
    }

    //get
    public function getDescription(){
        return $this->description;
    }
    public function getDate(){
        return $this->date;
    }
    public function getUserId(){
        return $this->userId;
    }
    public function getLocationId(){
        return $this->locationId;
    }

    //Insert
    public function insert($description, $date, $userId, $locationId){
        $sql = 'INSERT INTO suggestion (description, date, user_idUser, location_idlocation) VALUES (?,?,?,?)';
        $prepare = $this->conexao->prepare($sql);

        $prepare->bindParam(1, $description);
        $prepare->bindParam(2, $date);
        $prepare->bindParam(3, $userId);
        $prepare->bindParam(4, $locationId);
       
        if ($prepare->execute() == TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function list()
    {
        //pt-br comando select do banco de dados buscando os atributos no banco
        //en-us database select command fetching the attributes in the database
        $sql = 'SELECT s.description, s.date, s.location_idlocation, u.name, l.adress, l.district, l.city, l.state, l.country
        from suggestion s, user u, location l where s.user_idUser = u.idUser and s.location_idlocation = l.idlocation';

        //pt-br declarando um array que vai ser preenchido e retornado
        //en-us declaring an array that will be filled and returned
        $sug = [];

        foreach ($this->conexao->query($sql) as $value) {  //pt-br pegando a lista de obj do suggestion e inserindo | en-us taking the suggestion obj list and inserting it into the array
            array_push($sug, $value);
        }
        return $sug;
    }


}

Class Locationn
{
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

    public function insert($state, $country, $city, $adress, $district)
    {

        $sql = 'INSERT INTO location (state , country , city , adress , district) VALUES (?,?,?,?,?)';
        
        $prepare = $this->conex->prepare($sql);

        $prepare->bindParam(1, $state);
        $prepare->bindParam(2, $country);
        $prepare->bindParam(3, $city);
        $prepare->bindParam(4, $adress);
        $prepare->bindParam(5, $district);

        if ($prepare->execute() == TRUE) {
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




?>
<?php
session_start();
require_once("../model/access_point.php");


/// pt-br Esta página controla as requisições dos pontos de acesso
///
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (filter_input(INPUT_POST, "pointOp") == 1) { // pt-br se pontop for igual a 2 então é delete e 1 é insert

        //pt-br relacionando as váriaveis input do formulário com as váriaveis do php - AcessPoint
        $title = filter_input(INPUT_POST, "txttitle");
         $internetA = filter_input(INPUT_POST, "internetA");
         $type = filter_input(INPUT_POST, "type");
         $descrip = filter_input(INPUT_POST, "descrip");
         $country = filter_input(INPUT_POST, "txtCountry");
         $state = filter_input(INPUT_POST, "txtState");
         $city = filter_input(INPUT_POST, "txtCity");
         $adress = filter_input(INPUT_POST, "txtAdress");
         $district = filter_input(INPUT_POST, "txtDistrict");

        //primeiro passo é inserir a localização pois para inserir o accessPoint é necessario o id da localização
        $location = new Location();
        // a função insert_location retorna o id da localização que foi inserida
        $idlocation = $location->insert_location($state, $country, $city, $adress, $district);

        /// crio um novo obj ponto de acesso
        $accessPoint = new Access_Point();

        //chamo a função de inserir ponto de acesso e passo os devidos parametros
        if($accessPoint->insertPoint($title, $descrip, $internetA, $type, $idlocation) == true){
            echo "<script type='text/javascript'>alert('Access Point saved successfully!');window.location.href = '../view/home.php';</script>";
        }echo "<script type='text/javascript'>alert('AccessPoint error, try again!');window.location.href = '../view/home.php';</script>";

    }else if (filter_input(INPUT_POST, "pointOp") == 2) { //falta implementar o delete
        echo $idPoint = filter_input(INPUT_POST, "idPoint");       // pegando o id do access-point
        echo $idlocation = filter_input(INPUT_POST, "idLoc");   
        
        //para excluir um accesspoint preciso excluir a localização antes
        $location = new Location();             //instanciando um obj do tipo location
        $accessPoint = new Access_Point();       //instanciando um obj do accessPoint
        
        if($accessPoint->delete($idPoint) == true){
            if($location->deleteLoc($idlocation) == true){
                echo "<script type='text/javascript'>alert('Accesspoint delete successfully!');window.location.href = '../view/home.php';</script>";
            }else echo "<script type='text/javascript'>alert('Atenccion! Delete AccessPoint but not delete Location, try again');window.location.href = '../view/home.php';</script>";
        }else echo "<script type='text/javascript'>alert('Something wrong to delete AccessPoint error, try again');window.location.href = '../view/home.php';</script>";   

    }
}
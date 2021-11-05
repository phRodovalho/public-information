<?php
session_start();
require_once("../model/suggestion.php");
use PHPUnit\Framework\TestCase;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $desc = filter_input(INPUT_POST, "suggestionDescrip");
    $userId = $_SESSION['idUser'];

    //classe do tipo Date para formatar data e hora que serão enviados para o banco
    $data = new DateTime();
    // setando o horário de são paulo
    $data->setTimezone(new DateTimeZone('America/Sao_Paulo'));
    // formatando a data
    $dt = $data->format('Y-m-d H:i:s');

    //pt-br relacionando as váriaveis input do formulário com as váriaveis do php - Location
    $country = filter_input(INPUT_POST, "txtCountry", FILTER_SANITIZE_STRING);
    $state = filter_input(INPUT_POST, "txtState", FILTER_SANITIZE_STRING);
    $city = filter_input(INPUT_POST, "txtCity", FILTER_SANITIZE_STRING);
    $adress = filter_input(INPUT_POST, "txtAdress", FILTER_SANITIZE_STRING);
    $district = filter_input(INPUT_POST, "txtDistrict", FILTER_SANITIZE_STRING);

    if ($desc != "") {
        $sug = new Suggestion();
        $loc = new Locationn();

        $loc->set_country($country);
        $loc->set_state($state);
        $loc->set_city($city);
        $loc->set_adress($adress);
        $loc->set_district($district);

        $locId = $loc->insert($loc->getstate(), $loc->getcountry(), $loc->getcity(), $loc->getadress(), $loc->getdistrict());
        if ($locId != false) {
            $sug->insert($desc, $dt, $userId, $locId);
            echo "<script type='text/javascript'>alert('Suggestion created successfully!');window.location.href = '../view/home.php';</script>";
        } else echo "<script type='text/javascript'>alert('error ');window.location.href = '../view/home.php';</script>";
    }else echo "<script type='text/javascript'>alert('error descrip empity or user not allowed');window.location.href = '../view/home.php';</script>";
}

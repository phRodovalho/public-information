<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("helper/head.php");
    session_start(); ?>
</head>

<body>
    <?php include("helper/navbar.php") ?>



    <div class="container panel panel-default">
        <div class="panel-body">
            <div class="jumbotron">
                <h2 class="display-3 text-center">About Us</h2>
                <h6 class="tagh6">
                    <br></br>
                    This website is being developed by a team composed of students from the Federal University of Uberlândia and the Middle Tennessee State University, aiming at helping to solve the UN's 11 sustainable development goals by collecting basic information about the rights of each citizen.
                </h6>

            </div>
            <!-- 
                Criando seção dos parceiros com seus respectivos tamanhos de colunas    
            !-->
            <section id="parceiros">
                <div class="container-fluid text-center margin ">
                    <h3 class="margin">DEV's</h3>
                    <div class="container ">
                        <div class="row">
                            <!--  Coluna media mg, lg grande, sm smal-->
                            <div class="col-md-6">
                                <img src="img/gess.jpg" width="50%" class="img-circle">
                                <br>
                                <p><b>Géssica Santos</b></p>
                                <div class="btn-group">
                                    <a class="btn btn-primary" href="https://github.com/GessicaS0" target="_blank">Github</a>
                                    <a class="btn btn-primary" href="https://www.linkedin.com/in/g%C3%A9ssica-santos-47b7911b3/" target="_blank">Linkedin</a>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <img src="img/ph.jpg" width="50%" class="img-circle">
                                <br>
                                <p><b>Phelipe Rodovalho</b></p>
                                <div class="btn-group">
                                    <a class="btn btn-primary" href="https://github.com/phRodovalho" target="_blank">Github</a>
                                    <a class="btn btn-primary" href="https://www.linkedin.com/in/phelipe-rodovalho-ufu/" target="_blank">Linkedin</a>
                                </div>

                            </div>

                        </div>
                        <div class="row">
                            <!--  Coluna media mg, lg grande, sm smal-->
                            <div class="col-md-6">
                                <img src="img/img_avatar.png" width="50%" class="img-circle">
                                <br>
                                <p><b>Josalyn Mandujano</b></p>
                                <div class="btn-group">
                                    <a class="btn btn-primary" href="" target="_blank">Github</a>
                                    <a class="btn btn-primary" href="" target="_blank">Linkedin</a>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <img src="img/img_avatar.png" width="50%" class="img-circle">
                                <br>
                                <p><b>Karmen Freeman</b></p>
                                <div class="btn-group">
                                    <a class="btn btn-primary" href="" target="_blank">Github</a>
                                    <a class="btn btn-primary" href="" target="_blank">Linkedin</a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!--  Coluna media mg, lg grande, sm smal-->
                            <div class="col-md-6">
                                <img src="img/img_avatar.png" width="50%" class="img-circle">
                                <br>
                                <p><b>Kasie Barber</b></p>
                                <div class="btn-group">
                                    <a class="btn btn-primary" href="" target="_blank">Github</a>
                                    <a class="btn btn-primary" href="" target="_blank">Linkedin</a>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <img src="img/img_avatar.png" width="50%" class="img-circle">
                                <br>
                                <p><b>Hayden Rumpf</b></p>
                                <div class="btn-group">
                                    <a class="btn btn-primary" href="" target="_blank">Github</a>
                                    <a class="btn btn-primary" href="" target="_blank">Linkedin</a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!--  Coluna media mg, lg grande, sm smal-->
                            <div class="col-md-6">
                                <img src="img/img_avatar.png" width="50%" class="img-circle">
                                <br>
                                <p><b>Christopher Andrews</b></p>
                                <div class="btn-group">
                                    <a class="btn btn-primary" href="" target="_blank">Github</a>
                                    <a class="btn btn-primary" href="" target="_blank">Linkedin</a>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <img src="img/img_avatar.png" width="50%" class="img-circle">
                                <br>
                                <p><b>Michael A. Erskine</b></p>
                                <div class="btn-group">
                                    <a class="btn btn-primary" href="" target="_blank">Github</a>
                                    <a class="btn btn-primary" href="" target="_blank">Linkedin</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </div>

    <?php include("helper/footer.php") ?>


</body>

</html>
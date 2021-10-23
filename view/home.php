<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("helper/head.php");
    session_start(); ?>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

</head>

<body>

    <?php include("helper/navbar.php");
    require_once("../model/access_point.php"); ?>
    <div class="container panel panel-default" style="padding: 20px;">
        <div class=" title well text-center">
            <h1>
                <span> Access Point
            </h1>
        </div>

        <div class="panel-body row p-2">

            <table id="accessPoint" class="display" style="width:98%">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Internet Acess</th>
                        <th>Type</th>
                        <th>Adress</th>
                        <th>District</th>
                        <th>City</th>
                        <th>State</th>
                        <th>Country</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $accessPoint = new Access_Point();

                    $point = $accessPoint->listPoint();

                    foreach ($point as $key => $value) {
                        $title = $value['title'];
                        $description = $value['description'];
                        $internetAcess = $value['internet_access'];
                        $type = $value['type'];
                        $adress = $value['adress'];
                        $district = $value['district'];
                        $city = $value['city'];
                        $state = $value['state'];
                        $country = $value['country'];

                        echo "
                        <tr>
                            <td>$title</td>
                            <td>$description</td>
                            <td>$internetAcess</td>
                            <td>$type</td>
                            <td>$adress</td>
                            <td>$district</td>
                            <td>$city</td>
                            <td>$state</td>
                            <td>$country</td>
                         </tr>";
                    }


                    ?>

                </tbody>
                <tfoot>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Internet Acess</th>
                        <th>Type</th>
                        <th>Adress</th>
                        <th>District</th>
                        <th>City</th>
                        <th>State</th>
                        <th>Country</th>
                    </tr>
                </tfoot>
            </table>
        </div>

        <!-- Daqui pra baixo só acessa se for ADM !-->

        <div class="panel-group hide card" id="accordionmaster">
            <div class=" title well text-center">
                <h2>
                    <span> Adm Space 
                </h2>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Insert New accessPoint</a>
                    </h4>
                </div>
                <div id="collapse1" class="panel-collapse collapse">
                    <div class="panel-body">
                        <form action="../controller/ControllerAccessPoint.php" method="post" id="form">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Title</label>
                                    <input required type="text" class="form-control" name="txttitle" placeholder="Write Title">
                                </div>

                                <div class="form-group col-md-3">
                                    <label>Internet Access</label>
                                    <select required name="internetA" class="form-control">
                                        <option>Select Internet Access </option>
                                        <option value="P">Y - Yes</option>
                                        <option value="A">N - No</option>
                                        <option value="IDK">IDK - I don't know</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Type of Access Point</label>
                                    <select class="form-control" name="type" required>
                                        <option>Select Type</option>
                                        <?php
                                        $type = new Type();
                                        foreach ($type->listType() as $key => $line) { ?>
                                            <option value="<?php echo $line['idtypes'] ?>"><?php echo $line['type'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-12">
                                    <label>Description</label>
                                    <textarea class="form-control" name="descrip" rows="3" placeholder="Write description, could be phone, user tips, landmarks"></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-row">
                                    <h3 class="text-center">INSERT ADRESS</h3>
                                    <hr>
                                    <div class="form-group col-md-4">
                                        <label>Coutry</label>
                                        <input type="text" class="form-control" name="txtCountry" placeholder="Country">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>State</label>
                                        <input type="text" class="form-control" name="txtState" placeholder="State">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>City</label>
                                        <input type="text" class="form-control" name="txtCity" placeholder="City">
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-8">
                                        <label>Adress</label>
                                        <input type="text" class="form-control" name="txtAdress" placeholder="Adress complete and number">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>District</label>
                                        <input type="text" class="form-control" name="txtDistrict" placeholder="District">
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-offset-5 ">
                                    <input type="hidden" value="1" name="pointOp">
                                    <button class="btn btn-md btn-primary" type="submit">Finish and Save Access Point</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Delete Access Point</a>
                    </h4>
                </div>
                <div id="collapse2" class="panel-collapse collapse">
                    <div class="panel-body">
                        <div class="container">
                            <form class="form-inline" action="../controller/ControllerAccessPoint.php" method="post">
                                <label>Inform <b>'IdAccessPoint and IdLocation'</b> to delete AccessPoint:</label>
                                <input type="number" name="idPoint" placeholder="Num of Id AccessPoint    ">
                                <input type="number" name="idLoc" placeholder="Num of Id Location">
                                <input type="hidden" value="2" name="pointOp">
                                <input class="btn btn-danger" type="submit" value="Delete Access Point">
                            </form>
                            <br>
                        </div>
                        <table id="accessPoint2" class="display" style="width:98%">
                            <thead>
                                <tr>
                                    <th>IdAccessPoint</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Internet Acess</th>
                                    <th>Type</th>
                                    <th>IdLocation</th>
                                    <th>Adress</th>
                                    <th>District</th>
                                    <th>City</th>
                                    <th>State</th>
                                    <th>Country</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $accessPoint = new Access_Point();

                                $point = $accessPoint->listPoint();
                                foreach ($point as $key => $value) {
                                    $idpoint = $value['idaccess_point'];
                                    $title = $value['title'];
                                    $description = $value['description'];
                                    $internetAcess = $value['internet_access'];
                                    $type = $value['type'];
                                    $idLoc = $value['idlocation'];
                                    
                                    $adress = $value['adress'];
                                    $district = $value['district'];
                                    $city = $value['city'];
                                    $state = $value['state'];
                                    $country = $value['country'];

                                    echo "
                                        <tr>
                                            <td>$idpoint</td>
                                            <td>$title</td>
                                            <td>$description</td>
                                            <td>$internetAcess</td>
                                            <td>$type</td>
                                            <td>$idLoc</td>
                                            <td>$adress</td>
                                            <td>$district</td>
                                            <td>$city</td>
                                            <td>$state</td>
                                            <td>$country</td>
                                        </tr>";
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>IdAccessPoint</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Internet Acess</th>
                                    <th>Type</th>
                                    <th>IdLocation</th>
                                    <th>Adress</th>
                                    <th>District</th>
                                    <th>City</th>
                                    <th>State</th>
                                    <th>Country</th>
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
            $('#accessPoint').DataTable();
        });
        $(document).ready(function() {
            $('#accessPoint2').DataTable();
        });

        //php retorna a variavel session se tiver algo dentro senao retorna null
        let userType = "<?php if (isset($_SESSION['userType']) == true) {
                            echo $_SESSION['userType'];
                        } else echo null;
                        ?>";

        if (userType == 'A') { //se for adm mostro op adm
            document.getElementById('accordionmaster').classList.remove('hide');
        }
    </script>
</body>

</html>
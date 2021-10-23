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
    require_once("../model/user.php");
    require_once("../model/suggestion.php"); ?>
    <div class="container card ">
        <div class="panel-group" id="accordionmaster">
            <div class=" title well text-center">
                <h3>Control User</h3>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">List Users</a>
                    </h4>
                </div>
                <div id="collapse2" class="panel-collapse collapse">
                    <div class="panel-body">
                        <table id="userList" class="display" style="width:98%">
                            <thead>
                                <tr>
                                    <th>IdUser</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Password</th>
                                    <th>UserType</th>
                                    <th>Birth date</th>
                                    <th>Last Access</th>
                                    <th>IdLocation</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $user = new User();

                                $arrayU = $user->listUsers();
                                foreach ($arrayU as $key => $value) {
                                    $idUser = $value['idUser'];
                                    $name = $value['name'];
                                    $email = $value['email'];
                                    $pass = $value['password'];
                                    $userType = $value['user_type'];
                                    $birth = $value['birth_date'];

                                    $lstA = $value['last_acess'];
                                    $idLoc = $value['location_idlocation'];
                                    echo "
                                        <tr>
                                            <td>$idUser</td>
                                            <td>$name</td>
                                            <td>$email</td>
                                            <td>$pass</td>
                                            <td>$userType</td>
                                            <td>$birth</td>
                                            <td>$lstA</td>
                                            <td>$idLoc</td>
                                        </tr>";
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>IdUser</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Password</th>
                                    <th>UserType</th>
                                    <th>Birth date</th>
                                    <th>Last Access</th>
                                    <th>IdLocation</th>
                                </tr>
                            </tfoot>
                        </table>

                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Delete User</a>
                    </h4>
                </div>
                <div id="collapse1" class="panel-collapse collapse">
                    <div class="panel-body">
                        <div class="container">
                            <form class="form-inline" action="../controller/ControllerUser.php" method="post">
                                <label>Inform <b>'IdUser'</b> to delete User:</label>
                                <input type="number" name="idUser" placeholder="IdUser">
                                <br>
                                <label>And Inform <b>'IdLocation'</b>on line user to delete:</label>
                                <input type="number" name="idLoc" placeholder="IdLocation">
                                <input type="hidden" value="3" name="userOp">
                                <input class="btn btn-danger" type="submit" value="Delete User">
                            </form>
                            <br>
                        </div>

                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">List Suggestions</a>
                    </h4>
                </div>
                <div id="collapse3" class="panel-collapse collapse">
                    <div class="panel-body">
                        <table id="suggestionList" class="display" style="width:98%">
                            <thead>
                                <tr>
                                    <th>Description</th>
                                    <th>Date</th>
                                    <th>User name</th>
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
                                $sug = new Suggestion();

                                $arrayU = $sug->list();
                                foreach ($arrayU as $key => $value) {
                                    $desc = $value['description'];
                                    $date = $value['date'];
                                    $name = $value['name'];
                                    $loc = $value['location_idlocation'];
                                    $adress = $value['adress'];
                                    $district = $value['district'];
                                    $city = $value['city'];
                                    $state = $value['state'];
                                    $country = $value['country'];
                                    echo "
                                        <tr>
                                            <td>$desc</td>
                                            <td>$date</td>
                                            <td>$name</td>
                                            <td>$loc</td>
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
                                    <th>Description</th>
                                    <th>Date</th>
                                    <th>User name</th>
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
            $('#userList').DataTable();
        });

        $(document).ready(function() {
            $('#suggestionList').DataTable();
        });
    </script>
</body>

</html>
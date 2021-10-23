<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("helper/head.php");
    session_start();
    require_once("../model/user.php"); ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <?php include("helper/navbar-login.php") ?>
    <div class="container panel panel-default" style=" margin-top: 70px;">
        <div class="panel-body">
            <div class="text-center">
                <h2>CREATE YOUR ACCOUNT</h2>
                <hr style="height:1px;background-color:gray">
            </div>
            <form action="../controller/ControllerUser.php" method="post" id="form">

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Name</label>
                        <input required type="text" class="form-control" name="txtname" placeholder="First and Last name">
                    </div>
                    <div class="form-group col-md-3">
                        <label>Birth Date</label>
                        <input required type="date" class="form-control" name="txtdate">
                    </div>
                    <div class="form-group col-md-3">
                        <label>User Type</label>
                        <select required name="userType" class="form-control">
                            <option value="P">Pattern User</option>
                            <option value="A">Administrator</option>
                            <option value="W">Blog Writer</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Email</label>
                        <input required type="email" class="form-control" name="email" id="inputEmail" placeholder="name@example.com">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Confirm your Email</label>
                        <input required type="email" class="form-control" name="emailC" id="inputEmailC" placeholder="name@example.com">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Password</label>
                        <input required type="password" class="form-control" name="password" id="inputPassword">
                        <small id="passwordHelpInline" class="text-muted">
                            Must be 8-20 characters.
                        </small>
                    </div>
                    <div class="form-group col-md-6">
                        <label> Confirm your Password</label>
                        <input required type="password" class="form-control" name="passwordC" id="inputPasswordC">
                        <small id="passwordHelpInline" class="text-muted">
                            Must be 8-20 characters.
                        </small>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-row">
                        <h3 class="text-center">INSERT YOUR ADRESS</h3>
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
                        <input type="hidden" value="1" name="userOp">
                        <button class="btn btn-md btn-primary" type="submit">Create account</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php include("helper/footer.php") ?>
    <!--<script src="js/validateEmail-Password.js"></script>
    <script type="text/javascript">
        $(function(){
            $("#submit").click(function(event){
                event.preventDefault();
                if(validatePassword() == true && validateEmail() == true){
                    $("form").submit();
                }
            });
        });
        function validatePassword() {
            let pass = document.getElementById("InputPassword").value;
            let passC = document.getElementById("InputPasswordC").value;
            if ( pass == passC) {
                input.setCustomValidity('');
                return true;
            } else {
                input.setCustomValidity('Password are not the sam, please try again!');
                return false;
                
            }
        }
        function validateEmail() {
            if (document.getElementById("InputEmailC").value == document.getElementById("InputEmail").value) {
                input.setCustomValidity('');
                return true;
            } else {
                input.setCustomValidity('Emails are not the sam, please try again!');
                return false;
                
            }
        }
    </script>!-->
</body>

</html>
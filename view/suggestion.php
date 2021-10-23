<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("helper/head.php");
    session_start(); ?>
</head>


<body>
    <?php include("helper/navbar.php");
    
    if(!isset($_SESSION['idUser'])){
        echo '  <div class="container">
          <div class="panel panel-default text center">
              <div class="panel-body">
              <h3>To send Suggestions you need to login or create an account</h3>
              <a href="login.php" class="text-center btn btn-md btn-primary">Sign in or Create an account </a>
              </div>
              </div>
          </div>';
          exit();
      }
      ?>

    <div class="container panel panel-default" style="color: black;">
        <div class=" title well text-center">
            <h1>
                <span> Suggestion
            </h1>
        </div>
        <form method="post" action="../controller/ControllerSuggestion.php">

            <div class="form-group">
                <div class="form-row">
                    <label>Suggestion</label>
                    <textarea class="form-control" name="suggestionDescrip" rows="3" placeholder="Text here your sugestion"></textarea>
                    <!--
                pt-br: habilitando o campo de sugestão
                en : enabling the sugestion field
                !-->
                </div>
            </div>
            <div class="form-group">
                <div class="form-row">
                    <hr>
                    <h4>IF NEED, INSERT ADRESS</h4>
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
                    <button class="btn btn-md btn-primary" type="submit">Send Suggestion</button>
                </div>
            </div>
        </form>
    </div>
    <?php include("helper/footer.php") ?>
</body>

</html>
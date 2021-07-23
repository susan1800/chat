<?php require_once "database/process.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Let's Chat</title>
    <!--Bootsrap 4 CDN-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <!--Fontawesome CDN-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    <!--Custom styles-->
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="js/checkpass.js"></script>
</head>
<body>
    <div class="container">
        <?php
if(count($errors)==1){
    ?>
    <div class="alert alert-danger text-center">
        <?php
        foreach($errors as $showerror){
            echo $showerror;
        }
        ?>
    </div>
    <?php
} elseif(count($errors)>1){
    ?>
    <div class="alert alert-danger">
        <?php
        foreach($errors as $showerror){
            ?>
            <li><?php echo $showerror;?></li>
            <?php
        }
        ?>
    </div>
    <?php
}
?>
        <div class="row">
            <div class="col-md-4 offset-md-4 form">
                <form action="signup-user.php" method="POST" autocomplete="">
                    <h2 class="text-center">Signup Now</h2><br>
                    
                    
                     <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" class="form-control" placeholder="User Name" maxlength="75" name="name" required value="<?php echo $name ?>" >
                        
                    </div>

                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                        </div>
                        <input type="date" name="dob" maxlength="12" class="form-control"  required> 
                    </div>

                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-mars"></i></span>
                        </div>
                        <input type="radio" name="sex"  class="form-control" style="height: 20px; margin-top: 5px; " checked="" value="M"  ><h5>Male</h5>
                        <input type="radio" name="sex"  class="form-control" style="height: 20px; margin-top: 5px; " value="F"><h5 >Female</h5>
                        <input type="radio" name="sex"  class="form-control" style="height: 20px; margin-top: 5px; "  value="O"><h5>Others</h5>

                    </div>

                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        </div>
                        <input type="email" name="email" maxlength="75" class="form-control" placeholder="Email" required value="<?php echo $email ?>"> 
                    </div>
                    <i><div id="msg" style="color: red; font-size: 0.8em; width: 100%; text-align: center;"></div></i>
                   <div class="input-group form-group">

                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                        </div>
                        <input type="password" class="form-control" placeholder="Password" id="pass" name="password" required onkeyup="return checkpass()" ></i>
                        
                        
                    </div>

                    <div class="form-group">
                        <input class="form-control button" type="submit" name="signup" value="Signup" onclick="return checksubmit()">
                    </div>
                    <div class="link login-link text-center">Already a member? <a href="index.php">Login Now</a></div>
                </form>
            </div>
        </div>
    </div>
 
</body>
</html>
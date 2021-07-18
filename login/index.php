<?php require_once "database/process.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Let's Chat</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <!--Fontawesome CDN-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    <!--Custom styles-->
    <link rel="stylesheet" type="text/css" href="css/style.css">
  
</head>
<body onload="server()">
    <div id="autodata"></div>
    <div class="container">
         <div class="col-md-4 offset-md-4 from login-form">
                  <?php
                    if(count($errors) > 0){
                        ?>
                        <div class="alert alert-danger text-">
                            <?php
                            foreach($errors as $showerror){
                                echo $showerror;
                                echo "$registerresult";
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>
        </div>
        <div class="row">  
            <div class="col-md-4 offset-md-4 form login-form">
                 
                <form action="index.php" method="POST" autocomplete="">
                    <h2 class="text-center">Login Now</h2><br>
                    
                  
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        </div>
                        <input type="email" name="email" maxlength="75" class="form-control" placeholder="Email" required value="<?php echo $email ?>"> 
                    </div>

                   <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                        </div>
                        <input type="password" class="form-control" placeholder="Password" name="password" required></i> 
                        
                    </div>

                    <div class="link forget-pass text-left"><a href="forgot-password.php">Forgot password?</a></div>
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="login" value="Login">
                    </div>
                    <div class="link login-link text-center">Not yet a member? <a href="signup-user.php">Create  New Account</a></div>
                </form>
            </div>
        </div>
    </div>
    <div id="chat"></div>
    
</body>
</html>
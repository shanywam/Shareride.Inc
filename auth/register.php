<?php
        include_once '../backend/auth.php';
        $user = new User(); // Checking for user logged in or not


        //var_dump(isset($_REQUEST['submit']));
        if (isset($_REQUEST['submit']))
        {
            extract($_REQUEST);
                /*$firstname ='';
                $lastname ='';
                $email='';
                $password='';
                $corfirm_password ='';*/

                $register = $user->reg_user($firstname, $lastname, $email, $password, $confirm_password);
                //var_dump($register);
            if ($register)
                {

                    // Registration Success
                    echo 'Registration successful <a href="login.php">Click here</a> to login';
                } else
                    {

                        // Registration Failed
                        echo 'Registration failed. Email or Username already exits please try again';
                    }

        }
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href ="../css/bootstrap.min.css"/>
    <script src="../https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="../https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src ="../js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <title>Shareride.Inc &#8211; Kenya&#039;s Taxi App &#8211; Based in Nairobi</title>

    <link rel="stylesheet" href="../style/main.css">

</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Shareride.Inc</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div id="main-header-nav" class="collapse navbar-collapse">
        <ul id="menu-main-nav" class="nav navbar-nav main-nav underlined weight-light">
            <li class="nav-item active">
                <a class="nav-link" href="../index.php"><i style ="color:darkgrey ;"class="fa fa-home"></i> Home <span class="sr-only">(current)</span></a>
            </li>
            <li class=" nav-item active">
                <a class="nav-link" href="../auth/register.php"><i style ="color:darkgrey;"class="fa fa-"></i> Register <span class="sr-only">(current)</span> </a>
            </li>
            <li class=" nav-item active">
                <a class="nav-link" href="../auth/login.php"><i style ="color:darkgrey;"class="fa fa-"></i> Login <span class="sr-only">(current)</span> </a>
            </li>
        </ul>

    </div>

    <div id="ra_header_container_5ca64c7c3a2e8" class="modules-container ra_header_container_5ca64c7c3a2e8  vc_custom_1528890373974"></div>
    <script type="text/javascript">(function($) {$("head").append("<style>.rella-row-shadowbox-5ca64c7c34b20{-webkit-box-shadow:;-moz-box-shadow:;box-shadow:;}</style>");})(jQuery);</script>
</nav>



<div class="container">
    <div class="wrapper">
        <h2 class="text-center">welcome to Shareride.Inc</h2>
        <p class="text-center">Please fill this form to create an account.</p>
        <p class="text-center help-block" style="color: red;"></p>
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />

        <style>
            #container{width:400px; margin: 0 auto;}
        </style>
        <script type="text/javascript" language="javascript">
            function submitreg()
            {
                var form = document.reg;
                if(form.fname.value == ""){
                    alert( "Enter name." );
                    return false;
                }
                else if(form.lname.value == ""){
                        alert( "Enter username." );
                        return false;
                    }
                else if(form.email.value == ""){
                        alert( "Enter email." );
                        return false;
                    }
                else if(form.pass.value == ""){
                    alert( "Enter password." );
                    return false;
                }
                else if(form.confirm_pass.value == ""){
                    alert( "Enter password." );
                    return false;
                }
            }
        </script>
        <div id="container">
            <h3 class="text-center">Register Here</h3>
            <form action="" method="post" name="reg">
                <table>
                    <tbody>
                    <tr>
                        <th>firstname:</th>
                        <td><input type="text" name="firstname" required="" /></td>
                    </tr>
                    <tr>
                        <th>lastname:</th>
                        <td><input type="text" name="lastname" required="" /></td>
                    </tr>
                    <tr>
                        <th>email:</th>
                        <td><input type="text" name="email" required="" /></td>
                    </tr>
                    <tr>
                        <th>password:</th>
                        <td><input type="password" name="password" required="" /></td>
                    </tr>
                    <tr>
                        <th>confirm_password:</th>
                        <td><input type="password" name="confirm_password" required="" /></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input onclick="return(submitreg());" type="submit" name="submit" value="Register" /></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><a href="login.php">Already registered! Click Here!</a></td>
                    </tr>
                    </tbody>
                </table>
            </form></div>
    </div>
</div>
</body>
</html>



<?php 
  include('admin/includes/config.php');
  include('admin/includes/usersModel.php');
  include('admin/includes/validate.php');
  $u = new usuarios();

  if (isset($_POST['SubmitLogin']))
  {
    $u->login();
  }elseif (isset($_POST['grabar']) && $_POST['grabar'] == 'si') {
    $u->add_user();
    exit();
	}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign in & Sign up Form</title>
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <main>
        <div class="box">
            <div class="inner-box">
                <div class="forms-wrap">
                    <form action="" method="post" autocomplete="off" class="sign-in-form">
                        <div class="logo">
                            <img src="./img/logo.png" alt="easyclass" />
                            <h4>MAGphotos</h4>
                        </div>

                        <div class="heading">
                            <h2>Welcome Back</h2>
                            <h6>Not registred yet?</h6>
                            <a href="#" class="toggle">Sign up</a>
                        </div>

                        <div class="actual-form">
                            <div class="input-wrap">
                                <input type="text" minlength="4" class="input-field" name="login" autocomplete="off" required />
                                <label>Name</label>
                            </div>

                            <div class="input-wrap">
                                <input type="password" minlength="4"  name="pass" class="input-field" autocomplete="off" required />
                                <label>Password</label>
                            </div>

                            <input type="submit"  name="SubmitLogin" value="Sign In" class="sign-btn" />

                            <p class="text">
                                Forgotten your password or you login datails?
                                <a href="#">Get help</a> signing in
                            </p>
                        </div>
                    </form>

                    <form   method="post" autocomplete="off" class="sign-up-form">
                        <div class="logo">
                            <img src="./img/logo.png" alt="easyclass" />
                            <h4>MAGphotos</h4>
                        </div>

                        <div class="heading">
                            <h2>Get Started</h2>
                            <h6>Already have an account?</h6>
                            <a href="#" class="toggle">Sign in</a>
                        </div>

                        <div class="actual-form">
                            <div class="input-wrap">
                                <input type="text" minlength="4" name="person_name" class="input-field" autocomplete="off" required />
                                <label>Name</label>
                            </div>

                            <div class="input-wrap">
                                <input type="email" class="input-field" name="person_email" autocomplete="off" required />
                                <label>Email</label>
                            </div>

                            <div class="input-wrap">
                                <input type="password" minlength="4" name="pass1" class="input-field" autocomplete="off" required />
                                <label>Password</label>
                            </div>

                            <input type="submit" value="Sign Up" class="sign-btn" />
                            <input type="hidden" name="grabar" value="si" />
                            <input type="hidden" name="person_phone" value="0" />
                            <input type="hidden" name="person_social" value="0" />
                            <input type="hidden" name="person_company" value="0" />
                            <input type="hidden" name="person_position" value="0" />
                            <input type="hidden" name="person_type" value="6" />
                            <input type="hidden" name="person_check" value="1" />
                            <input type="hidden" name="person_history" value="" />

                            <p class="text">
                                By signing up, I agree to the
                                <a href="#">Terms of Services</a> and
                                <a href="#">Privacy Policy</a>
                            </p>
                        </div>
                    </form>
                </div>

                <div class="carousel">
                    <div class="images-wrapper">
                        <img src="home/images/0001.jpg" class="image img-1 show"  style="width: 100%;" alt="" />
                        <img src="home/images/0002.jpg" class="image img-2 " style="width: 100%;" alt="" />
                        <img src="home/images/0003.jpg" class="image img-3" style="width: 100%;" alt="" />
                    </div>

                    <div class="text-slider">
                        <div class="text-wrap">
                            <div class="text-group" style="position: absolute; left: 100px; top: 400px; z-index: 1; color:#ffffff !important;">
                                <h2>Look Your Photos</h2>
                                <h2>Select the ones you want</h2>
                                <h2>Invite your friends to meet us</h2>
                            </div>
                        </div>

                        <div class="bullets" style="position: absolute; left: 250px; top: 550px; z-index: 1;">
                            <span  data-value="1"></span>
                            <span class="active" data-value="2"></span>
                            <span data-value="3"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Javascript file -->

    <script src="app.js"></script>
</body>

</html>
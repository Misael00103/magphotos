<?php 
  include('../admin/includes/config.php');
  include('../admin/includes/usersModel.php');
  include('../admin/includes/validate.php');
  validate_user2();
?>
<!DOCTYPE HTML>
<html lang="en">

</html>
<html>

<head>
    <title>MAGphotos</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
</head>

<body class="is-preload">

    <!-- Header -->
    <header id="header">
        <h1>MAG<span>Photos</span></h1>
        <nav>
            <ul>
                <li><a href="#intro">Home</a></li>
                <li><a href="#one">What I Do</a></li>
                <li><a href="#two">About us</a></li>
                <li><a href="#work">Our work</a></li>
                <li><a href="portafolio/">Briefcase</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
        </nav>
    </header>

    <!-- Intro -->
    <section id="intro" class="main style1 dark fullscreen" style="background:linear-gradient(rgba(23, 22, 23, 0.2), rgba(23, 22, 23, 0.5)), url(images/0001.jpg) no-repeat;background-size:100%; ">
        <div class="content"  >
            <header>
                <h2>Hey.</h2>
            </header>
            <p>Welcome to <strong>MAGphotos</strong>
                <a href="#"></a><br />
                <a href="#"></a>
            </p>
            <footer>
                <a href="#one" class="button style2 down">More</a>
            </footer>
        </div>
    </section>

    <!-- One -->
    <section id="one" class="main style2 right dark fullscreen" style="background:linear-gradient(rgba(23, 22, 23, 0.2), rgba(23, 22, 23, 0.5)), url(images/0002.jpg) no-repeat;background-size:100%; ">
        <div class="content box style2">
            <header>
                <h2>What I Do</h2>
            </header>
            <p>We are a photography company that offers the best services at the best market price</p>
        </div>
        <a href="#two" class="button style2 down anchored">Next</a>
    </section>

    <!-- Two -->
    <section id="two" class="main style2 left dark fullscreen" style="background:linear-gradient(rgba(23, 22, 23, 0.2), rgba(23, 22, 23, 0.5)), url(images/0003.jpg) no-repeat;background-size:100%; ">
        <div class="content box style2">
            <header>
                <h2>Who I Am</h2>
            </header>
            <p>MagPhotos is the photo agency with the most modern technologies, we take care of making your dreams come true</p>
        </div>
        <a href="#work" class="button style2 down anchored">Next</a>
    </section>

    <!-- Work -->
    <section id="work" class="main style3 primary">
        <div class="content">
            <header>
                <h2>My Work</h2>
                <p>Our job is to offer the best quality photos in the most dynamic way, your imagination is the limit</p>
            </header>

            <!-- Gallery  -->
            <div class="gallery">
                <article class="from-left">
                    <a href="images/fulls/01.jpg" class="image fit"><img src="images/thumbs/01.jpg" title="Special Content" alt="" /></a>
                </article>
                <article class="from-right">
                    <a href="images/fulls/02.jpg" class="image fit"><img src="images/thumbs/02.jpg" title="Special Content II" alt="" /></a>
                </article>
                <article class="from-left">
                    <a href="images/fulls/03.jpg" class="image fit"><img src="images/thumbs/03.jpg" title="Air Lounge" alt="" /></a>
                </article>
                <article class="from-right">
                    <a href="images/fulls/04.jpg" class="image fit"><img src="images/thumbs/04.jpg" title="Carry on" alt="" /></a>
                </article>
                <article class="from-left">
                    <a href="images/fulls/05.jpg" class="image fit"><img src="images/thumbs/05.jpg" title="The sparkling shell" alt="" /></a>
                </article>
                <article class="from-right">
                    <a href="images/fulls/06.jpg" class="image fit"><img src="images/thumbs/06.jpg" title="Bent IX" alt="" /></a>
                </article>
            </div>

        </div>
    </section>

    <!-- Contact -->
    <section id="contact" class="main style3 secondary">
        <div class="content">
            <header>
                <h2>Say Hello.</h2>
                <p>In this section you will contact us directly through the message box</p>
            </header>
            <div class="box">
                <form method="post" action="#">
                    <div class="fields">
                        <div class="field half"><input type="text" name="name" placeholder="Name" /></div>
                        <div class="field half"><input type="email" name="email" placeholder="Email" /></div>
                        <div class="field"><textarea name="message" placeholder="Message" rows="6"></textarea></div>
                    </div>
                    <ul class="actions special">
                        <li><input type="submit" value="Send Message" /></li>
                    </ul>
                </form>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer id="footer">

        <!-- Icons -->
        <ul class="icons">
            <li><a href="#" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
            <li><a href="#" class="icon brands fa-facebook-f"><span class="label">Facebook</span></a></li>
            <li><a href="#" class="icon brands fa-instagram"><span class="label">Instagram</span></a></li>
            <li><a href="#" class="icon brands fa-pinterest"><span class="label">Pinterest</span></a></li>
        </ul>

        <!-- Menu -->
        <ul class="menu">
            <li>&copy; MAGphotos</li>
            <li>Design: <a href="https://misaelportafolio.netlify.app/">MisaelDeveloper</a></li>
        </ul>

    </footer>

    <!-- Scripts -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/jquery.poptrox.min.js"></script>
    <script src="assets/js/jquery.scrolly.min.js"></script>
    <script src="assets/js/jquery.scrollex.min.js"></script>
    <script src="assets/js/browser.min.js"></script>
    <script src="assets/js/breakpoints.min.js"></script>
    <script src="assets/js/util.js"></script>
    <script src="assets/js/main.js"></script>

</body>

</html>
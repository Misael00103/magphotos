<header class="main-header">

        <!-- Logo -->

        <a href="?module=home" class="logo">		

		<img style="height:35px;" src="../images/logo_txtw.png" class="center" alt="Sistema Kolormedia"/></a>

</a>

        <!-- Header Navbar: style can be found in header.less -->

        <nav class="navbar navbar-static-top" role="navigation">

          <!-- Sidebar toggle button-->

          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">

            <span class="sr-only">Toggle navigation</span>

          </a>



          <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">

		

<li class="dropdown user user-menu">

  <a href="#" class="dropdown-toggle" data-toggle="dropdown">

  <!-- User image -->



    <img src="images/admin.png" class="user-image" alt="User Image"/>



    <span class="hidden-xs"><?php echo $_SESSION['usuario']; ?> <i style="margin-left:5px" class="fa fa-angle-down"></i></span>

  </a>

  <ul class="dropdown-menu">

    <!-- User image -->

    <li class="user-header">



      <img src="images/admin.png" class="img-circle" alt="User Image"/>



      <p>

        <?php echo $_SESSION['usuario']; ?>

      </p>

    </li>

    <!-- Menu Footer-->

    <li class="user-footer">

      <div class="pull-left">

        <a href="pass.php" class="btn btn-default btn-flat">Password</a>

      </div>



      <div class="pull-right">

        <a style="width:80px" href="logout.php" class="btn btn-default btn-flat">Log-out</a>

      </div>

    </li>

  </ul>

</li>

</ul>

          </div>

        </nav>

      </header>

	  

	  <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->

        <section class="sidebar">

          <!-- sidebar menu: : style can be found in sidebar.less -->

            

            <!-- Llamar el archivo "sidebar-menu.php" para visualizar el menú  -->

            <?php include "menu.php" ?>



        </section>

        <!-- /.sidebar -->

      </aside>
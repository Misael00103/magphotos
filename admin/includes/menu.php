
<nav id="barnav">
    <ul class="sidebar-menu">
	        <li class="header">MENU</li>

        <!-- Menu para partner-->
        <?php if($_SESSION["level"]!=8 && $_SESSION["level"]!=10 && $_SESSION["level"]>0){?>
     


		<li><a href='_home.php' title="Home">
            <i class="fa fa-cubes"></i>
Products

        </a></li>



		<?php if($_SESSION["level"]!=9){?>


            <li><a href="_gestion.php" title="Management">
           				<i class="fa fa-desktop"></i> Management

            </a></li>

 			<?php }
		 	}elseif($_SESSION["level"]==8){?>

			<li>
			<a href="paidup.php" title="PaidUp">
				<i class="fa fa-home"></i> PaidUp

​
			</a>
        </li>

		<?php }elseif($_SESSION["level"]==10){?>

        <li>
		 <a href="_sponsors.php" title="Sponsors">
          <i class="fa fa-home"></i> Sponsors

                 </a>
        </li>
        <?php }?>
            <li><a href="support.php" title="Technical help">
                          <i class="fa fa-exclamation-circle"></i> Tech support

            </a></li>


            <li><a href="logout.php?logout" title="Sign off">
                                       <i class="fa fa-power-off"></i> Log-out

            </a></li>

    </ul>
</nav>

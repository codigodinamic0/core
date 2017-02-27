        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                 <a class="navbar-brand" href="<?php echo $matriz_url ?>" target="_blank"><img src="img/logo-head.png" alt=""></a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="id-profile" >
                    <span><i><?php $valor=variable(20,2); echo $valor[0]; ?>, <?php echo $_SESSION['nombre_usuario'] ?></i></span> <img src="img/img-profile.png" alt="">
                </li> 
                <li class="id-profile" >
                    <div id="profile-links">
                        <a href="close.php"  title="SALIR"><span class="salir"></span></a>
                    </div>
                </li> 
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens 
            <div class="collapse navbar-collapse navbar-ex1-collapse">

                <ul class="nav navbar-nav side-nav">
                    <div class="form-group input-group">
                        <input type="text" class="form-control" placeholder="Buscar...">
                        <span class="input-group-btn"><button class="btn" type="button"><i class="fa fa-search"></i></button></span>
                    </div>
                    <li>
                        <a class="active" href="index.html"><i class="icon ini"></i> <span>Inicio</span></a>
                    </li>
                    <li>
                        <a href=""><i class="icon ent"></i><span> Entradas</span></a>
                    </li>
                    <li>
                        <a href=""><i class="icon med"></i><span> Media</span></a>
                    </li>
                    <li>
                        <a href=""><i class="icon pref"></i> <span>Preferencias</span></a>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="icon ajus"></i> <span>Ajustes</span> <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo" class="collapse">
                            <li>
                                <a href="#"> Item</a>
                            </li>
                            <li>
                                <a href="#"> Item</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            /.navbar-collapse -->
        </nav>
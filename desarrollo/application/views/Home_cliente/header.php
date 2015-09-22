    <!--header start-->
    <header class="header-frontend">
        <div class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="fa fa-bars"></span>
                    </button>
                    <a class="navbar-brand" href="index.html">Flat<span>Lab</span></a>
                </div>
                <div class="navbar-collapse collapse ">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="index.html">Inicio</a></li>
                        <li><a href="contact.html">Contacto</a></li>
                        <li class="dropdown language">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                <img alt="" src="<?= base_url();?>clienteStilo/img/flags/us.png">
                                <span class="username">US</span>
                                <b class=" fa fa-angle-down"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="#"><img alt="" src="<?= base_url();?>clienteStilo/img/flags/es.png"> Spanish</a></li>
                                <li><a href="#"><img alt="" src="<?= base_url();?>clienteStilo/img/flags/de.png"> German</a></li>
                                <li><a href="#"><img alt="" src="<?= base_url();?>clienteStilo/img/flags/ru.png"> Russian</a></li>
                                <li><a href="#"><img alt="" src="<?= base_url();?>clienteStilo/img/flags/fr.png"> French</a></li>
                            </ul>
                        </li>
                        <li><input type="text" placeholder=" Search" class="form-control search"></li>
                    </ul>
                </div>
            </div>
        </div>
    </header>
    <!--header end-->
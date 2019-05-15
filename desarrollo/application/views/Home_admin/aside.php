     <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <!-- search form -->
<!--           <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form> -->
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">Navegacion</li>
             <li id="caja" class="treeview">
              <a href="#" data-toggle="tab" >
                <i class="fa fa-dropbox"></i> <span>Caja</span>  
                <small class="label pull-right bg-red"></small>
              </a>
            </li>
             <li class="" id="verificar_caja">
               <a href="#" >
                 <i class="fa fa-credit-card"></i>
                <span>Pagos   Cobros</span>
                <span class="fa fa-angle-left pull-right"></span>
              </a>
              <ul class="treeview-menu acor_pa" id="">
                 <li id="Pagos" class="" data-tabs="tabs">
                    <a href="#" data-toggle="tab" >
                    <i class="fa fa-circle-o"></i> Pagos</a>
                </li>
               <li id="Cobros" class="" data-tabs="tabs">
                    <a href="#" data-toggle="tab" >
                    <i class="fa fa-circle-o"></i> Cobros Cuotas</a>
                </li>
              </ul>
            </li>
            <li id="presupuesto" class="treeview" data-tabs="tabs">
              <a href="#" data-toggle="tab" >
                <i class="fa fa-calculator"></i> <span>Presupuesto Alquiler</span>  
                <small class="label pull-right bg-red"></small>
              </a>
            </li>

             <li id="agenda" class="treeview" data-tabs="tabs">
              <a href="#" data-toggle="tab" >
                <i class="fa fa-calendar"></i><span>Mi Agenda Evento</span>  
                <small class="label pull-right bg-red"></small>
              </a>
            </li>
            <li id="servicios" class="treeview" data-tabs="tabs">
              <a href="#" data-toggle="tab" >
                <i class="fa fa-wrench"></i> <span>Servicios</span>  
                <small class="label pull-right bg-red"></small>
              </a>
            </li>

            <li id="cliente" class="treeview" data-tabs="tabs">
              <a href="#" data-toggle="tab" >
                <i class="fa fa-users"></i> <span>Clientes</span>  
                <small class="label pull-right bg-red">{num_cliente}</small>
              </a>
            </li>
            <li id="empleado" class="treeview" data-tabs="tabs">
              <a href="#" data-toggle="tab" >
               <i class="fa fa-user-secret"></i> <span>Empleados</span>  
                <small class="label pull-right bg-red">{num_empleado}</small>
              </a>
            </li>
            <li id="productos" class="treeview" data-tabs="tabs">
              <a href="#" data-toggle="tab" >
               <i class="fa fa-cart-arrow-down"></i> <span>Articulos</span>  
                <small class="label pull-right bg-red">{num_productos}</small>
              </a>
            </li>

             <li id="refrescar" class="">
              <a href="#">
               <i class="fa fa-indent"></i>
                <span>Reportes</span>
                <span class="fa fa-angle-left pull-right"></span>
              </a>
              <ul class="treeview-menu acor">
                <li id="r8"><a href="#" ><i class="fa fa-circle-o"></i> Caja</a></li>
                <li id="Alquiler_Presupuesto"><a href="#"><i class="fa fa-circle-o"></i>Alquiler / Presupuesto</a></li>
                <li id="r2"><a href="#"><i class="fa fa-circle-o"></i>Pagos y Cobros</a></li>
                <li id="r3"><a href="#"><i class="fa fa-circle-o"></i>Servicios</a></li>
                <li id="r4"><a href="#"><i class="fa fa-circle-o"></i>Clientes</a></li>
                <li id="r5"><a href="#"><i class="fa fa-circle-o"></i>Empleados</a></li>
                <li id="r6"><a href="#"><i class="fa fa-circle-o"></i>Articulos</a></li>
                <li id="r7"><a href="#"><i class="fa fa-circle-o"></i>Stock</a></li>
              </ul>
            </li>

             <li id="administsdad" class="">
              <a href="#" >
                <i class="fa fa-cogs"></i>
                <span>Administrar</span>
                <span class="fa fa-angle-left pull-right"></span>
              </a>
              <ul class="treeview-menu admi">
                <li id="Stock"><a href="#" ><i class="fa fa-circle-o"></i> Stock</a></li>
                <li id="empresa"><a href="#"><i class="fa fa-circle-o"></i> Empresa</a></li>
                <li><a href="#"><i class="fa fa-circle-o"></i>Usuario</a></li>
                <li><a href="#"><i class="fa fa-circle-o"></i>Categoria</a></li>
              </ul>
            </li>

<!--             <li class="treeview">
              <a href="#">
                <i class="fa fa-laptop"></i>
                <span>UI Elements</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href=""><i class="fa fa-circle-o"></i> General</a></li>
                <li><a href=""><i class="fa fa-circle-o"></i> Icons</a></li>
                <li><a href=""><i class="fa fa-circle-o"></i> Buttons</a></li>
                <li><a href=""><i class="fa fa-circle-o"></i> Sliders</a></li>
                <li><a href=""><i class="fa fa-circle-o"></i> Timeline</a></li>
                <li><a href=""><i class="fa fa-circle-o"></i> Modals</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-edit"></i> <span>Forms</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href=""><i class="fa fa-circle-o"></i> General Elements</a></li>
                <li><a href=""><i class="fa fa-circle-o"></i> Advanced Elements</a></li>
                <li><a href=""><i class="fa fa-circle-o"></i> Editors</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-table"></i> <span>Tables</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href=""><i class="fa fa-circle-o"></i> Simple tables</a></li>
                <li><a href=""><i class="fa fa-circle-o"></i> Data tables</a></li>
              </ul>
            </li>
            <li>
              <a href="">
                <i class="fa fa-calendar"></i> <span>Calendar</span>
                <small class="label pull-right bg-red">3</small>
              </a>
            </li>
            <li>
              <a href="">
                <i class="fa fa-envelope"></i> <span>Mailbox</span>
                <small class="label pull-right bg-yellow">12</small>
              </a>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-folder"></i> <span>Examples</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-share"></i> <span>Multilevel</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>

            </li>
            <li class="header">LABELS</li>
            <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
            <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
            <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>
          </ul> -->
        </section>
        <!-- /.sidebar -->
      </aside>

<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
 <a class="navbar-brand ps-3" href="admin"><img src="../assets/img/logo.png" width="60px" alt="">E.B.N</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="hidden" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />

                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><b style="text-transform: uppercase"><?= htmlspecialchars($_SESSION['username']) ?></b><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="perfil.php">Perfil</a></li>
                  
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="../php/logout.php">Cerrar Sesión</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark"  id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Menu</div>
                            <a class="nav-link" href="home.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Inicio
                            </a>
                            <?php if ($_SESSION['role_id'] != 2): ?>
                            <div class="sb-sidenav-menu-heading">Formularios</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"> <i class="fas fa-user-alt"></i> </div>
                              Registrar
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="createStudent.php"><i class="fas fa-user-graduate"></i>Estudiante</a>
                                    <a class="nav-link" href="createTeacher.php"><i class="fas fa-user-tie"></i>Docente</a>
                                    <a class="nav-link" href="createNote.php"><i class="fas fa-edit"></i>Registrar Calificación</a>
                                   
                                </nav>
                            </div>
                            
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayoutss" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-user-friends"></i></div>
                                 Usuarios
                                <div class="sb-sidenav-collapse-arrow"></div>
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayoutss" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                     <a class="nav-link" href="createUser.php"><i class="fas fa-user-plus"></i>  Nuevo Usuario</a>
                                   
                                    <a class="nav-link" href="Users.php"><i class="fa fa-book"></i>Lista Usuarios</a>
                                </nav>
                            </div>
                            <?php endif; ?>
                            <div class="sb-sidenav-menu-heading">Matrícula Institucional</div>
                            
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayoutst" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"></div>
                                <i class="fas fa-clipboard-list"></i> Matrícula
                                <div class="sb-sidenav-collapse-arrow"></div>
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayoutst" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="Teachers.php"><i class="fas fa-chalkboard-teacher"></i>Lista de Docentes</a>
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                    <i class="fas fa-graduation-cap"></i>Secciones
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="Students.php"><i class="fas fa-users"></i> Primer Grado</a>
                                            <a class="nav-link" href="Students1.php"><i class="fas fa-users"></i> Segundo Grado</a>
                                            <a class="nav-link" href="Students2.php"><i class="fas fa-users"></i> Tercero Grado</a>
                                            <a class="nav-link" href="Students3.php"><i class="fas fa-users"></i> Cuarto Grado</a>
                                            <a class="nav-link" href="Students4.php"><i class="fas fa-users"></i> Quinto Grado</a>
                                            <a class="nav-link" href="Students5.php"><i class="fas fa-users"></i> Sexto Grado</a>
                                            
                                        </nav>
                                    </div>
                                     <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth1" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                  <i class="fas fa-edit"></i>Notas por Secciones
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAuth1" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="Notes.php"><i class="fas fa-users"></i> Primer Grado</a>
                                            <a class="nav-link" href="Notes1.php"><i class="fas fa-users"></i> Segundo Grado</a>
                                            <a class="nav-link" href="Notes2.php"><i class="fas fa-users"></i> Tercero Grado</a>
                                            <a class="nav-link" href="Notes3.php"><i class="fas fa-users"></i> Cuarto Grado</a>
                                            <a class="nav-link" href="Notes4.php"><i class="fas fa-users"></i> Quinto Grado</a>
                                            <a class="nav-link" href="Notes5.php"><i class="fas fa-users"></i> Sexto Grado</a>
                                            
                                        </nav>
                                    </div>
                                    
                                  
                                </nav>
                            </div>
                            
                            <?php if ($_SESSION['role_id'] != 2): ?>
                            <div class="sb-sidenav-menu-heading">Backuds</div>
                          <a class="nav-link" href="generatePdf.php">
                                <div class="sb-nav-link-icon"></div>
                               <i class="fa fa-file-pdf"></i>Generar Reportes
                               
                            </a>
                            
                            <a class="nav-link" href="actionBackups.php">
                                <div class="sb-nav-link-icon"></div>
                               <i class="fa fa-cloud"></i>Acciones de Backups
                               
                            </a>
                        
                        </div>
                        <?php endif; ?>
                    </div>
             
                   
                </nav>
            </div>
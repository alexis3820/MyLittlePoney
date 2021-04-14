
<header>
        <nav class="navbarre ">
            <div class="logo-button">
                <a class="logo-accueil" href="/">MyLittlePoney</a>
            </div>
<<<<<<< HEAD
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="navbar-nav d-inline">
                    <?php if (isset($_SESSION['id'])) { ?>
                        <li class="nav-item ml-2">
                            <a class="nav-link" href="/panel/default" title="Panel">Panel</a>
                        </li>
                        <li class="nav-item ml-2">
                            <a class="nav-link" href="/user/profil" title="Profil">Profil</a>
                        </li>
                        <li class="nav-item ml-2">
                            <a class="nav-link" href="/user/logout" title="Déconnexion">Se déconnecter</a>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item ml-2">
                            <a class="nav-link" href="/user/default" title="Login">Login</a>
                        </li>
                        <li class="nav-item ml-2">
                            <a class="nav-link" href="/Generator/home" title="GenerateBdd">Générer la base de donnée</a>
                        </li>
                    <?php } ?>
                </ul>
=======
            <?php if (isset($_SESSION['id'])) { ?>
            <div id="link-pages">
                <div><a href="#"><img src="../assets/img/home.svg" alt=""> Accueil</a></div>
                <div><a href="/panel/default">Panel</a></div>
>>>>>>> a888fa1b09bfa7e18a9b31ff82f1d29b5e9b6da0
            </div>
            <div id="settings-links">
                <div><a href="/user/profil">Profil</a></div>
                <div><a href="/generateBdd">Generer BD</a></div>
                <div><a href="/user/logout">Deconnexion</a></div>
            </div> 
            <?php } else { ?>
                <div id="settings-links">

                <div><a href="/user/default">Login</a></div>
            </div> 
                <?php } ?>
        </nav>
    </header>
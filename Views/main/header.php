<header>
    <nav class="navbar navbar-inverse border-0">
        <div class="container-fluid d-inline">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle border-0" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">MyLittlePoney</a>
            </div>
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
                            <a class="nav-link" href="/generateBdd" title="GenerateDatabase">Générer la base de donnée</a>
                        </li>
                        <li class="nav-item ml-2">
                            <a class="nav-link" href="/user/logout" title="Déconnexion">Se déconnecter</a>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item ml-2">
                            <a class="nav-link" href="/user/default" title="Login">Login</a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>
</header>

<header>
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="/">MyLittlePoney</a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                    <?php if (isset($_SESSION['id'])) { ?>
                        <li class="nav-item ml-2">
                            <a class="nav-link" href="/panel/default" title="Panel">Panel</a>
                        </li>
                        <li class="nav-item ml-2">
                            <a class="nav-link" href="/user/profil" title="Profil">Profil</a>
                        </li>
                        <li class="nav-item ml-2" >
                            <a class="nav-link" href="/user/logout" title="Déconnexion">Se déconnecter</a>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item ml-2">
                            <a class="nav-link" href="/user/default" title="Login">Login</a>
                        </li>
                        <li class="nav-item ml-2">
                            <a class="nav-link" href="/Generator/home" title="GenerateBdd">BDD/jeux de données</a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>
</header>

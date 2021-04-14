
<header>
        <nav class="navbarre ">
            <div class="logo-button">
                <a class="logo-accueil" href="/">MyLittlePoney</a>
            </div>
            <?php if (isset($_SESSION['id'])) { ?>
            <div id="link-pages">
                <div><a href="#"><img src="../assets/img/home.svg" alt=""> Accueil</a></div>
                <div><a href="/panel/default">Panel</a></div>
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
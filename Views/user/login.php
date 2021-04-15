<div class="mt-5 mb-5">
    <h1 class="text-center">Connexion</h1>
</div>
<form action="/user/login" method="post">
    <div>
        <input class="form-control" type="text" id="name" name="name" placeholder="Nom :" required>
    </div>
    <div>
        <input class="form-control" type="password" id="password" name="password" placeholder="Mot de passe :">
    </div>
    <div class="row justify-content-center">
        <input class="col-3" type="submit" name="submitLogin" value="Login">
    </div>
</form>

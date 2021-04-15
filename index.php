<?php
/* ===== Entrypoint (rooter) ===== */

require 'Core/Autoloader.php';


/*
url = /user/profil/19

    /user = controller (user+Controller = UserController) <- note uppercase on User
    /profil = function in UserController (profil+Action = profilAction)
    /19 = parameters in function (profilAction($id)  ->  $id = 19)
*/

$uri = $_SERVER['REQUEST_URI'];

session_start();

//if 'trailing slash' exist
if(!empty($uri) && '/' != $uri && '/' === $uri[-1]){
    //remove slash and redirect to avoid duplicate content
    $uri = substr($uri, 0, -1);
    http_response_code(301);
    header('Location: '.$uri);
}

$parameters = [];
if(isset($_GET['ctrl'])){
    $parameters = explode('/', $_GET['ctrl']);
}

$controller = 'Default';
$action = 'default';
$options = '';
if(!empty($parameters[0])) {
    $controller = ucfirst(array_shift($parameters));
    $action = (isset($parameters[0])) ? array_shift($parameters) : 'default';
    $options = (isset($parameters[0])) ? $parameters : '';
}

$excludeActions =
    [
    'myTable',
    'delete',
    ];
if(!in_array($action,$excludeActions)){
    View::openBuffer();
    $newController = new Controller($controller, $action, $options);
    $newController->run();
    $content = View::getBufferContent();
    // put content in index.php (in root of repository Views)
    // this index.php is the final View in navigator
    View::render('index', array('content' => $content));
}else{
    $newController = new Controller($controller, $action, $options);
    $newController->run();
}
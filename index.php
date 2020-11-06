<?php

declare(strict_types=1);
namespace ToDoApp;

spl_autoload_register(function (string $classNamespace) {
    $path = str_replace(['\\', 'ToDoApp/'], ['/', ''], $classNamespace);
    $path = "src/$path.php";
    require_once "$path";
});
use ToDoApp\Controller\AbstractController;
use ToDoApp\Controller\NoteController;
use ToDoApp\Exception\ConfigurationException;
use ToDoApp\Exception\ToDoAppException;

require_once "src/Utils/debug.php";

$configuration = require_once "config/config.php";

$request = new Request($_GET, $_POST, $_SERVER);
try {
    AbstractController::initConfiguration($configuration);
    (new NoteController($request))->run();
} catch (ConfigurationException $e) {
    echo "<h1>Wystąpił błąd w aplikacji</h1>";
    echo "<h3>Problem z aplikacją, proszę spróbowć za chwilę.";
} catch (ToDoAppException $e) {
    echo "<h1>Wystąpił błąd w aplikacji</h1>";
    echo '<h3>'. $e->getMessage() . '</h3>';
} catch (\Throwable $e) {
    echo "<h1>Wystąpił błąd w aplikacji</h1>";
    dump($e);
}






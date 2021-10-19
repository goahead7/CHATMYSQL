<?php
require_once 'composer.phar/vendor/autoload.php';

Twig_Autoloader::reqister();
$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Enviroment($loader);

$user ="sophia";
$pas = "alt26558933";

date_default_timezone_set('UTC');

$users = array (
"sophia"=>"11",
"alex"=>"10"
);

$login = $_GET['login'];
$password = $_GET['password'];
$txt = $_GET['txt'];
$date = date('l jS \of F Y h:i:s A');

if(($users[$login]  === $password) && ($login != null))
{
/*$message = array(
'login' => $login,
'txt' => $txt,
'date' => $date
);
    $file = json_decode(file_get_contents('file.json'));
    array_push($file->message, $message);
    file_put_contents('file.json', json_encode($file));*/

    $bind = new PDO('mysql:host=localhost;dbname=sqlchat',$user,$pas );
    $db = "INSERT INTO CHAT (LOGIN, TXT,DATE) VALUES ($login,$txt,$date)";
    $bind->exec($db);

}
else
    {
        echo "Пользователь не авторизован" . "<br/>";
    }


$bind = new PDO('mysql:host=localhost;dbname=sqlchat',$user,$pas );
$db = "SELECT FROM CHAT";
$chat = $bind->query($db);

$allmess = $chat->fetchAll();

echo $twig->render('data.twig',array ('allmes'=>$allmess));


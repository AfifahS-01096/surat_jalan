<?php
$db_name = 'mysql:host=localhost;dbname=suratjalan_db';
$user_name = 'root';
$user_passwoard = '';

$conn = new PDO($db_name, $user_name, $user_passwoard);

if ($conn){
    echo "";
}
    
function unique_id(){
    $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charLength = strlen($chars);
    $randomString = '';
    for ($i=0; $i < 20; $i++){
        $randomString.=$chars[mt_rand(0, $charLength - 1)];
    }
    return $randomString;
}

?>
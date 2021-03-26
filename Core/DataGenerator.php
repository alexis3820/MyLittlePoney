<?php

$file = fopen('../asset/csv/Prenoms.csv', 'r');
$header = fgetcsv($file,'',';');
$firstNames = [];
while (($line = fgetcsv($file,'',';')) !== FALSE) {
    $line_assoc = array_combine($header,$line);
    $firstNames[] = $line_assoc['01_prenom'];
}
fclose($file);


$file = fopen('../asset/csv/patronymes.csv', 'r');
$header = fgetcsv($file,'',',');
fgetcsv($file,'',','); // have to skip first line after header because she is ugly :S
$lastNames = [];
while (($line = fgetcsv($file,'',',')) !== FALSE) {
    $line_assoc = array_combine($header,$line);
    $lastNames[] = $line_assoc['patronyme'];

}
fclose($file);

$file = fopen('../asset/csv/adresses.csv', 'r');
$header = fgetcsv($file,'',';');
$addresses = [];
while (($line = fgetcsv($file,'',';')) !== FALSE) {
    $line_assoc = array_combine($header,$line);
    $addresses[] = $line_assoc['Nom_commune'].','.$line_assoc['Code_postal'];

}
fclose($file);


/*____________________________________________________________*/
$count = 0;
$objective = 1000000;
$finalData = [];
while($count < $objective){
    $prenom = $lastNames[rand(0,count($firstNames))];
    $nom = $firstNames[rand(0,count($lastNames))];
    $email = str_replace(' ','',$prenom).'.'.str_replace(' ','',$nom).'@'.randomDNS().'.'.randomDNS();
    $pseudo = randomChars(rand(10,20));
    $mdp = randomChars(rand(10,20));
    $sexe = rand(0,1);
    $dateNaissance = randomDate('1950-01-01', date("Y-m-d"));
    $telephone = '0'.randomPhone();
    $addressePostale = randomChars(rand(10,20));
    $cheminAvatar = 'C:/'.$prenom;
    $description = randomChars(rand(10,200));
    $adresseSitePostale = 'https://www.' . randomChars(rand(10,20));
    $adresseIp = mt_rand(0, 255) . "." . mt_rand(0, 255) . "." . mt_rand(0, 255) . "." . mt_rand(0, 255);
    $dateHeureInscription = date("Y-m-d H:i:s");
    $dateHeureDerniereConnexion = date("Y-m-d H:i:s");


    /* Todo A continuer ! */
}
/*____________________________________________________________*/

function randomChars($length){
    $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $string = '';
    for($i=0; $i<$length; $i++){
        $string .= $chars[rand(0, strlen($chars)-1)];
    }
    return $string;
}

function randomDNS($length=3){
    $chars = 'abcdefghijklmnopqrstuvwxyz';
    $string = '';
    for($i=0; $i<$length; $i++){
        $string .= $chars[rand(0, strlen($chars)-1)];
    }
    return $string;
}

function randomPhone($length=9){
    $numbers = '0123456789';
    $string = '';
    for($i=0; $i<$length; $i++){
        $string .= $numbers[rand(0, strlen($numbers)-1)];
    }
    return $string;
}

function randomDate($start_date, $end_date, $datetime = false)
{
    $min = strtotime($start_date);
    $max = strtotime($end_date);

    $val = rand($min, $max);
    if($datetime)
    {
        return date('Y-m-d H:i:s', $val);
    }else
    {
        return date('Y-m-d', $val);
    }
}
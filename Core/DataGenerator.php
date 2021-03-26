<?php

$file = fopen('../assets/csv/Prenoms.csv', 'r');
$header = fgetcsv($file,'',';');
$firstNames = [];
while (($line = fgetcsv($file,'',';')) !== FALSE) {
    $line_assoc = array_combine($header,$line);
    $firstNames[] = $line_assoc['01_prenom'];
}
fclose($file);

/* We generate the first table that has the least data. It will serve as a limit for the other tables

   count($firstNames) is the LIMIT !
*/
$nbLinesRequired = count($firstNames);

$file = fopen('../assets/csv/patronymes.csv', 'r');
$header = fgetcsv($file,'',',');
fgetcsv($file,'',','); // have to skip first line after header because she is ugly :S
$lastNames = [];
while (($line = fgetcsv($file,'',',')) !== FALSE) {
    $line_assoc = array_combine($header,$line);
    $lastNames[] = $line_assoc['patronyme'];
    if($nbLinesRequired === count($lastNames)){
        break;
    }

}
fclose($file);

$file = fopen('../assets/csv/adresses.csv', 'r');
$header = fgetcsv($file,'',';');
$addresses = [];
while (($line = fgetcsv($file,'',';')) !== FALSE) {
    $line_assoc = array_combine($header,$line);
    $addresses[] = $line_assoc['Nom_commune'].','.$line_assoc['Code_postal'];
    if($nbLinesRequired === count($addresses)){
        break;
    }

}
fclose($file);

$count = 0;
$objective = 1000000;
$finalData = [];
while($count < $objective){
    $randFirstName = $lastNames[rand(0,$nbLinesRequired)];
    $randLastName = $firstNames[rand(0,$nbLinesRequired)];
    $mail = str_replace(' ','',$randFirstName).'.'.str_replace(' ','',$randLastName).'@'.randomDNS().'.'.randomDNS();
    $pseudonyme = randomChars(rand(10,20));
    $mdp = randomChars(rand(10,20));
    $phone = '0'.randomPhone();

    /* Todo A continuer ! */
}

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
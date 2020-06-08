<?php

require 'MorzeABC.php';
require 'Morze.php';

function beolvasABC(){
    $tomb=array();
    try {
        $file= file_get_contents("morzeabc.txt");
        $sorok= explode("\n", $file);
        array_shift($sorok);
        for ($i = 0; $i < count($sorok); $i++) {
            $split= explode("\t", $sorok[$i]);
            $o=new MorzeABC($split[0], substr($split[1],0, strlen($split[1])-1));//a végére helyez egy szóközt vagy valamit, nem látható karakter, alig találtam meg
            $tomb[]=$o;
        }
    } catch (Exception $exc) {
        die("hiba a beolvasásnál: morzeabc.txt".$exc);
    }

    return $tomb;
}

function betubolMorzekodot($betu,$kodtar){
    $morzekod;
    foreach ($kodtar as $item){
        if($item->getBetu==$betu){
            $morzekod=$item->getMorzejel;
        }
    }
    return $morzekod;
}

$a=beolvasABC();
$behuzas="&nbsp&nbsp&nbsp&nbsp&nbsp";
echo'3. feladat: A morze abc '.count($a).' db karakter kódját tartalmazza. <br>';
echo'4. feladat: Kérek egy karaktert: <br>';
echo      '<form method="post" action="#">'
            .$behuzas. '<input type="text" name="karakter"><br>'
            .$behuzas. '<input type="submit" value="Küldés">'
        . '</form>';
if(isset($_POST['karakter'])&&!empty($_POST['karakter'])){
    $beker=$_POST['karakter'];
    $valasz="Nem található a kódtárban ilyen karakter! <br>";
    foreach ($a as $item) {
        if(strtoupper($item->getBetu())==strtoupper($beker)){
            $valasz=$item->getMorzejel();
        }
    }
    echo $behuzas."a ".$beker.' karakter morze kódja: '.$valasz.'<br>';
    unset($_POST['karakter']);
}

//5. feladat
function beolvasMorze(){
    $tomb=array();
    try {
        $file= file_get_contents("morze.txt");
        $sorok= explode("\n", $file);
        for ($i = 0; $i < count($sorok); $i++) {
            $split= explode(";", $sorok[$i]);
            $o=new Morze($split[0], $split[1]);
            $tomb[]=$o;
        }
    } catch (Exception $exc) {
        die("hiba a beolvasásnál: morze.txt".$exc);
    }
    return $tomb;
}
$b= beolvasMorze();

function Morze2Szöveg($morze_sorozat,$abc){
    $rendesSzoveg="";
    $szavak=explode("       ", $morze_sorozat);//szöveg tördelése szavakra
    for ($i = 0; $i < count($szavak); $i++) {
        $betuk= explode("   ", $szavak[$i]);
        for ($j = 0; $j < count($betuk); $j++) {
            foreach ($abc as $item) {
                if(!strcmp($item->getMorzejel(), $betuk[$j])){
                    $rendesSzoveg.=$item->getBetu();
                }
            }
        }
        $rendesSzoveg.=" ";
    }
    return $rendesSzoveg;
}

echo '7. feladat: Az első idézet szerzője: '.Morze2Szöveg($b[0]->getSzerzo(), $a)."<br>";

echo '8. feladat: A leghosszabb idézet szerzője és az idézet: ';
$leghosszabb=0;
$leghIdezet="";
$leghSzerzo="";
foreach ($b as $item) {
    if(strlen(Morze2Szöveg($item->getIdezet(), $a))>$leghosszabb){
        $leghosszabb=strlen(Morze2Szöveg($item->getIdezet(), $a));
        $leghSzerzo= Morze2Szöveg($item->getSzerzo(), $a);
        $leghIdezet= Morze2Szöveg($item->getIdezet(), $a);
    }
}
echo $leghSzerzo.": ".$leghIdezet.".<br>";
//9. feladat: 
echo '9. feladat: Arisztotelész idézetei:<br>';
$arisztMorze=$b[0]->getSzerzo();
$arisztIdezetek=array();
foreach ($b as $item) {
    if(!strcmp($item->getSzerzo(),$arisztMorze)){
        $arisztIdezetek[]= Morze2Szöveg($item->getIdezet(), $a);
    }
}
foreach ($arisztIdezetek as $value) {
    echo '&nbsp&nbsp&nbsp&nbsp&nbsp- '.$value.'<br>';
}

//10. feladat: 
$fajlba="";
foreach ($b as $val) {
    $fajlba.= 
            substr(
                    Morze2Szöveg($val->getSzerzo(), $a),
                    0,
                    strlen(Morze2Szöveg($val->getSzerzo(), $a))-1
                    )
            .":"
            . Morze2Szöveg($val->getIdezet(), $a)
            .".\n";
}

$myFile= fopen("forditas.txt", "w");
fwrite($myFile, $fajlba);
<?php
session_start();


//walidacja formularza
if(isset($_POST['wplac']))
{
    $imie = $_POST['imie'];
    $nazwisko = $_POST['nazwisko'];
    $ilosc = $_POST['ilosc'];
    $numer = $_POST['numer'];

    $walidacja = true;


    //imie
    if(strlen($imie) < 3)
    {
        $walidacja = false;
        $_SESSION['imie_error'] = 'Wpisz poprawne imię';
    }





    //łączenie do bazy 

    if($walidacja)
    {
        require_once('baza.php');

        mysqli_report(MYSQLI_REPORT_STRICT);
        try {
             $polaczenie = new mysqli($server, $user, $pass, $database);
        } 
        catch (mysqli_sql_exception $e)
        {
            $_SESSION['error'] = $e;
            
            exit();
        }


            //rejestracja użytkownika  

            $zapytanie = "INSERT INTO datek VALUES ('$imie', '$nazwisko', '$ilosc', '$numer')";

            if($polaczenie->query($zapytanie))
            {
                //udało się
                header('Location: datekwplacony.php');
                $polaczenie->close();
            }
            else 
            {
                //nie udało się
                header('Location: nie.php');
            }
            $polaczenie->close();
        }



      
    }





?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>O schronisku</title>
    <style>
        body{
            font-family: Arial;
            background-color: #FFC300 ;
            
        }
        a{
            text-decoration: none;
            color: deeppink;
        }

        span{
            font-weight: bold;
        }
        nav ul{
            background: #DAF7A6;
            height: 50px;
             box-shadow: 0px 0px 20px 2px #000;
             list-style-type: none;
        }

        li{
            float: left;
            width: 25%;
            text-align: center;
            list-style-position: inside;
            color: black;
            padding: 15px 0;
        }

        a{
            text-decoration: none;
            color: #FF5733;
            font-weight: 1;
        }

        a:hover, a:focus{
            color: green;
        }
        h2{
            display: flex;
            justify-content: center;
            margin-left: 5px;

        }
        h1{
            display: flex;
            justify-content: center;


        }
            img{
        display: block;
        margin-top: 2rem;
        margin-left: 3rem;
        margin-right: 1.25rem;
	    background-color: yellow;
	    height: 280px;
	    width: 50xxx0px;
	    border: 2px solid #DAF7A6;
	    object-fit:scale-down;
        }
        .kontener{
            display: flex;
            justify-content: space-between;
        }
        p{
            margin-left: 1.25rem;
            margin-top: 2rem;

        }
        .kontener2{
            display: flex;
            justify-content: center;
            align-items: center;
        }

    </style>
</head>
<body>
<nav>
    <ul>
        <li><a href="serwis.php">ADOPTUJ</a></li>
        <li><a href="schronisko.php">O SCHRONISKU</a></li>
        <li><a href="wolontariusz.php">WOLONTARIUSZ</a></li> 
        <li><a href="datek.php">DATEK</a></li>  
    </ul>
</nav>
<div class="kontener">


        <div class="tekst">
    <p>    Nowo powstałe schronisko na terenie Nowego Sącza obecnie Zoodoptuj prowadzi 1 schronisko dla bezdomnych zwierząt, w tym przytulisko dla zwierząt gospodarskich „Rogate Ranczo”. Pod naszą opieką znajduje się ponad 20 porzuconych psów i kotów oraz zwierzęta gospodarskie: konie, kucyki, krowy, cielęta, świnki, kozy, króliki, i osiołek. Wszystkie zostały odebrane ludziom, którzy je źle traktowali – bili, głodzili, czasami wręcz katowali.
Nasi Inspektorzy codziennie przeprowadzają interwencje w sprawach niehumanitarnego traktowania zwierząt. W 2021 r. przeprowadziliśmy takich interwencji 6046. W wielu sprawach walczymy w sądach o kary dla oprawców zwierząt. Działamy zgodnie z Ustawą o ochronie zwierząt oraz Ustawą o działalności Organizacji Pożytku Publicznego i Wolontariatu. Staramy się jak najlepiej odmienić los naszych podopiecznych. Często pod skrzydłami Zoodoptuj uratowane zwierzaki zmieniają się nie do poznania! Wcześniej skatowane, zagłodzone, chore, zaniedbane – teraz zdrowe, najedzone i choć trochę szczęśliwe. Trochę, bo pełnię szczęścia daje dopiero adopcja. Regularnie prowadzimy akcje adopcyjne, do końca października 2021 roku udało się nam uratować i znaleźć nowe domy dla 120 psów oraz 56 kotów.
Środki uzyskane dzięki Państwa hojności umożliwiają nam remonty w prowadzonych przez nas schroniskach: co roku modernizujemy i budujemy nowe kojce i wybiegi dla psiaków. Przed zbliżającą się zimą szczególną uwagę zwracamy na stan techniczny bud dla psiaków znajdujących w schroniskach. Wiele trafiających do nas zwierząt wymaga natychmiastowej opieki lekarza weterynarii, dlatego więc dla ponad 2000 zwierząt kupujemy olbrzymią ilość leków i szczepionek – finansujemy stałą opiekę weterynaryjną. Trafia do nas wiele psów i kotów po wypadkach komunikacyjnych, wówczas najczęściej konieczna jest natychmiastowa operacja ratująca życie.
    </p>
    </div>
    <img src="img/schronisko.jpg" />
    </div>
    <div class="kontener2">
    <a href="datek.php"><img src="img/schronisko1.jpg" alt="Wesprzyj!"></a>

    <h1>Chesz wsprzeć nasze schronisko oraz nasze działania? Kliknij w pieski!</h1>
    </div>
    
</body>

</html>
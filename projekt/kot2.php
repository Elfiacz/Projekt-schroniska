<?php
session_start();


//walidacja formularza
if(isset($_POST['wplac']))
{
    $imie = $_POST['imie'];
    $wiek = $_POST['wiek'];
    $gatunek = $_POST['gatunek'];
    $data = $_POST['data'];

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

            $zapytanie = "INSERT INTO pieski VALUES ('$imie', '$wiek', '$gatunek','$adopcja')";

            if($polaczenie->query($zapytanie))
            {
                //udało się
                header('Location: piesk1.php');
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

    



    $zapytanie = "SELECT * FROM `pieski`";
    require_once('baza.php');
    $polaczenie = new mysqli($server, $user, $pass, $database);

    $rezultat = $polaczenie->query("SELECT adopcja FROM pieski WHERE id = '6'");
    $row = $rezultat->fetch_assoc();
    $numer = $row['adopcja'];
        unset($_SESSION['imie']);
        unset($_SESSION['wiek']);
        unset($_SESSION['gatunek']);
        unset($_SESSION['odkiedy']);
        unset($_SESSION['adpocja']);
        unset($_SESSION['adoptowany']);
    if($numer=='0')
    {
        
        if($pieski=$polaczenie->query($zapytanie)->fetch_all())
        {
        //pierwszy piesek
            $_SESSION['imie']=$pieski[5][1];
            $_SESSION['wiek']=$pieski[5][2];
            $_SESSION['gatunek']=$pieski[5][3];
            $_SESSION['odkiedy']=$pieski[5][4];
            if(isset($_POST['adopt']))
    {
        $rezultat3 = $polaczenie->query("UPDATE pieski SET adopcja = '1' WHERE id = '6'");
        $_SESSION['adoptowany'] = 1;
    }
    
        //  $_SESSION['imie1']=$pieski[1][0]; 
        }
    }
    else
    {
        $_SESSION['adpocja'] = "Pies adoptowany";
        
    }
    
    
    /*if($pieski=$polaczenie->query($zapytanie)->fetch_all())
    {
        //pierwszy piesek
        $_SESSION['imie']=$pieski[1][0];
        $_SESSION['wiek']=$pieski[1][1];
        $_SESSION['gatunek']=$pieski[1][2];
        $_SESSION['odkiedy']=$pieski[1][3];
        
    
        //  $_SESSION['imie1']=$pieski[1][0]; 
    }
*/
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zwierzatka</title>
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

        }
        img{
        display: block;
        margin-top: 2rem;
        margin-left: 30rem;
        margin-right: 1.25rem;
	    background-color: yellow;
	    border: 2px solid #DAF7A6;
	    object-fit:scale-down;
 
        }
        .kontener{
            display: flex;
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
        
    <h2>
    <p><span>
        <?php
            if(isset($_SESSION['imie']))
                {
                    echo $_SESSION['imie'];
                }
        ?> 
        </span>
    </p>
    </h2>
    <div class="kontener">
    <img src="img/kot_schron2.jpg" alt="Latek">
            <div class="info">
                

    <?php
    if(isset($_SESSION['imie']))
    {
    echo '<div class="imie"><p>Imię: <span>';
            echo $_SESSION['imie'];     
    echo '</span></p></div>';
    }
    ?>
    <?php
    if(isset($_SESSION['wiek']))
    {
    echo '<div class="wiek"><p>Wiek: <span>';
            echo $_SESSION['wiek'];     
    echo '</span></p></div>';
    }
    ?>
    <?php
    if(isset($_SESSION['gatunek']))
    {
    echo '<div class="gatunek"><p>Gatunek: <span>';
            echo $_SESSION['gatunek'];     
    echo '</span></p></div>';
    }
    ?>
    <?php
    if(isset($_SESSION['odkiedy']))
    {
    echo '<div class="data"><p>U nas od: <span>';
            echo $_SESSION['odkiedy'];     
    echo '</span></p></div>';
    }
    ?>
    <div class="adopcja">
    <?php
            if(isset( $_SESSION['adpocja']))
                {
                    echo  $_SESSION['adpocja'];
                }
        ?> 
    </div>
        <form action="" method="POST">
        <input type="submit" name="adopt" value="Adoptuj">
    </form>
    

    
    </div>
    
</body>
</html>
<?php
session_start();


//walidacja formularza
if(isset($_POST['zaloz']))
{
    $imie = $_POST['imie'];
    $nazwisko = $_POST['nazwisko'];
    $email = $_POST['email'];
    $telefon = $_POST['telefon'];

    $walidacja = true;


    //imie
    if(strlen($imie) < 3)
    {
        $walidacja = false;
        $_SESSION['imie_error'] = 'Wpisz poprawne imię';
    }

    //email
    if(filter_var($email, FILTER_VALIDATE_EMAIL) == false)
    {
        $walidacja = false;
        $_SESSION['email_error'] = 'Wpisz prawidłowy adres email';
    }
        //email
        if(strlen($nazwisko) < 3)
        {
            $walidacja = false;
            $_SESSION['nazwisko_error'] = 'Wpisz prawidłowe nazwisko';
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

            $zapytanie = "INSERT INTO wolontariusz VALUES ('$imie', '$nazwisko', '$email', '$telefon')";

            if($polaczenie->query($zapytanie))
            {
                //udało się
                header('Location: index.php');
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
    <title>Wolonatriusz</title>
    <style>
        body{
            font-family: Arial;
            background-color: #FFC300;
            
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
            margin-top: 20px;
            margin-left: 10px;
            margin-right: 10px;
            

        }

        form{
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }
        form>input{
            display: flex;
            margin: 10px;
        }
        .error{
            color: red;
            margin: 10px;
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
        
    <h2> Chesz być w wolontariuszu? Zgłoś się już teraz!</h2>
    <form action="wolontariusz.php" method="POST" novalidate>
        <div>
        <input type="text" name="imie" placeholder="Imie">
        <div class="error">
            <?php
                if(isset($_SESSION['imie_error']))
                {
                    echo $_SESSION['imie_error'];
                    unset($_SESSION['imie_error']);
                }
            ?>
        </div>
            </div>
            <div>
        <input type="text" name="nazwisko" placeholder="Nazwisko">
            </div>
            <div>
        <input type="email" name="email" placeholder="Email">
    
        <div class="error">
            <?php
                if(isset($_SESSION['email_error']))
                {
                    echo $_SESSION['email_error'];
                    unset($_SESSION['email_error']);
                }
            ?>
            </div>
            <div>
            <input type="telfon" name="telefon" maxlength="9" placeholder="Numer telefonu">

            </div>

            <div>
                <br>
        <input type="submit" value="Załóż podanie" name="zaloz" >
            </div>
    </form>
    
</body>
</html>
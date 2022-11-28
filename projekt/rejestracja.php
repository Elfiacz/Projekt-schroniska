<?php
session_start();


//walidacja formularza
if(isset($_POST['zaloz']))

{
    $imie = $_POST['imie'];
    $nazwisko = $_POST['nazwisko'];
    $email = $_POST['email'];
    $login = $_POST['login'];
    $haslo1 = $_POST['haslo1'];
    $haslo2 = $_POST['haslo2'];

    $walidacja = true;


    //imie
    if(strlen($imie) < 3)
    {
        $walidacja = false;
        $_SESSION['imie_error'] = 'Wpisz poprawne imię';
    }

    //login
    if(!ctype_alnum($login))
    {
        $walidacja = false;
        $_SESSION['login_error'] = 'Login musi składać się tylko z liter i cyfr (bez polskich znaków)';
    }

    //email
    if(filter_var($email, FILTER_VALIDATE_EMAIL) == false)
    {
        $walidacja = false;
        $_SESSION['email_error'] = 'Wpisz prawidłowy adres email';
    }

    if($haslo1 != $haslo2)
    {
        $walidacja = false;
        $_SESSION['haslo_error'] = 'Hasła są różne';
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

        //zabezpieczenia
        $login = htmlentities($login);
        $haslo = htmlentities($haslo1);
        $login = $polaczenie->real_escape_string($login);
        $haslo1 = $polaczenie->real_escape_string($haslo1);

        // sprawdzamy czy podany login już istnieje 
        
        $zapytanie = "SELECT login FROM users WHERE login='$login'";
        $wynik = $polaczenie->query($zapytanie);

        if($wynik->num_rows > 1)
        {
            $_SESSION['login_error'] = 'Podany login już istnieje';
        }
        else {
            //login prawidłowy 
            //szyfrowanie hasła 

            $haslo1 = password_hash($haslo1, PASSWORD_DEFAULT);

            //rejestracja użytkownika  

            $zapytanie = "INSERT INTO users VALUES ('$imie', '$nazwisko', '$login', '$email', '$haslo1')";

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


}


?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rejestracja</title>
    <style>
        body{
            font-family: Arial;
            background-color: #FFC300;
            
        }
        h2{
            display: flex;
            justify-content: center;

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
        
    <h2> Wpisz dane aby założyć konto.</h2>
    <form action="rejestracja.php" method="POST" novalidate>
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
        <input type="text" name="login" placeholder="Login">
        <div class="error">
            <?php
                if(isset($_SESSION['login_error']))
                {
                    echo $_SESSION['login_error'];
                    unset($_SESSION['login_error']);
                }
            ?>
        </div>
            </div>
            <div>
        <input type="password" name="haslo1" placeholder="Hasło">
            </div>
            <div>
        <input type="password" name="haslo2" placeholder="Powtórz hasło">
        <div class="error">
            <?php
                if(isset($_SESSION['haslo_error']))
                {
                    echo $_SESSION['haslo_error'];
                    unset($_SESSION['haslo_error']);
                }
            ?>
            </div>
            <div>
        <input type="submit" value="Załóż konto" name="zaloz" >
            </div>
    </form>
    
</body>
</html>
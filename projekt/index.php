<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zoodoptuj!</title>
    <style>
        body{
            font-family: Arial;
            background-color: #FFC300;
            
        }
        .form{
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }
        h2{
            display: flex;
            justify-content: center;

        }
        .form input{
            display: block;
            margin: 20px;
        }
        .form a{
            text-decoration: none;
            color: deeppink;
        }
        .form .error{
            color: red;
            border: 1px solid crimson;
            padding: 5px 10px;
        }
    </style>
</head>
<body>
    <h2>Witaj w Zoodoptuj! Aby zaadoptować psiaka zaloguj się!</h2>
    <div class="form">
        <form action="logowanie.php" method="post">
            <input type="text" name="login" placeholder="wpisz login">
            <input type="password" name="haslo" placeholder="wpisz haslo">
            <input type="submit" value="Zaloguj się" name="loguj">
        </form>
        <?php
        if(isset($_SESSION['error'])) :
        ?>
        <div class="error">
            <?php
            echo $_SESSION['error'];
            unset($_SESSION['error']);
            ?>
        </div>
        <?php endif; ?>
        <p>Nie masz konta? <a href="rejestracja.php">Utwórz konto </href></p>
    </div>
    
</body>
</html>
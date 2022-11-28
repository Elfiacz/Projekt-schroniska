<?php
session_start();
?>

<?php
// weryfikacja pól logowania
if(isset($_POST['loguj']))
{
    if(empty($_POST['login']) || empty($_POST['haslo']))
    {
        $_SESSION['error'] = 'Wpisz login i hasło';
        header('location: index.php');
        exit();
    }
}
?>

<?php
$login = $_POST['login'];
$haslo = $_POST['haslo'];

// proces łączenia z bazą danych i obsługa logowania
require_once('baza.php');

mysqli_report(MYSQLI_REPORT_STRICT);
try{
    $poloczenie = new mysqli($server, $user, $pass, $database); 
}catch(mysqli_sql_exception $e)
{
$_SESSION['error'] = $e;
header('Location: index.php');
exit();
}

// udało sie połączyć z bazą danych

// zabezpieczenie
$login = htmlentities($login);
$haslo = htmlentities($haslo);
$login = $poloczenie->real_escape_string($login);
$haslo = $poloczenie->real_escape_string($haslo);

// weryfikacja loginu
$zapytanie = "SELECT login FROM users WHERE login='$login'";
$wynik = $poloczenie->query($zapytanie);

// sprawdzamy czy baza zwróci dokładnie 1 rekord 

if($wynik->num_rows == 1)
{
    //weryfikacja hasla
    $zapytanie = "SELECT haslo FROM users WHERE login='$login'";
    $wynik = $poloczenie->query($zapytanie);
    $rekord = $wynik->fetch_assoc();

    if($rekord['haslo'] == $haslo)
    {
        $_SESSION['user'] = $login;
    header('Location: serwis.php');
    }
    else{
        $_SESSION['error'] = 'Nieprawidłowe hasło!';
        header('location: index.php');
        exit();
    }

    $_SESSION['user'] = $login;
    header('Location: serwis.php');
}
else 
{
    $_SESSION['error'] = 'Błędny login';
    header('Location: index.php');
    exit();
}

?>
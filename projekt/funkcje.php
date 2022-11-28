<?php

    function show_users()
    {
        require_once('baza.php');

        mysqli_report(MYSQLI_REPORT_STRICT);
        try {
             $polaczenie = new mysqli($server, $user, $pass, $database);
        } 
        catch (mysqli_sql_exception $e)
        {
            echo 'blad polaczenia';
            exit();
        }

        $zapytanie = "SELECT imie, nazwisko, login, email FROM users";
        $wynik = $polaczenie -> query($zapytanie);

        echo '<table>';
        echo '<tr>';
        echo '<th>Imię</th>';
        echo '<th>Nazwisko</th>';
        echo '<th>Login</th>';
        echo '<th>Email</th>';
        echo '</tr>';

        while ($rezultat = $wynik ->fetch_assoc())
         {
            echo '<tr>';
            foreach($rezultat as $rekord)
        {
            echo '<td>' . $rekord .'</td>';
        }
        echo '</tr>';

    }
        echo '</table>';

        $polaczenie -> close();
}

    ?>

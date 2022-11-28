<?php
session_start();

if(!isset($_SESSION['user']))
{
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Serwis</title>
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
        h1{
            display: flex;
            justify-content: center;

        }
        p{
            display: flex;
            justify-content:center;
        }
        h4{
            display: flex;
            justify-content:center;
        }
         	
   .img1{
	background-color: yellow;
	height: 400px;
	width: 99.5%;
	border: 3px solid #DAF7A6;
	object-fit:cover;
    }
    .img{
        
	background-color: yellow;
	height: 295px;
	width: 300px;
	border: 3px solid #DAF7A6;
	object-fit:none;
    margin-top: 1rem;
    

    }
    .kontener{
        margin: 3em;
        display: flex;
        flex-wrap: wrap;
        gap: 5rem;
        justify-content: space-between;
    }
    </style>
</head>
<body>

<nav>
    <ul>
        <li><a href="#">ADOPTUJ</a></li>
        <li><a href="schronisko.php">O SCHRONISKU</a></li>
        <li><a href="wolontariusz.php">WOLONTARIUSZ</a></li> 
        <li><a href="datek.php">DATEK</a></li>  
    </ul>
</nav>

    <h1>Witaj w Zoodoptuj!</h1>
    <p>Jesteś zalogowany jako:  <span>
    <?php
    if(isset($_SESSION['user']))
    {
        echo $_SESSION['user'];
    }
    ?>
    </span></p>
    <img class="img1" src="img/psy5.jpg" />
    <h4>Sprawdź naszych podopiecznych!</h4>
        <div class="kontener">
    <div>
        <a href="piesek1.php"><img class="img" src="img/pies_schron1.jpg" alt="Sprawdz!"></a>
    </div>
    <div>
        <a href="piesek2.php"><img class="img" src="img/pies_schron2.jpg" alt="Sprawdz!"></a>
    </div>
    
    <div>
        <a href="kon1.php"><img class="img" src="img/kon_schron1.jpg" alt="Sprawdz!"></a>
    </div>
    <div>
        <a href="kot1.php"><img class="img" src="img/kot_schron1.jpg" alt="Sprawdz!"></a>
    </div>
    <div>
        <a href="kot2.php"><img class="img" src="img/kot_schron2.jpg" alt="Sprawdz!"></a>
    </div>
    </div>

    
</body>

</html>
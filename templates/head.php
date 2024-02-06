<html>

<head>
    <meta charset="utf-8">

    <link rel="stylesheet" href="./css/stranka.css">



</head>

<body>
    <header class="header">
        <label class="logo"><a style="text-decoration: none; color:white;" href="index.php?akvarko">Akvárium</a></label>
        <ul>
            <?php if (isset($_SESSION['user_logged_in']) && $_SESSION['UzivatelID'] == 1): ?>
            <li><a href="index.php?admin">Správa rybiček</a></li>
            <?php endif; ?>
            <li><a href="index.php?rybka">Moje rybka</a></li>
            <li><a href="index.php?logout">Odhlásit se</a></li>
        </ul>
    </header>
    <menu>


    </menu>


</body>

</html>
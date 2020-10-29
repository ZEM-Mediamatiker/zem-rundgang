
<head>
    <title>ZEM - Quiz / Profil</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css?<?php echo date('l jS \of F Y h:i:s A'); ?>">
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <header>
        <h1>
        <?php
        $gender = explode("/", $_COOKIE['user'])[1];
        $name = str_replace("+", " ", explode("/", $_COOKIE['user'])[0]);
        if(strpos($gender,'m') == true) {
            echo "Herr<br/><span>$name</span>";
        } else {
            echo "Frau<br/><span>$name</span>";
        }
        ?>
        </h1>
    </header>
    <div class="profile-details">
        <h2>Frage</h2>
        <p>Nummer <?php echo explode(".", $_COOKIE['checkpoint'])[1]; ?></p>
        <h2>Dein Punktestand</h2>
        <p><?php echo $_COOKIE['points']; ?></p>
    </div>
    <form method="POST">
        <input type="submit" name="profile_back" value="Zurück">
    </form>
    <?php
    if(isset($_POST['profile_back'])) {
        header("Location: index.php");
        exit;
    }

    ?>
</body>

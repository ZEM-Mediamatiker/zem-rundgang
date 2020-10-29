
<head>
    <title>ZEM - Quiz / Einstellungen</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css?<?php echo date('l jS \of F Y h:i:s A'); ?>">
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>
<?php
    if(isset($_POST['slogin'])) {
        if($_POST['password'] == "zem12345") {
        ?>
            <header>
                <h1>Quiz - Einstellungen</h1>
            </header>
            <div class="settings-container">
                <div class="setting">
                    <p>Quiz aktiv</p>
                    <?php
                        $settingsa = fopen("settings.txt", "r") or die("Unable to open file!");
                        $active = explode(": ",fread($settingsa,13))[1];
                        fclose($settingsa);
                    ?>
                    <label class="switch">
                        <input type="checkbox" name="active" <?php if($active == 1) { echo "checked"; } ?>>
                        <span class="slider"></span>
                    </label>
                </div>
                <div class="setting">
                    <p>Rangliste zeigen</p>
                    <?php 
                        $settingss = fopen("settings.txt", "r") or die("Unable to open file!");
                        $show = explode(": ",fread($settingss,31))[2];
                        fclose($settingss);
                    ?>
                    <label class="switch">
                        <input type="checkbox" name="stats" <?php if($show == 1) { echo "checked"; } ?>>
                        <span class="slider"></span>
                    </label>
                </div>
            </div>
            <footer>
                <p>Quiz by Lars Heinitz & Nicolas Fux</p>
            </footer>
        <?php
        } else {
        ?>
            <header>
                <h1>Einstellungen - Login</h1>
            </header>
            <form class="login" method="POST">
                <label>Passwort</label>
                <input type="password" name="password" required>
                <input type="submit" name="slogin" value="Einloggen">
            </form>
            <?php echo "<span id='wrong-password'>Passwort inkorrekt!</span>"; ?>
            <footer>
                <p>Quiz by Lars Heinitz & Nicolas Fux</p>
            </footer>
        <?php
        }
    } else {
?>
        <header>
            <h1>Einstellungen - Login</h1>
        </header>
        <form class="login" method="POST">
            <label>Passwort</label>
            <input type="password" name="password" required>
            <input type="submit" name="slogin" value="Einloggen">
        </form>
        <footer>
            <p>Quiz by Lars Heinitz & Nicolas Fux</p>
        </footer>
<?php
    }
?>
    <script src="script.js?<?php echo date('l jS \of F Y h:i:s A'); ?>"></script>
</body>

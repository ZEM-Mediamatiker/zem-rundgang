
<head>
    <title>ZEM - Quiz</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css?<?php echo date('l jS \of F Y h:i:s A'); ?>">
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <!-- START QUIZ -->
    <?php
    if($_COOKIE['checkpoint'] == "") {
        // READ SETTINGS
        $settings = fopen("settings.txt", "r") or die("Unable to open file!");
        $active = explode(": ",fread($settings,14))[1];
    ?>
    <div class="start-wrap">
        <div class="start-container">
        <img src="images/zem.jpg" alt="ZEM">
            <h1>Herzlich willkommen<br/> im ZEM!</h1>
        </div>
        <form method="POST">
            <input type="submit" name="start" value="Quiz starten" <?php if($active == 0) { echo disabled; } ?>>
        <form>
    </div>
    <footer>
        <p>Quiz by Lars Heinitz & Nicolas Fux</p>
    </footer>
    <?php
    header("Refresh:5");
        }
        if(isset($_POST['start'])) {
            // QUIZ STARTED
            setcookie("checkpoint", 1.0, 0, "/");
            header("Refresh:0");
        }
        // CREATE USER
        if(isset($_POST['user'])) {
            if($_POST['user'] != "") {
                $user = $_POST['user']." / ".$_POST['gender'];
                $userdatabase = fopen("users.txt", "a") or die("Unable to open file!"); 
                fwrite($userdatabase, $_POST['user']." ".PHP_EOL);
                fclose($userdatabase);
                setcookie("user", $user, 0, "/");
                $points = 0;
                setcookie("points", $points, 0, "/");
                setcookie("checkpoint", 2.1, 0, "/");
                header("Refresh:0");
            }
        }

        $checkpoint = explode(".", $_COOKIE['checkpoint'])[0];
        if($checkpoint == 1 && $_COOKIE['user'] == "") {
    ?>
        <header>
            <h1>Kurze Anmeldung</h1>
        </header>
        <form class="first-login" method="POST" >
            <label id="user">Name</label>
            <input type="text" autocomplete="off" name="user" required>
            <label id="gender">Geschlecht</label>
            <div class="select">
                <select name="gender" required>
                    <option value="" disabled selected>auswählen</option>
                    <option value="m">männlich</option>
                    <option value="f">weiblich</option>
                </select>
            </div>
            <div class="eula-container">
                <input type="checkbox" name="accepted" required>
                <label for="accepted"> Ich akzeptiere, das ganze Event mit Humor zu nehmen.</label>
            </div>
            <input type="submit" name="login" value="Bereit">
        </form>
    <?php

        }
        if($checkpoint == 2) {
        ?>

            <header>
                <h1>Was bedeutet die Abkürzung "ZEM" ?</h1>
            </header>

            <form class="q question-choose" method="POST">
                <div class="answer-container">
                    <fieldset>
                        <label for="answer">
                            <input type="radio" value="1" title="Zentrum elektronische Medien" name="answer">
                        </label>
                        <label for="answer">
                            <input type="radio" value="2" title="Zeigt erhobene Qualität" name="answer">
                        </label>
                        <label for="answer">
                            <input type="radio" value="3" title="Zunehmende Medienwelt" name="answer">
                        </label>
                        <label for="answer">
                            <input type="radio" value="4" title="Zeit ermöglicht Arbeit" name="answer">
                        </label>
                    </fieldset>
                </div>
                <input type="submit" name="Q1" value="Absenden">
            </form>

        <?php
            if(isset($_POST['Q1'])) {
                setcookie("checkpoint", 3.2, 0, "/");
                $q1 = $_POST['answer'];
                if($q1 == 1) {
                    $points = $_COOKIE['points'] + 10;
                    setcookie("points", $points, 0, "/");
                    header( "Location: ?t=y&c" );
                } else {
                    header( "Location: ?t=n&c" );
                }
            }
            
        } else if($checkpoint == 3 || $checkpoint == 5 || $checkpoint == 7 || $checkpoint == 9 || $checkpoint == 11 | $checkpoint == 13) {
        ?>
            <header>
                <h1><?php if($_GET['t'] == y) { echo "Richtig!"; } else { echo "Falsch!"; } ?></h1>
            </header>

        <?php
            $c1 = explode(".", $_COOKIE['checkpoint'])[0] +1;
            $c2 = explode(".", $_COOKIE['checkpoint'])[1];
            setcookie("checkpoint", $c1.".".$c2, 0, "/");
        } else if($checkpoint == 4) {
        ?>

            <header>
                <h1>Unser höchster Boss ist..?</h1>
            </header>

            <form class="q question" method="POST">
                <div class="answer-container">
                    <label>Deine Antwort</label>
                    <input type="text" name="answer" autocomplete="off">
                </div>
                <input type="submit" name="Q2" value="Absenden">
            </form>

        <?php

            if(isset($_POST['Q2'])) {
                setcookie("checkpoint", 5.3, 0, "/");
                $q2 = strtolower($_POST['answer']);
                if(strpos($q2,'amherd') == true || strpos($q2,'viola') == true || $q2 == "viola amherd" || $q2 == "viola" || $q2 == "amherd") {
                    $points = $_COOKIE['points'] + 10;
                    setcookie("points", $points, 0, "/");
                    header( "Location: ?t=y&c" );
                } else {
                    header( "Location: ?t=n&c" );
                }
            }

        } else if($checkpoint == 6) {
            ?>
            <header>
                <h1>Welche Farbe hatte Lars sein Pullover in unserem Video?</h1>
            </header>

            <form class="q question-choose-c" method="POST">
                <div class="answer-container">
                    <fieldset>
                        <label for="answer">
                            <input type="radio" value="1" name="answer">
                        </label>
                        <label for="answer">
                            <input type="radio" value="2" name="answer">
                        </label>
                        <label for="answer">
                            <input type="radio" value="3" name="answer">
                        </label>
                        <label for="answer">
                            <input type="radio" value="4" name="answer">
                        </label>
                    </fieldset>
                </div>
                <input type="submit" name="Q3" value="Absenden">
            </form>

            <?php

            if(isset($_POST['Q3'])) {
                setcookie("checkpoint", 7.4, 0, "/");
                $q3 = strtolower($_POST['answer']);
                if($q3 == 3) {
                    $points = $_COOKIE['points'] + 10;
                    setcookie("points", $points, 0, "/");
                    header( "Location: ?t=y&c" );
                } else {
                    header( "Location: ?t=n&c" );
                } 
            }
        } else if($checkpoint == 8) {
            ?>
    
                <header>
                    <h1>Wie lange ging unser Intro-Video?</h1>
                </header>
    
                <form class="q question" method="POST">
                    <div class="answer-container">
                        <label>Deine Antwort</label>
                        <input type="number" name="answer" autocomplete="off">
                    </div>
                    <input type="submit" name="Q4" value="Absenden">
                </form>
    
            <?php
    
                if(isset($_POST['Q4'])) {
                    setcookie("checkpoint", 9.5, 0, "/");
                    $q4 = $_POST['answer'];
                    if($q4 > 29 && $q4 < 36) {
                        $points = $_COOKIE['points'] + 10;
                        setcookie("points", $points, 0, "/");
                        header( "Location: ?t=y&c" );
                    } else {
                        header( "Location: ?t=n&c" );
                    }
                }

        } else if($checkpoint == 10) {
            ?>
            <header>
                <h1>Was gab es beim Filmen zu beachten?</h1>
            </header>

            <form class="q question-choose-img" method="POST">
                <div class="answer-container">
                    <fieldset>
                        <label for="answer">
                            <input type="radio" value="1" name="answer">
                            <img src="images/zem.jpg" alt="1">
                        </label>
                        <label for="answer">
                            <input type="radio" value="2" name="answer">
                            <img src="images/zem.jpg" alt="2">
                        </label>
                        <label for="answer">
                            <input type="radio" value="3"name="answer">
                            <img src="images/zem.jpg" alt="3">
                        </label>
                        <label for="answer">
                            <input type="radio" value="4" name="answer">
                            <img src="images/zem.jpg" alt="4">
                        </label>
                    </fieldset>
                </div>
                <input type="submit" name="Q5" value="Absenden">
            </form>

            <?php

            if(isset($_POST['Q5'])) {
                setcookie("checkpoint", 11.6, 0, "/");
                $q5 = strtolower($_POST['answer']);
                if($q5 == 4) {
                    $points = $_COOKIE['points'] + 10;
                    setcookie("points", $points, 0, "/");
                    header( "Location: ?t=y&c" );
                } else {
                    header( "Location: ?t=n&c" );
                } 
            }

        } else if($checkpoint == 12) {
            ?>

        <header>
            <h1>Wo müssen die Fotos erst vorbei, bevor sie auf die Mediathek kommen?</h1>
        </header>

        <form class="q question-choose" method="POST">
            <div class="answer-container">
                <fieldset>
                    <label for="answer">
                        <input type="radio" value="1" title="Informatiker" name="answer">
                    </label>
                    <label for="answer">
                        <input type="radio" value="2" title="Kontrolleur" name="answer">
                    </label>
                    <label for="answer">
                        <input type="radio" value="3" title="Redakteur" name="answer">
                    </label>
                    <label for="answer">
                        <input type="radio" value="4" title="Polygraf" name="answer">
                    </label>
                </fieldset>
            </div>
            <input type="submit" name="Q6" value="Absenden">
        </form>

    <?php
        if(isset($_POST['Q6'])) {
            setcookie("checkpoint", 13.7, 0, "/");
            $q6 = $_POST['answer'];
            if($q6 == 3) {
                $points = $_COOKIE['points'] + 10;
                setcookie("points", $points, 0, "/");
                header( "Location: ?t=y&c" );
            } else {
                header( "Location: ?t=n&c" );
            }
        }
        
    //SET END-CHECKPOINT
        } else if($checkpoint == 14) {
            $data = file('users.txt');
            $search = str_replace("+", " ", explode("/", $_COOKIE['user'])[0]);
            $pointsset = "(".$_COOKIE['points'].")/".str_replace("+", " ", explode("/", $_COOKIE['user'])[0])." ";
            $data = file_get_contents("users.txt");
            $newdata = str_replace($search, $pointsset, $data);
            file_put_contents("users.txt", $newdata);
            header ( "Location: end.php");
        }
    // PROFILE LINK
    if($checkpoint >= 2) {
        // auf Richtig- /-Falsch Seiten nicht anzeigen, ganz am Schluss noch einfügen
        echo "<a id='profile' href='profile.php'><img src='images/profile.svg' alt='Profil'></a>";
    }

    // RESPONSE TO USER AFTER ANSWER 
    if(isset($_GET['t'])) {
        $true = $_GET['t'];
        if($true == y) {
            if(isset($_GET['c'])) {
                echo "<p class='correctly'>Diese Antwort war richtig! Hervorragend.</p>";
                header( "refresh:3;url=index.php" );
            } else {
                echo "<p class='correctly'>Diese Antwort war richtig! Hervorragend.</p><p class='waiting'>Warte nun auf den nächsten QR-Code...</p>";
            }
        } else {
            if(isset($_GET['c'])) {
                echo "<p class='incorrect'>Diese Antwort war leider falsch! Viel Glück beim nächsten Mal.</p>";
                header( "refresh:3;url=index.php" );
            } else {
                echo "<p class='incorrect'>Diese Antwort war leider falsch! Viel Glück beim nächsten Mal.</p><p class='waiting'>Warte nun auf den nächsten QR-Code...</p>";
            }
        }
    }
    ?>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="script.js"></script>
</body>

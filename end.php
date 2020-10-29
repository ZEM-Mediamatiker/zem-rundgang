
<head>
    <title>ZEM - Quiz / Ende</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css?<?php echo date('l jS \of F Y h:i:s A'); ?>">
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <?php
        // users.txt --> Array --> sortieren und in txt. File ersetzen

        // Spieleranzahl setzen!
        $playercount = 1;

        $file="users.txt";
        $linecount = 0;
        $handle = fopen($file, "r");
        while(!feof($handle)){
        $line = fgets($handle);
        $linecount++;
        }
        fclose($handle);

        $linecount = $linecount -1;

        $settingss = fopen("settings.txt", "r") or die("Unable to open file!");
        $show = explode(": ",fread($settingss,31))[2];
        fclose($settingss);

        if($show != 1) {
            if($linecount >= $playercount) {
                $lines = file('users.txt');
                $activeuser = str_replace("+", " ", explode("/", $_COOKIE['user'])[0]);
                usort($lines, function ($a, $b){
                    $bminus = $b.length -2;
                    $aminus = $a.length -2;
                    return intval(substr($b, 1, -$bminus)) - intval(substr($a, 1, -$aminus));
                });
                foreach ($lines as $line_num => $line) {
                    $line_num++;
                    if(strstr($line, $activeuser)) {
                        $rank = $line_num;
                    }
                }
                ?>
                <header>
                    <h1>Gratuliere!</h1>
                </header>
                <div class="rank-display">
                    <p>Du bist mit sage <br/>und schreibe<br/><b><?php echo $_COOKIE['points']; ?> Punkten</b>auf dem <span id='__<?php echo $rank; ?>'><?php echo $rank; ?>.</span> Platz gelandet!</p>
                </div>
                <?php
                Header("Refresh:5");
            } else {
                ?>
                <header>
                    <h1>Warte auf die anderen Mitspieler...</h1>
                </header>
                <footer>
                    <p>Quiz by Lars Heinitz & Nicolas Fux</p>
                </footer>
                <?php
                Header("Refresh:3");
            }

        } else {
            ?>
                <header>
                    <h1>Rangliste</h1>
                </header>
                <div class="ranking-list">
            <?php
                $lines = file('users.txt');
                usort($lines, function ($a, $b){
                    $bminus = $b.length -2;
                    $aminus = $a.length -2;
                    return intval(substr($b, 1, -$bminus)) - intval(substr($a, 1, -$aminus));
                });
                // Loop through our array, show HTML source as HTML source; and line numbers too.
                foreach ($lines as $line_num => $line) {
                    $line_num++;
                    $points = str_replace("(", " ", str_replace(")", " ", explode("/", $line)[0]));
                    echo "<li value='$line_num'>".explode("/",$line)[1]."<span>".$points." Punkte</span></li><br />";
                }
                ?>
                </div>
                <footer class="end-footer">
                    <p>Merci hesch mitgmacht!</p>
                    <img src="images/confetti2.svg" alt="confetti">
                </footer>
                <?php
        }
    ?>
</body>

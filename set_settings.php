
<?php
    $active = $_POST['active'];
    if($active != "") {
        if($active == 1) {
            $olda = "enabled: 0";
        } else if($active == 0) {
            $olda = "enabled: 1";
        }
        $dataa = file_get_contents("settings.txt");
        $newdataa = str_replace($olda, "enabled: ".$active, $dataa);
        file_put_contents("settings.txt", $newdataa);
    } else {
        $show = $_POST['show'];
        if($show == 1) {
            $olds = "show_stats: 0";
        } else if($show == 0) {
            $olds = "show_stats: 1";
        }
        $datas = file_get_contents("settings.txt");
        $newdatas = str_replace($olds, "show_stats: ".$show, $datas);
        file_put_contents("settings.txt", $newdatas);
    }
?>
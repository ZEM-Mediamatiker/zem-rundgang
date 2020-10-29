
<?php
    $active = $_POST['active'];
    if($active != "") {
        if($active == "true") {
            $olda = "enabled: false";
        } else if($active == "false") {
            $olda = "enabled: true";
        }
        $dataa = file_get_contents("settings.txt");
        $newdataa = str_replace($olda, "enabled: ".$active, $dataa);
        file_put_contents("settings.txt", $newdataa);
    } else {
        $show = $_POST['show'];
        if($show == "true") {
            $olds = "show_stats: false";
        } else if($show == "false") {
            $olds = "show_stats: true";
        }
        $datas = file_get_contents("settings.txt");
        $newdatas = str_replace($olds, "show_stats: ".$show, $datas);
        file_put_contents("settings.txt", $newdatas);
    }
?>

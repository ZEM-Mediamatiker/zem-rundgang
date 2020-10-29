
$(document).ready(function() {
    $(".question-choose input[type='radio']").change(function() {
        $("input[type='radio']").css("background-color", "#fff");
        $("input[type='radio']").css("color", "#043C6D");
        $(this).css("background-color", "#043C6D");
        $(this).css("color", "#fff");
    });

    $(".question-choose-img img").click(function() {
        $(this).parent().find("input").prop('checked', true);
    });
    
    $(".setting .switch input:checked").parent().parent().find("p").css("color", "#043C6D");
    $(".setting .switch .slider").click(function() {
            $(this).parent().parent().find("p").css("color", "#043C6D");
            if($(this).parent().find("input").attr("name") == "active") {
                $.post( 
                    'set_settings.php', // script location
                    { active: "true" }, // data to send
                );
            }
            if($(this).parent().find("input").attr("name") == "stats") {
                $.post( 
                    'set_settings.php',
                    { show: "true" },
                );
            }
            if($(this).parent().find("input").is(":checked")) {
                $(this).parent().parent().find("p").css("color", "rgba(4, 60, 109, 0.4)");
                if($(this).parent().find("input").attr("name") == "active") {
                    $.post( 
                        'set_settings.php',
                        { active: "false" }
                    );
                }
                if($(this).parent().find("input").attr("name") == "stats") {
                    $.post( 
                        'set_settings.php',
                        { show: "false" },
                    );
                }
            }
    });
});

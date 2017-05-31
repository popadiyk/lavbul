function parallax() {
    $(".parallax-1").css("background-position-x", event.clientX*0.03 - 150 +"px");
    $(".parallax-2").css("background-position-x", event.clientX*0.05 - 150 +"px");
    $(".parallax-3").css("background-position-x", event.clientX*0.08 - 200 +"px");
}


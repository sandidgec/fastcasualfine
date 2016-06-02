$(document).ready(function() {
    $('#myCarousel').carousel({
        interval: 0
    })

    $('#myCarousel').on('slid.bs.carousel', function() {
        //alert("slid");
    });


});

$(document).ready(function() {
    $('#myother').carousel({
        interval: 0
    })

    $('#myother').on('slid.bs.carousel', function() {
        //alert("slid");
    });


});


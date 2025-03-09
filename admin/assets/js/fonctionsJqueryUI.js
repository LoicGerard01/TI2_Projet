$(document).ready(function() {
  /*
    $('h2').css('color', 'lime');
    $('h2').css('font-size', '2em');
    $('h2').css('text-align', 'center');
    $('h2').css('font-family', 'Comic Sans MS');
    $(div1).css('color', 'red');
    $(div1).css('font-size', '1.5em');
    $(p1).css('text-align', 'center');
    $(p1).css('font-family', 'Times New Roman');

    $('#p1').hide();
    $('#div1').hide();

    $('#cliquer').click(function() {
        $(this).css({
            'color' : 'cyan',
            'fontweight' : 'bold',
            'font-size' : '200%',
        })
        $('#p1').toggle();
        $('#div1').fadeIn(4000);

        $('#p1').mouseover(function() {
            $(this).css('background-color', 'magenta');
        });

        // selecteur de date
        $('#datepicker').datepicker();
    });

    $('#tirer').click(function() {
        $('#menu').toggle('slide');
    });
*/
    $('#vie').hide(); // Cache #vie au chargement

    $('#troisieme').hide();
    $('#quatrieme').hide();
    $('#cinquieme').hide();


    $('.nom').click(function() {
        $(this).css('color', 'red'); // Change la couleur en rouge au clic
        $('#vie').fadeIn(2000); // Affiche #vie en 2 second
    });

    $('#cacher').click(function() {
        $('#montrer_image').toggle(); // Affiche/cache l'image au clic
    });

    $('#deuxieme').mouseover(function() {
        $(this).css({
            'color': 'blue',
            'font-style': 'italic',
            'font-weight': 'bold',
        });
    });

    $('#deuxieme').mouseleave(function() {
        $('#troisieme').fadeIn(2000);
        $('#para3').fadeIn(2000);

    });

    $('#troisieme').click(function() {
        $('#para4').fadeIn(2000);
    });

    $('#para3').click(function() {
        $('#quatrieme').fadeIn(2000);
    });

    $('#para4').click(function() {
        $('#cinquieme').fadeIn(2000);
    });

});

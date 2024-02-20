jQuery(document).ready(function($) {
    
    $.get('/wp-content/plugins/wp-custom-plugin/modals/modal-template.handlebars', function(data) {
        var template = Handlebars.compile(data);
        $('body').append(template());
    });

    
    $('.custom-button').on('click', function() {
        $('#custom-modal').show();
	$(this).hide();
    });

    
    $('body').on('click', '.close', function() {
        $('#custom-modal').hide();
	$('.custom-button').show();
    });

    $('#custom-form').submit(function(e) {
        e.preventDefault();
        var name = $('#name').val();
        // Vérifiez si le champ ne contient pas de chiffres
        if (/^[a-zA-Z\s\-çàéèêëîïôöûüùÇÀÉÈÊËÎÏÔÖÛÜÙ]+$/.test(name) && !/\d/.test(name)) { 
            $.ajax({
                // Configuration AJAX...
                success: function(response) {
                    $('#custom-modal').hide();
                    alert('Formulaire soumis avec succès');
                    location.reload(); 
                }
            });
        } else {
            alert('Veuillez saisir un nom valide sans chiffres.');
        }
    });
});

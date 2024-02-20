jQuery(document).ready(function($) {
    
    $.get('/wp-content/plugins/wp-custom-plugin/modals/modal-template.handlebars', function(data) {
        var template = Handlebars.compile(data);
        var html = template();
        $('body').append(html);
    });

    
    $('.custom-button').on('click', function() {
        $('#custom-modal').show();
    });

    
    $('.close').on('click', function() {
        $('#custom-modal').hide();
    });

    
    $('#custom-form').submit(function(e) {
        e.preventDefault();
        var name = $('#name').val();
        $.ajax({
            type: 'POST',
            url: ajax_object.ajax_url, 
            data: {
                action: 'handle_custom_form_submission',
                name: name
            },
            success: function(response) {
                $('#custom-modal').hide(); 
                alert('Formulaire soumis avec succès');
            }
        });
    });
});

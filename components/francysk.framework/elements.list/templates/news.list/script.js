$(document).ready(function() {
    $(document).on('change', 'select.jsHrefAction', function() {
        var val = $(this).val();
        
        var url = $('option[value="'+val+'"]').attr('data-href');
        
        location.href = url;
    })
})
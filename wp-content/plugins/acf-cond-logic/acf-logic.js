jQuery(function ($) {

    var publicName = '#acf-field-public_contact';
    var $public = $(publicName);
    var publicArr = ['#acf-contact_role', '#acf-contact_email', '#acf-secondary_contact_role', '#acf-secondary_contact_email', '#acf-third_contact_role', '#acf-third_contact_email'];

    function checkIt(){
        var val = $public.find('option:selected').val();
        if ( val == 'yes' ) {
            return true;
        } else {
            return false;
        }
    }

    $(document).on('change', publicName, function () {
        publicArr.forEach(function(i){
            if ( checkIt() ) {
                $(i).addClass('show-acf');
            } else {
                $(i).removeClass('show-acf');
            }
        });
    });

    publicArr.forEach(function(i){
        $('head').append('<style>'+i+'{display:none;}</style>');
    });

    $public.trigger('change');

});
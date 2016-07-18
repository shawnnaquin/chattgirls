<?php

function my_acf_admin_head() {
    ?>
    <style type="text/css">

        .show-acf {
            display:block!important;
            opacity:0;
            animation-name:show;
            animation-duration:300ms;
            animation-fill-mode:forwards;
            animation-timing-function: ease;
            animation-iteration-count: 1;
        }

        @keyframes show {
            100% {opacity:1;}
        }
    }

    </style>

    <script type="text/javascript">
        // var publicArray = ['#acf-contact_role', '#acf-contact_email'];

        // var showClass = 'show-acf';

        // function checked($this) {

        //     // publicArray.forEac
        //     // (function(i){
        //     //     if ( $this.attr('checked') == 'checked' ) {
        //     //         $(i).addClass(showClass);
        //     //     } else {
        //     //         $(i).removeClass(showClass);
        //     //     }
        //     // });
        // }

        (function($){
            console.log('hey');
            var publicName = '#acf-field-public_contact';
            var $public = $(publicName);
            console.log( $public );

        })(jQuery);

    </script>

    <?php
}

add_action('acf/field_group/admin_head', 'my_acf_admin_head');

?>

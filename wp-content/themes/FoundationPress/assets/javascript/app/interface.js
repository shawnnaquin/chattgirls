(function($) {

    App.utils.determineSize = function(event, newSize, oldSize ) {

        (function mobile() {
            var winOrient = window.orientation || window.mozOrientation || window.msOrientation,
            screenOrient =  window.screen.orientation || window.screen.mozOrientation || window.screen.msOrientation;

            function screenWidth() {
                if (window.screen.width <= 1080) {
                    return true;
                } else {
                    return false;
                }
            }

            function isMobile() {
                var mobile;

                if ( winOrient && screenWidth() ) {
                    mobile = true;
                } else if ( !winOrient && screenOrient && screenWidth() ) {
                    mobile = true;
                } else if ( screenWidth() ) {
                    mobile = true;
                } else {
                    mobile = false;
                }
                return mobile;
            }

            function portrait() {

                var portrait = true;

                if ( $(document).width() >= $(document).height() ) {
                    portrait = false;
                }
                return portrait;
            }

            if ( isMobile() && portrait() ) {

                App.main.settings.mobile = true;
                App.main.settings.portrait = true;
                App.main.settings.landscape = false;

                $('html')
                    .addClass('mobile portrait')
                    .removeClass('landscape');


            } else if ( isMobile() && !portrait() ) {

                App.main.settings.mobile = true;
                App.main.settings.portrait = false;
                App.main.settings.landscape = true;

                $('html')
                    .addClass('mobile landscape')
                    .removeClass('portrait');

            } else {

                App.main.settings.mobile = false;
                App.main.settings.portrait = false;
                App.main.settings.landscape = false;

                $('html')
                    .removeClass('mobile landscape portrait');

            }

            // console.log('mobile: '+App.main.settings.mobile);
            // console.log('portrait: '+App.main.settings.portrait);
            // console.log('landscape: '+App.main.settings.landscape);

            destroySize();

        })();

        function destroySize() {

            if(typeof oldSize !== 'undefined') {

                switch(oldSize) {
                    case 'small':
                        App.small.destroy();
                        break;
                    case 'medium':
                        App.medium.destroy();
                        break;
                    case 'large':
                        if ( newSize == 'medium') {
                            App.large.destroy();
                        }
                }
            }
            initSize();
        }

        function initSize() {
            switch(newSize) {
                case 'small':
                    App.small.init();
                    break;
                case 'medium':
                    App.medium.init();
                    break;
                default:
                    App.large.init();
            }

            if(typeof event === 'undefined' ) {
                $(window).on('changed.zf.mediaquery', App.utils.determineSize );
            }
        }

    };

    App.utils.smoothState = function() {

        App.main.settings.smoothState = $('#smoothstate').smoothState({
            prefetch: true,
            cacheLength: 2,
            onStart: {
                duration: 300,
                render: function ($container) {
                    console.log('out');

                    TweenMax.to( $('section.container'), 0.3, {
                        opacity:0
                    });

                    App.main.settings.smoothState.restartCSSAnimations();
                    // reinit
                    App.main.destroy();
                }
            },
            onReady: {
                duration: 300,

                render: function ($container, $newContent) {
                    console.log('in');
                    //fetch
                    $container.html( $newContent );

                    TweenMax.to( $('section.container'), 0.3, {
                        opacity:1
                    });

                    // reinit
                    App.main.settings.PAGE = $('#body').attr('data-page');
                    App.main.init();

                    // ok go!
                    $container.removeClass('out');
                }
            },

            blacklist: '.js-slide'

        }).data('smoothState');

    };

    $(document).foundation();

    App.main.settings.PAGE = $('#body').attr('data-page');
    App.main.init();
    App.utils.determineSize(undefined, Foundation.MediaQuery.current, undefined);
    App.utils.smoothState();

})(jQuery);
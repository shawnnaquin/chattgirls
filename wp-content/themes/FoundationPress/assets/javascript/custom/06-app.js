(function ($, window, document, undefined) {

    window.App = {};

    App.utils = {};

    /** loader
    ------------------------------------------------------------------------------------------------------------------*/

    // initialize the page loader
    App.utils.loader = function($loader){
        NProgress
            .configure({
                showSpinner: false,
                trickleRate: 0.035,
                trickleSpeed: 1000,
                template: $loader.html(),
            })
            .start();

        // utils.load_images();
        App.utils.progress($loader);
    };

    // recurse until all the things are loaded
    App.utils.progress = function($loader){
        // console.log('loader');
        NProgress.inc();
        if($.active > 0){
            setTimeout(App.utils.progress, 300);
        }
        else {
            
              $($loader).delay(800).animate({'opacity':'0'}, 300, function(){
                NProgress.done();
                $($loader).remove();
                setTimeout(App.utils.sharrre(), 1200);
              });   
        }
    };

    App.utils.sharrre = function() {
        var theHref = $('.js-sharrre').attr('data-href');
        var theText = $('.js-sharrre').attr('data-text');

        $('.js-facebook').each(function(i){

            $(this).sharrre({
                share: {
                    facebook: true,
                    twitter:true,
                },

                buttons: {
                    // facebook reallly has no options :( 
                    facebook: {
                        layout: 'button',
                        url: theHref,
                        text: theText,
                    },
                },

                template: '<a class="social-icon-a js-facebook-a" href="#"></a>',

                enableHover: false,
                enableTracking: true,

                render: function(api, options){

                    $(api.element).on('click', '.js-facebook-a', function() {
                        api.openPopup('facebook');
                    });

                    $('.js-facebook .js-facebook-a').load( '././wp-content/uploads/svg/icons/social/facebook.svg' ); //load svg string
                }
            });

        });

        $('.js-pinterest').each(function(i){

            $(this).sharrre({
                share: {
                   pinterest:true,
                },

                buttons: {
                   pinterest: {
                        // url: theHref,
                        // text: theText,
                    },
                },

                template: '<a class="social-icon-a js-pinterest-a" href="#"></a>',

                enableHover: false,
                enableTracking: true,

                render: function(api, options){

                    $(api.element).on('click', '.js-pinterest-a', function() {
                        api.openPopup('pinterest');
                    });

                    $('.js-pinterest .js-pinterest-a').load( '././wp-content/uploads/svg/icons/social/pinterest.svg' ); //load svg string
                }
            });

        });

        $('.js-twitter').each(function(i){

            $(this).sharrre({
                share: {
                    twitter:true,
                },

                buttons: {
                    twitter: {
                        // url: theHref,
                        // text: theText,
                    },
                },

                template: '<a class="social-icon-a js-twitter-a" href="#"></a>',

                enableHover: false,
                enableTracking: true,

                render: function(api, options){

                    $(api.element).on('click', '.js-twitter-a', function() {
                        api.openPopup('twitter');
                    });

                    $('.js-twitter .js-twitter-a').load( '././wp-content/uploads/svg/icons/social/twitter.svg' ); //load svg string
                }
            });

        });


    };


    // /** mobile menu
    // ------------------------------------------------------------------------------------------------------------------*/
    // App.utils.toggle_nav = {
    //     init: function($element){
    //         $element.on('click.small', function(){

    //         });
    //     },

    //     destroy: function($element){
    //         $element.off('click.small');
    //     }
    // };

    /* end utils
    ----------------------------------------------------------------------------------------------------------------------*/

    App.main = (function () {

        var elements = {
            $win    : $(window),
            $doc    : $(document),
            $body   : $('body'),
            $loader : $('.js-page-loader-wrapper'),
            equalizer: '',
        };

        var sizes = {
            sm : false,
            md: false,
            lg: false
        };

        var colors = {
            $primary    : '#030f19',
            $secondary  : '#003e7e',
            $success    : '#3adb76',
            $warning    : '#ffae00',
            $alert      : '#ec5840',
            $lightGray  : '#e6e6e6',
            $mediumGray : '#bec0c2',
            $darkGray   : '#8a8a8a',
            $black      : '#0a0a0a',
            $white      : '#fefefe',
        };

        var settings = {
            PAGE : $('body').attr('class').split(' ')[0],
        };

        var pages = {

            all: {
                init: function(){
                    console.log('main');

                    if ( $('.js-sharrre').length){
                    }
                    
                    $(window).on('scroll', function(){
                        if ( $('body').scrollTop() >= 104 ) {
                            $('#site-navigation').css({'position':'fixed'});
                        } else {
                            $('#site-navigation').removeAttr('style');
                        }
                    });

                }
            },
            home: {
                init: function(){
                    $('.your-class li img').unwrap();

                    $('.slick').slick({
                        infinite: true,
                        autoplay: true,
                        autoplaySpeed: 6000,
                    });

                    $('.slick').on('swipe', function(event, slick, direction){

                        if ( direction == 'right') {
                            slickNextIt();
                            // console.log('right');
                        }
                        else {
                            slickPrevIt();
                        }
                    });

                    $('.slick').on('keydown', function(e) {
                        // does not work w/o 2nd conditional
                        if (e.which == 37) {
                            slickNextIt();
                        }

                        else if (e.which == 39) {
                            slickPrevIt();
                        }

                    });

                    $('.slick-prev')
                        .html('<i class="fa fa-arrow-circle-o-left"></i>');
                    $('.slick-next')
                        .html('<i class="fa fa-arrow-circle-o-right"></i>');

                    function slickNextIt() {
                        $('.slick-prev')
                            .css({
                                'color':App.main.colors.$secondary,
                                'text-shadow':'2px 2px 10px rgba(250,250,250,.8)'
                            });
                        setTimeout(function(){
                            $('.slick-prev').removeAttr('style');
                        }, 300);
                    }

                    function slickPrevIt() {
                        // console.log('next');
                        $('.slick-next')
                            .css({
                                'color':App.main.colors.$secondary,
                                'text-shadow':'2px 2px 10px rgba(250,250,250,.8)'
                            });
                        setTimeout(function(){
                            $('.slick-next').removeAttr('style');
                        }, 300);

                    }
                    $(window).on('resize', function() {
                        setTimeout(function(){
                            if ( $('.js-add-equalizer').attr('data-equalizer') ) {
                                  $('.js-add-equalizer').foundation('applyHeight');
                            }
                        }, 100);
                    });

                    // this needs to be at the bottom of this function
                    App.utils.loader(elements.$loader);
                },
            },

            contact: {
                init: function(){
                },
                destroy: function(){

                }
            },

            singular: {
                init: function(){
                    
                    if ( $('body').hasClass('page-template-skaters') ) {
                        jsHeight();
                        magnificPopup();
                    }

                    $(window).on('resize', function(){
                        setTimeout(function(){
                            if ( $('body').hasClass('page-template-skaters') ) {
                                jsHeight();
                            }
                        }, 100);
                    });

                    function jsHeight() {
                        
                        var theHeight = $('.js-height').width()-120;
                        var fadeTime;
                        
                        $('.js-height').each(function(i){
                            fadeTime = String(100 * i);
                            $(this)
                                .css({
                                    'opacity':'1',
                                    'height': theHeight,
                                    'transition-delay': fadeTime+'ms',
                                });
                        });
                        
                        $('.js-height:nth-last-child(1)')
                            .addClass('end');
                    }

                    function magnificPopup(){
                        $('.popup').magnificPopup({
                            type: 'inline',

                            fixedContentPos: false,
                            fixedBgPos: true,

                            overflowY: 'auto',

                            closeBtnInside: true,
                            preloader: false,
                            
                            midClick: true,
                            removalDelay: 300,
                            mainClass: 'slide-bottom',
                            callbacks: {
                              open: function() {

                              },
                              close: function() {
                                // Will fire when popup is closed
                              }
                            },
                        });
                    }
                },
                destroy: function(){

                }
            }
        };

        function init(){

            // initialize foundation first
            // $(document).foundation();
            console.log('init');
            // load specific page events/plugin initialization
            if(settings.PAGE && pages.hasOwnProperty(settings.PAGE)){
                pages[settings.PAGE].init();
            }

            // leave at the bottom
            pages.all.init();
        }

        // Reveal public methods and global elements, settings
        return {
            elements : elements,
            settings : settings,
            colors: colors,
            init : init,
            sizes : sizes,
        };
    }());

    App.large = (function () {

        var elements = {};

        var settings = {
            PAGE : App.main.settings.PAGE,
        };

        var pages = {
            all: {
                init: function(){

                },
                destroy: function(){

                },
            },
            home: {
                init: function(){
                    console.log('home init large');
                    $('.js-add-equalizer')
                        .attr('data-equalizer', 'page');

                    $('.js-add-equalizer-watch')
                        .removeClass('js-add-equalizer-watch')
                        .attr('data-equalizer-watch', 'page');

                    App.main.equalizer = new Foundation.Equalizer( $('.js-add-equalizer') );     
                },
                destroy: function(){
                },
            }
        };

        // Reveal public methods
        return {
            init : function() {
                if(settings.PAGE && pages.hasOwnProperty(settings.PAGE)){
                    pages[settings.PAGE].init();
                }

                // leave at the bottom
                pages.all.init();
            },
            destroy : function() {
                if(settings.PAGE && pages.hasOwnProperty(settings.PAGE)){
                    pages[settings.PAGE].destroy();
                }

                // leave at the bottom
                pages.all.destroy();
            },
        };
    }());
    App.medium = (function () {

        var elements = {};

        var settings = {
            PAGE : App.main.settings.PAGE,
        };

        var pages = {
            all: {
                init: function(){
                    console.log('medium');
                },
                destroy: function(){

                },
            },
            home: {
                init: function(){
                    if ( $('.js-add-equalizer').attr('data-equalizer') ) {
                        $('.js-add-equalizer').foundation('destroy');
                    }
                },
                destroy: function(){

                }
            }
        };

        // Reveal public methods
        return {
            init : function() {
                if(settings.PAGE && pages.hasOwnProperty(settings.PAGE)){
                    pages[settings.PAGE].init();
                }

                // leave at the bottom
                pages.all.init();
            },
            destroy : function() {
                if(settings.PAGE && pages.hasOwnProperty(settings.PAGE)){
                    pages[settings.PAGE].destroy();
                }

                // leave at the bottom
                pages.all.destroy();
            },
        };
    }());

    App.small = (function () {

        var elements = {};

        var settings = {
            PAGE : App.main.settings.PAGE,
        };

        var pages = {
            all: {
                init: function(){
                    // App.utils.toggle_nav.init();
                    console.log('small');
                },
                destroy: function(){
                    // App.utils.toggle_nav.destroy();
                },
            }
        };

        // Reveal public methods
        return {
            init : function() {
                if(settings.PAGE && pages.hasOwnProperty(settings.PAGE)){
                    pages[settings.PAGE].init();
                }

                // leave at the bottom
                pages.all.init();
            },

            destroy : function() {
                if(settings.PAGE && pages.hasOwnProperty(settings.PAGE)){
                    pages[settings.PAGE].destroy();
                }

                // leave at the bottom
                pages.all.destroy();
            },
        };
    }());

    // BELOW CODE IS THE BIG BANG; it kicks the tires and lights the fires.
    App.main.init();
    
    determineSize(undefined, Foundation.MediaQuery.current, undefined);

    function determineSize(event, newSize, oldSize) {
        
        switch(newSize) {
            case 'small':
                App.small.init();
                App.main.sizes.sm = true;
                // console.log('sm: true');
                break;
            case 'medium':
                App.medium.init();
                App.main.sizes.md = true;
                // console.log('md: true');
                break;
            case 'large':
                App.large.init();
                App.main.sizes.lg = true;
                // console.log('lg: true');
                break;
            case 'xlarge':
                    App.large.init();
                    App.main.sizes.lg = true;
                break;
            case 'xxlarge':
                    App.large.init();
                    App.main.sizes.lg = true;
                break;
        }

        if(typeof oldSize !== 'undefined') {
            switch(oldSize) {
                case 'small':
                    App.small.destroy();
                    App.main.sizes.sm = false;
                    // console.log('sm: false');
                    break;
                case 'medium':
                    App.medium.destroy();
                    App.main.sizes.md = false;
                    // console.log('md: false');
                    break;
                case 'large':
                    App.large.destroy();
                    App.main.sizes.lg = false;
                    // console.log('lg: false');
                    break;
                case 'xlarge':
                        App.large.destroy();
                    break;
                case 'xxlarge':
                        App.large.destroy();
                    break;
            }
        }

        if(typeof event === 'undefined') {
            $(window).on('changed.zf.mediaquery', determineSize);
        }

    }

}(jQuery, this, this.document));
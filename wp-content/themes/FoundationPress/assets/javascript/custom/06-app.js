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
            
              $($loader).delay(300).animate({'opacity':'0'}, 300, function(){
                NProgress.done();
              });   
        }
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
                    
                    // console.log(Foundation.MediaQuery.current);
                }
            },
            home: {
                init: function(){
                    $('.your-class li img').unwrap();

                    $('.slick').slick();

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
                    
                    // this needs to be at the bottom of this function
                    App.utils.loader(elements.$loader);
                },
            },
            contact: {
                init: function(){
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
                    console.log('large');
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
    
    App.main.init();

    var nS = Foundation.MediaQuery.current;
    var oS = null;

    determineSize(nS,oS);

    $(window).on('changed.zf.mediaquery', function(event, newSize, oldSize){
        determineSize(newSize, oldSize);
    });

    function determineSize(newSize, oldSize) {
        if (newSize == 'small') {
            App.small.init();
        }
        else if (newSize == 'medium') {
            App.medium.init();
        }
        else if (newSize == 'large') {
            App.large.init();
        }

        if (oldSize == 'small') {
            App.small.destroy();
        }
        else if (oldSize == 'medium') {
            App.medium.destroy();
        }
        else if (oldSize == 'large') {
            App.large.destroy();
        }
    }

}(jQuery, this, this.document));
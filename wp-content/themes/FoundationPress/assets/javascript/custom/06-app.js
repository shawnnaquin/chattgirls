(function ($, window, document, undefined) {

    window.App = {};

    App.utils = {};

    /** loader
    ------------------------------------------------------------------------------------------------------------------*/

    // initialize the page loader
    // App.utils.loader = function($loader){

    //     NProgress
    //         .configure({
    //             showSpinner: false,
    //             trickleRate: 0.035,
    //             trickleSpeed: 1000,
    //             template: $loader.html(),
    //         })
    //         .start();

    //     // utils.load_images();
    //     App.utils.progress();
    // };

    // // recurse until all the things are loaded
    // App.utils.progress = function(){
    //     NProgress.inc();
    //     if($.active > 0){
    //         setTimeout(App.utils.progress, 300);
    //     } else {
    //         NProgress.done();
    //     }
    // };

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

        var settings = {
            PAGE : elements.$body.attr('data-page'),
        };

        var pages = {

            all: {
                init: function(){
                    // console.log('main');
                    console.log(Foundation.MediaQuery.current);
                    // this needs to be at the bottom of this function
                    // App.utils.loader(elements.$loader);
                }
            },
            home: {
                init: function(){

                    $('.your-class li img').unwrap();

                    $('.your-class').slick();
                }
            },
            contact: {
                init: function(){
                }
            }
        };

        function init(){

            // initialize foundation first
            // $(document).foundation();

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
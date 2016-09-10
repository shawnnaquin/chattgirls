(function ($, window, document, undefined) {

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

                init: function() {
                    if ( App.main.settings.mobile ) {

                        var opt = App.main.settings.slickOptions;
                        opt.centerMode = false;
                        opt.slidesToShow = 2;
                        opt.slidesToScroll = 1;
                        opt.initialSlide = 0;
                        // console.log(opt);

                    } else {
                        console.log('!');
                    }

                    console.log('home large init');

                },

                destroy: function() {
                },

            }
        };

        // Reveal public methods
        return {
            init : function() {
                // console.log('init large');
                if( App.main.settings.PAGE && pages.hasOwnProperty(App.main.settings.PAGE) ){
                    pages[App.main.settings.PAGE].init();
                    // console.log(App.main.settings.large);
                }
                // leave at the bottom
                pages.all.init();

            },

            destroy : function() {
                // console.log('destroy large');
                if( App.main.settings.PAGE && pages.hasOwnProperty(App.main.settings.PAGE) ){
                    pages[App.main.settings.PAGE].destroy();
                    App.main.settings.large = false;
                    // console.log(App.main.settings.large);
                }

                // leave at the bottom
                pages.all.destroy();

            },
        };
    }());

}(jQuery, this, this.document));
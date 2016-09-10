(function ($, window, document, undefined) {

    App.medium = (function () {

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

                init:function() {
                    var opt = App.main.settings.slickOptions;

                    if ( App.main.settings.mobile ) {

                    } else {

                    }

                    console.log('home medium init');

                },

                destroy: function() {
                    console.log('home medium destroy');
                },

            }
        };

        // Reveal public methods
        return {
            init : function() {
                // console.log('init medium');
                if(App.main.settings.PAGE && pages.hasOwnProperty(App.main.settings.PAGE)){
                    pages[App.main.settings.PAGE].init();
                }

                // leave at the bottom
                pages.all.init();
            },
            destroy : function() {
                // console.log('destroy medium');
                if(App.main.settings.PAGE && pages.hasOwnProperty(App.main.settings.PAGE)){
                    pages[App.main.settings.PAGE].destroy();
                }

                // leave at the bottom
                pages.all.destroy();
            },
        };
    }());

}(jQuery, this, this.document));
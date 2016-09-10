(function ($, window, document, undefined) {

    App.small = (function () {

        var elements = {
        };

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
            'home-page': {

                init:function() {

                    var $sidebar = App.main.elements.$sidebar;
                    var target = '.js-front-wrapper';
                    $sidebar.appendTo(target);

                    var opt = App.main.settings.slickOptions;
                    opt.centerMode = false;
                    opt.slidesToShow = 1;
                    opt.slidesToScroll = 1;
                    opt.initialSlide = 2;

                    console.log('home small init');

                },

                destroy: function() {
                    var $sidebar = App.main.elements.$sidebar;
                    $sidebar.prependTo('.js-front-wrapper');
                },

            }

        };

        // Reveal public methods
        return {
            init : function() {
                // console.log('init small');
                if(App.main.settings.PAGE && pages.hasOwnProperty(App.main.settings.PAGE)){
                    pages[App.main.settings.PAGE].init();
                }

                // leave at the bottom
                pages.all.init();
            },

            destroy : function() {
                // console.log('destroy small');
                if(App.main.settings.PAGE && pages.hasOwnProperty(App.main.settings.PAGE)){
                    pages[App.main.settings.PAGE].destroy();
                }

                // leave at the bottom
                pages.all.destroy();
            },
        };
    }());

}(jQuery, this, this.document));
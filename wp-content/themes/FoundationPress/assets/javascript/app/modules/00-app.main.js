(function ($, window, document, undefined) {

    App.main = (function () {

        var elements = {
            $win        : $(window),
            $doc        : $(document),
            $body       : $('body'),
            $toggle     : $('.js-toggle-nav'),
            $loader     : $('.js-page-loader-wrapper'),
            $fullscreen : $('.js-fullscreen'),
            $sidebar    : $('.js-sidebar'),
            $body       : $('#body'),
            equalizer   : '',

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

        var sizes = {
            sm : false,
            md: false,
            lg: false
        };

        var settings = {
            PAGE                : '',
            smoothState         : '',
            ieVer               : null,
            speed               : 0.3,
            debounce            : 50,
            mobile              : null,
            portrait            : null,
            landscape           : null,
            fade                : false,

            slickOptions        : {
                                    accessibility: true,
                                    slidesToShow: 1,
                                    slidesToScroll: 1,
                                    centerMode: false,
                                    infinite: false,
                                    dots: true,
                                    arrows: false,
                                    initialSlide: 2,
                                    lazyLoad: true,
                                    mobileFirst: true,
                                    // responsive breakpoints conflict with destroy,
                                    // add options through main / small / large controller
                                    // responsive: [
                                    //     {
                                    //         breakpoint: 641,
                                    //         settings: {
                                    //             centerMode:true,
                                    //         }
                                    //     },
                                    //     {
                                    //         breakpoint: 1023,
                                    //         settings: {
                                    //             centerMode: false,
                                    //             slidesToShow: 4,
                                    //             slidesToScroll: 1,
                                    //         }
                                    //     },
                                    // ],
                                },
        };

        var pages = {

            all: {
                init: function(){

                    var $sidebar = App.main.elements.$sidebar;
                    var sidebarPos, sidebarHeight;

                    //replace zipcodes in cities.
                    $('.js-city').each(function(i){
                        var newText = $(this).html().replace(/\d+/g, '');
                        $(this).html('').html(newText);
                    });

                    $(document).on('click', '.js-noclick', function(e){
                        e.preventDefault();
                    });

                    App.utils.interiorSideBarHeight.init();

                    setTimeout(function(){
                        $(window).trigger('resize');
                    }, 300);

                    // this needs to be at the bottom of this function
                    App.utils.loader(elements.$loader);
                },
                destroy: function() {

                }
            },

            'home-page': {
                init:function() {
                    App.utils.slick.init();
                    // this needs to be at the bottom of this function
                    App.utils.loader(elements.$loader);

                    // console.log('home main init');
                },
                destroy: function() {
                    // console.log('home main destroy');
                }
            },

            personnel: {
                init: function() {
                    // height
                    App.utils.jsHeight();

                    $(window).on('resize', function(){
                        setTimeout(function(){
                                App.utils.jsHeight();
                        }, 100);
                    });
                },
                destroy: function() {
                }
            },

            skaters: {
                init: function(){


                    // height
                    App.utils.jsHeight();

                    $(window).on('resize', function(){
                        setTimeout(function(){
                                App.utils.jsHeight();
                        }, 100);
                    });

                    function wrapperHeight() {
                        setTimeout(function(){
                            var padding  = parseFloat( $('.featured-skater-widget').css('padding') )*2;
                            var height   = $('.mfp-ready').find('.featured-skater-info').outerHeight(true);
                            var wrapperHeight = String( padding + height ) + 'px';
                            $('.mfp-ready').find('.featured-skater-widget-wrapper')
                                .css({
                                    'height': wrapperHeight,
                                    'opacity':'1'
                                });
                        }, 300);
                    }

                    // setup Magnific
                    var $popup = $('.popup'),
                    popupSeperator = 'popup-',
                    recordHistory = true,
                    magnificOptions = {
                        closeBtnInside: true,
                        removalDelay: 300,
                        mainClass: 'mfp-fade',
                        items: {
                            type: 'inline'
                        },
                        callbacks: {
                            open: function(){

                                if ( recordHistory ) {
                                    var state = this.content.selector.replace('#popup-','');
                                    history.pushState("", document.title, '#'+state );
                                }

                                wrapperHeight();

                                var scroll = $(this.content.selector).offset().top;
                                $('body').animate({
                                    scrollTop: scroll,
                                }, 300);
                            },
                            resize: function() {
                                wrapperHeight();
                            },
                            beforeClose: function() {
                                $(window).off('.wrapper');
                            },
                            afterClose: function() {
                                $('.mfp-ready').find('.featured-skater-widget-wrapper').removeAttr('style');
                            }
                        }
                    };

                    $popup.each(function(){
                        var $this = $(this);

                        magnificOptions.items.src = '#'+$this.attr('id');
                        var href = magnificOptions.items.src.replace(popupSeperator,'');
                        $('a[href="'+href+'"]').magnificPopup(magnificOptions);

                    });

                    // hashChanging

                    $(document).on('click', 'a.skater', function(e){
                        e.preventDefault();
                    });

                    function openMagnific() {
                        var hash = window.location.hash.replace('#','');
                        magnificOptions.items.src = '#popup-'+hash;
                        $.magnificPopup.open(magnificOptions);
                    }

                    function checkForHash($this) {

                        var hash = window.location.hash.replace('#','');
                        var popup = $this.parent().children().eq(1).attr('id').replace(popupSeperator,'');

                        if ( hash == popup ) {
                            openMagnific();
                        }
                    }

                    window.onpopstate = function() {

                        console.log('popstate');

                        recordHistory = false;

                        if ( !window.location.hash ) {
                            $.magnificPopup.close();
                        } else {
                            openMagnific();
                        }

                        recordHistory = true;

                    };

                    if ( window.location.hash ) {
                        openMagnific();
                    }
                },
                destroy: function(){

                }
            },

            sponsors: {
                init: function() {
                    App.utils.sponsors();
                },
                destroy: function() {

                }
            },

            tickets: {
                init: function() {
                    App.utils.sponsors();
                },
                destory: function() {

                }
            },

            charities: {
                init: function() {
                    App.utils.sponsors();
                },
                destory: function() {

                }
            },

            about: {
                init: function() {

                },

                destroy: function() {
                    $(document).off('.upDown');
                }

            },

            contact: {
                init: function() {
                    $('input[value=""]').addClass('empty');
                            $('input').keyup(function(){
                                if( $(this).val() === ''){
                                    $(this).addClass('empty');
                                }else{
                                    $(this).removeClass('empty');
                                }
                            });

                    $('select').on('change', function(){

                        $(this).addClass('selected');

                        var $selected = $(this).find('option:selected');
                        var val = $selected.val();
                        var name = $selected.attr('data-realname');

                        $('.js-message_select_emal').html(name + ' | '+val);
                        $('.js-form-hide').addClass('selected');

                    });

                    $('.js-submit').attr('disabled','disabled');

                    App.utils.validator.defaults();

                    $('.js-contact-form').validate({

                        rules: {
                            'message_select': {
                                required: true,
                            },
                            'message_name': {
                                minlength: 3,
                                required: true,
                            },
                            'message_email': {
                                email:true,
                                required:true,
                            },
                            'message_text': {
                                minlength: 3,
                                required:true,
                            }
                        },

                        messages: {
                          'message_name': {
                            minlength: '<span>Error:</span>&nbsp;Your name must be at least 3 characters long',
                            required: '<span>Error:</span>&nbsp;Please specify your name'
                          },
                          'message_email': {
                            required: '<span>Error:</span>&nbsp;We need your email address to contact you',
                            email: '<span>Error:</span>&nbsp;Your email address must be in the format of name@domain.com'
                          },
                          'message_text': {
                            minlength: '<span>Error:</span>&nbsp;Your message must be at least 3 characters long',
                            required: '<span>Error:</span>&nbsp;Please enter a message to send'
                          }
                        }

                    });

                },
                destory: function() {

                }
            },
        };

        function init(){
            pages.all.init();

            // load specific page events/plugin initialization
            if(settings.PAGE && pages.hasOwnProperty(settings.PAGE)){
                pages[settings.PAGE].init();
            }
            // leave at the bottom
        }

        function destroy(){
            // load specific page events/plugin initialization
            if( settings.PAGE && pages.hasOwnProperty(settings.PAGE) ){
                pages[settings.PAGE].destroy();
            }

            // leave at the bottom
            pages.all.destroy();
        }

        // Reveal public methods and global elements, settings
        return {
            elements : elements,
            settings : settings,
            colors: colors,
            sizes: sizes,
            init : init,
            destroy : destroy,
        };
    }());

}(jQuery, this, this.document));
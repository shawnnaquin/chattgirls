(function ($, window, document, undefined) {

    window.App = {};

    App.utils = {};

    /** loader
    ------------------------------------------------------------------------------------------------------------------*/
    App.utils.slick = {
        init: function(){
            $('.slick').slick({
                infinite: true,
                autoplay: false,
                autoplaySpeed: 6000,
                prevArrow: $('.slick-pre'),
                nextArrow: $('.slick-nex'),
                accessibility: true,
                focusOnSelect:true,
                draggable:true,
                swipeToSlide:true
            });

            function getDirection(nextSlide, currentSlide) {
                var direction;

                if (Math.abs(nextSlide - currentSlide) == 1) {
                  direction = (nextSlide - currentSlide > 0) ? "right" : "left";
                }
                else {
                  direction = (nextSlide - currentSlide > 0) ? "left" : "right";
                }
                return direction;
            }

            $('.slick').on('beforeChange', function(event, slick, currentSlide, nextSlide){
                if ( getDirection(nextSlide, currentSlide) == 'right' ) {
                    $('.slick-nex').addClass('active');
                } else {
                    $('.slick-pre').addClass('active');
                }
            });

            $('.slick').on('afterChange', function(event, slick, currentSlide, nextSlide){
                $('.slick-pre, .slick-nex').removeClass('active');
            });
        },
        destroy:function() {

        }
    };


    App.utils.validator = {
        defaults: function() {

            function classList(element) {
                var classList = $(element).attr('class');
                return classList;
            }
            function findLabel(element){
                return $(element.form).find("label[for=" + element.id + "]");
            }

            function findBadge(element, warningClass) {
               return findLabel(element).parent().find('.warning-'+warningClass);
            }

            function labelLength(element, theClass) {
                return $(element.form).find('label.'+theClass).length;
            }

            function enableButton(element) {
                var error = $('.js-contact-form').find('label.error').length;
                var success = $('.js-contact-form').find('label.success').length;

                if ( success === 0 && error === 0 || error > 0 ) {
                    $('.js-human').css({'opacity':'0'});
                } else if ( success >= 3 ) {
                    $('.js-human').css({'opacity':'1'});
                }
            }

            enableButton();

            $.validator.setDefaults({
                debug: true,
                errorElement: 'i',
                errorClass: 'error',
                validClass: "success",

                errorPlacement: function(error, element) {
                    $('label.error > i.error').remove();
                    error.prependTo('label.error');
                },

                highlight: function(element, errorClass, validClass) {
                    $(element).removeClass(validClass).addClass(errorClass);
                    findLabel(element)
                        .attr('class', classList(element) );
                    findBadge(element, validClass).css({'opacity':'0'});
                    findBadge(element, errorClass).css({'opacity':'1'});
                    enableButton(element);
                },

                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass(errorClass).addClass(validClass);
                    findLabel(element).attr('class', classList(element) );
                    findBadge(element, errorClass).css({'opacity':'0'});
                    findBadge(element, validClass).css({'opacity':'1'});
                    enableButton(element);
                },

                invalidHandler: function(form, validator) {

                },

                submitHandler: function(form){
                    $(form).ajaxSubmit({
                        dataType: 'json',
                        beforeSubmit:function(){
                            $.blockUI({
                                message: 'Sending message...',
                                blockMsgClass: 'loading'
                            });
                            return true;
                        },
                        success:function(response){
                            $.blockUI({
                                message: response.message,
                                timeout: 3000,
                                blockMsgClass: response.type,
                                onUnblock: function(){
                                    if(response.type === 'success'){
                                        window.location.reload();
                                    }
                                }
                            });
                        }
                    });
                }
            });
        },
    };

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
    App.utils.interiorSideBarHeight = {
        init: function() {
            if ( !$('.js-sidbear').hasClass('ps-container') ) {

                var mainContentHeight = $('.main-content').outerHeight(true);

                $('.js-sidebar').css({
                    'height':mainContentHeight,
                }).perfectScrollbar({suppressScrollX:true});
            } else {
                $('.js-sidebar').perfectScrollbar('update');
            }
        },
        resize: function() {
            $(window).on('resize.sidebar', function(){
                App.utils.interiorSideBarHeight.init();
            });
        },
        destroy: function() {
            $(window).off('.sidebar');

            $('.js-sidebar')
                .perfectScrollbar('destroy');
            setTimeout(function(){
                $('.js-sidebar')
                    .removeAttr('style');
            },100);
        }
    };

    App.utils.sidebarHeight = function() {
        var sidebarHeight = $(window).height() - App.main.elements.$sidebar.position().top;
        return String( Math.round( sidebarHeight ) )+'px';
    };

    App.utils.sidebarScroll = function($sidebar, sidebarPos, sidebarHeight) {

        var $spacerDiv = $('.js-spacer');
        var sidebarCssHeight = String( Math.round( sidebarHeight + $('body').scrollTop() ) ) + 'px' ;

        function isSidebarScrollable() {
            var bodyScroll = $('body').scrollTop();
            var isSidebarScrollable = bodyScroll >= sidebarPos;
            return isSidebarScrollable;
        }

        (function scrollSidebar() {

            // console.log('posTop: '+$sidebar.position().top);
            // console.log('bodyScrollTop: '+$('body').scrollTop());
            // console.log('windowHeight: '+$(window).height());
            // console.log('');

            if ( $sidebar.css('top') == 'auto' && isSidebarScrollable() ) {

                $sidebar
                    .css({
                        'top':'66px',
                        'position':'fixed',
                        'left':'0',
                        'height':'100%',
                    })
                    .perfectScrollbar('update');

                if ( $spacerDiv.length ) {
                    $spacerDiv.css({'display':'block'});
                }

            } else if ( isSidebarScrollable() === false && $sidebar.css('top') == '66px' ){

                $sidebar
                    .css({
                        'top':'auto',
                        'left':'',
                        'position':'relative',
                        'height':sidebarCssHeight,
                    })
                    .perfectScrollbar('update');

                if ( $spacerDiv.length ) {
                    $spacerDiv.css({'display':'none'});
                }
            }
        })();
    };

    App.utils.sponsors = function() {

        function determineSize() {
           var width = $('.sponsor').innerWidth();
           $('.sponsor').css({ 'height' : width });
        }

        $(window).on('load', function(){
            $(window).trigger('resize');
        });

        $(window).on('resize', function(){
            determineSize();
        });
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

    App.utils.jsHeight= function() {

        var theHeight = $('.js-height').width()-50;
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

    };

    App.utils.sharrre = function() {

        var theHref = $('.js-sharrre').attr('data-href');
        var theText = $('.js-sharrre').attr('data-text');
        var hashTags = $('.js-sharrre').attr('data-hashtags');

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
                        // url: theHref,
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
                        // url: theHref,  //if you need to personalize url button
                        description: theText,
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
                        // url: theHref,  //if you need to personalize url button
                        count: 'horizontal',
                        hashtags: hashTags,
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
            $sidebar : $('.js-sidebar'),
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
            PAGE : $('body').attr('data-name')
        };

        var pages = {

            all: {
                init: function(){

                    $(window).on('resize', function(){
                        console.log(Foundation.MediaQuery.current);
                    });

                    App.utils.interiorSideBarHeight.init();
                    App.utils.interiorSideBarHeight.resize();

                    console.log('hello!');
                    var $sidebar = App.main.elements.$sidebar;
                    var sidebarPos, sidebarHeight;

                    // if ( $sidebar.length ) {
                    //     sidebarPos = $sidebar.position().top;
                    //     $sidebar.perfectScrollbar({suppressScrollX:true});
                    //     sidebarHeight = $(window).height() - $sidebar.position().top;
                    // }


                    $(window).on('scroll', function(){

                        // (function fixedSiteNav() {

                        //     if ( $('body').scrollTop() >= 104 ) {
                        //         $('#site-navigation').css({'position':'fixed'});
                        //         $('.js-small-logo').css({'opacity':'1'});
                        //         $('.js-big-logo').css({'opacity':'0'});
                        //     } else {
                        //         $('#site-navigation, .js-small-logo, .js-big-logo').removeAttr('style');
                        //     }

                        // })();

                        // if ( sidebarPos && App.main.settings.PAGE != 'home-page' ) {
                        //     App.utils.sidebarScroll($sidebar, sidebarPos, sidebarHeight);
                        // }

                    });

                    //replace zipcodes in cities.
                    $('.js-city').each(function(i){
                        var newText = $(this).html().replace(/\d+/g, '');
                        $(this).html('').html(newText);
                    });

                    $(document).on('click', '.js-noclick', function(e){
                        e.preventDefault();
                    });
                }
            },
            'home-page': {
                init: function(){
                    App.utils.slick.init();
                    // this needs to be at the bottom of this function
                    App.utils.loader(elements.$loader);
                },
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
                },
                destroy: function(){
                },
            },
            home: {
                init: function(){
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
                    App.utils.interiorSideBarHeight.destroy();

                },
                destroy: function(){
                    App.utils.interiorSideBarHeight.init();
                    App.utils.interiorSideBarHeight.resize();
                    // App.utils.toggle_nav.destroy();
                },
            },

            'home-page': {
                init: function() {
                   var $sidebar = App.main.elements.$sidebar;
                   var target = '.js-front-wrapper';
                   $sidebar.appendTo(target);
                },
                destroy: function() {
                   var $sidebar = App.main.elements.$sidebar;
                   $sidebar.prependTo('.js-front-wrapper');
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
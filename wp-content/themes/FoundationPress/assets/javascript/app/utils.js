(function ($, window, document, undefined) {

    App.utils = {};

    App.utils.slick = {
        vars: {},

        init: function() {
            // App.utils.slick.init()

            if ( !App.main.settings.slick ) {

                $('.js-home-slider-inner').slick(App.main.settings.slickOptions);

                $(window).trigger('resize');

                App.main.settings.slick = true;

            }
        },

        destroy: function() {
            // App.utils.slick.destroy()

            // console.log('slick destroy');
            if ( App.main.settings.slick ) {
                $('.js-home-slider-inner').slick('unslick');
                // console.log('unslick');
                App.main.settings.slick = false;
            }
        },
    };
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

            $(window).on('resize.sidebar', function(){
                var $sidebar = $('.js-sidbear');

                if ( !$sidebar.hasClass('ps-container') ) {
                    var mainContentHeight = $('.main-content').outerHeight(true);
                    $sidebar
                        .css({
                            'height': mainContentHeight,
                        })
                        .perfectScrollbar({ suppressScrollX: true });
                } else {
                    $sidebar.perfectScrollbar('update');
                }
            });

        },

        destroy: function() {

            $(window).off('.sidebar');
            $('.js-sidebar')
                .perfectScrollbar('destroy')
                .removeAttr('style');
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

}(jQuery, this, this.document));


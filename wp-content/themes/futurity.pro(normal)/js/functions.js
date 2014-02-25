
        ymaps.ready(function () {
            var myMap = new ymaps.Map('YMapsID', {
                center: [50.014145, 36.213353],
                zoom: 16,
                behaviors: ["default"]
            });
            ymaps.geoXml.load("http://maps.yandex.ua/-/CVV1FYMG");
            
            myMap.balloon.open(
    // Координаты балуна
    [50.014145, 36.213353], {
        /* Свойства балуна:
           - контент балуна */
        content: "Futurity"
    }, {
        /* Опции балуна:
           - балун имеет копку закрытия */ 
        closeButton: true
    }
);
            
        });

        function filterPath(string) {
            return string
                    .replace(/^\//,'')
                    .replace(/(index|default).[a-zA-Z]{3,4}$/,'')
                    .replace(/\/$/,'');
        }

        function init() {
            $('a[href*=#]').each(function() {
                var locationPath = filterPath(location.pathname);
                var scrollElem = scrollableElement('html', 'body');
                var thisPath = filterPath(this.pathname) || locationPath;
                if (locationPath == thisPath
                        && (location.hostname == this.hostname || !this.hostname)
                        && this.hash.replace(/#/,'') ) {
                    var $target = $(this.hash);
                    var target = this.hash;
                    if (target) {
                        var targetOffset = $target.offset().top;
                        $(this).on('click', function(event) {
                            event.preventDefault();
                            $(scrollElem).animate({scrollTop: targetOffset}, 400, function() {
                                location.hash = target;
                            });
                        });
                    }
                }
            });
        }

        // use the first element that is "scrollable"
        function scrollableElement(els) {
            for (var i = 0, argLength = arguments.length; i <argLength; i++) {
                var el = arguments[i],
                        $scrollElement = $(el);
                if ($scrollElement.scrollTop()> 0) {
                    return el;
                } else {
                    $scrollElement.scrollTop(1);
                    var isScrollable = $scrollElement.scrollTop()> 0;
                    $scrollElement.scrollTop(0);
                    if (isScrollable) {
                        return el;
                    }
                }
            }
            return [];
        }

        $(document).ready(function() {
            $(window).scroll(function () {
                var inview = '#' + $("article:in-viewport:first").attr('id');
                var $link = $('.menu-sub a').filter('[href=' + inview + ']');
                if (inview != '#undefined') {
                    $('.menu-sub li').removeClass('active');
                    $link.parent().addClass('active');
                }
            })

            var $active = $('a[href="<?php echo $request ?>"]');
            $active.addClass('active');
            //if ($active.parent().parent().parent()[0].tagName != 'NAV')
              $active.parent().parent().parent().find('a:eq(0)').addClass('active');

            $('.btn-buy').click(function(){
                var product = $(this).data('product');
                if(product) {
                    $('#message').html(product);
                    $('#name').focus();
                }
            })

            var slide = 0;
            var slide_count = $('.slide').length;
            var prev_slide = 1;

            for(i=0; i < slide_count; i++) {
                var title = $('.slide:eq('+i+')').find('h3').text();
                $('#slide-list').append('<a title="'+title+'" href="#">'+i+'</a>');
            }

            $('#slide-list a').click(function(e){
                e.preventDefault();
                prev_slide = slide;
                var i = $(this).index('#slide-list a');
                slide = i;
                show_slide();
            });



            function show_slide() {
                if (prev_slide != slide) {
                    $('.slide:eq('+prev_slide+')').hide();
                    $('.slide:eq('+slide+')').fadeIn();
                }
                $('#slide-list a').removeClass('active');
                $('#slide-list a:eq('+slide+')').addClass('active');
            }

            $('.next').on('click', function(e){
                e.preventDefault();
                prev_slide = slide;
                slide+=1;
                if(slide>slide_count-1) slide=slide_count-1;
                show_slide();
            });

            $('.prev').on('click', function(e){
                e.preventDefault();
                prev_slide = slide;
                slide-=1;
                if(slide<0) slide=0;
                show_slide();
            })

            $('.rate input').on('click', function(e) {
                var text = $(this).parent().parent().parent().parent().find('h3').text();
                var rate = $(this).parent().text();
                $(this).parent().parent().parent().find('.btn-buy').data('product', text+' / '+rate);
            });

            $('.slide').hide();
            show_slide();

            var _top = $(window).scrollTop();
            var _direction;
            $(window).scroll(function(){
                var _cur_top = $(window).scrollTop();
                if (_cur_top>100) {
                    $('.menu-sub').css({position:'fixed', top:0, display: 'block'});
                } else {
                    $('.menu-sub').css({display: 'none'});
                }
                $('#bg').css({top:-_cur_top/40});
            });
        });

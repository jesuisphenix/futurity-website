<?php include "functions.php"; ?>
<!doctype html>
<html lang="ru-RU">
<head>
    <title>Futurity – сайты для бизнеса</title>
    <link rel="shortcut icon" type="image/x-icon" href="/img/favicon.ico">
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,300,600,700&subset=cyrillic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="/css/bootstrap.css">
    <link rel="stylesheet" href="/css/style.css">
    <script src="/js/jquery-2.0.2.min.js"></script>
    <script src="http://api-maps.yandex.ru/2.0/?load=package.full&lang=ru-RU" type="text/javascript"></script>
    <script src="/js/jquery.viewport.js" type="text/javascript"></script>
    <script type="text/javascript">
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
            if ($active.parent().parent().parent()[0].tagName != 'NAV')
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
    </script>

    <style type="text/css">
        #YMapsID {
            width: 100%;
            height: 200px;
        }
    </style>
</head>
<body>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-8615631-38']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<!-- Yandex.Metrika counter -->
<script type="text/javascript">
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter22351963 = new Ya.Metrika({id:22351963,
                    webvisor:true,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true,
                    trackHash:true});
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
                s = d.createElement("script"),
                f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="//mc.yandex.ru/watch/22351963" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
    <div class="theme-wrapper">
        <header class="theme-header">
            <section class="theme-box">
                <span class="descriptor">сайты для бизнеса</span>
                <a href="/"><img src="/img/logo.png" alt="Futurity"></a>
                <div class="call-us">
                    <script type="text/javascript" src="http://www.skypeassets.com/i/scom/js/skype-uri.js"></script>
                    <div id="SkypeButton_Chat_futurity.pro_1">
                        <script type="text/javascript">
                            Skype.ui({
                                "name": "chat",
                                "element": "SkypeButton_Chat_futurity.pro_1",
                                "participants": ["futurity.pro"],
                                "imageSize": 32
                            });
                        </script>
                    </div>
                </div>
                <nav class="menu-main">
                    <ul>
                        <li>
                            <a href="/ru/">Разработка сайтов</a>
                            <ul>
                              <li><a href="/ru/landing">продающий сайт</a></li>
                                <li><a href="/ru/naming">нейминг</a></li>
                                <li><a href="/ru/adaptive">адаптивная верстка</a></li>
                                <li><a href="/ru/wordpress">создание темы для Wordpress</a></li>
                                <li><a href="/ru/technology">новейшие технологии</a></li>
                            </ul>
                        </li>
                        <li><a href="/ru/promotion">Продвижение</a></li>
                        <li><a href="/ru/about">О компании</a></li>
                        <li><a href="/ru/blog">Блог</a></li>
                    </ul>

                </nav>
            </section>
        </header>
        <?php echo $page ?>
        <div class="theme-box theme-content">
            <section>
                <article id="contacts">
                    <h2>Свяжитесь с нами!</h2>
                    <div class="promo"></div>
                    <div class="contact-details">
                    
<!-- Begin MailChimp Signup Form -->
<div id="mc_embed_signup" style="clear:both;">
<form action="http://granitoak.us2.list-manage.com/subscribe/post?u=6b1b65a2fdb9885d429907d1d&amp;id=ce2210b7fb" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
	<h3>Подпишитесь на рассылку</h3>
	<p>И получайте рассылку самых свержих советов по интернет-маркетингу на ваш Email</p>
<div class="mc-field-group">
	<input type="email" value="" placeholder="Email" name="EMAIL" class="required email" id="mce-EMAIL">
</div>
	<div id="mce-responses" class="clear">
		<div class="response" id="mce-error-response" style="display:none"></div>
		<div class="response" id="mce-success-response" style="display:none"></div>
	</div>	<div class="clear"><input type="submit" value="Подписаться" name="subscribe" id="mc-embedded-subscribe" class="btn-buy"></div>
</form>
</div>

<!--End mc_embed_signup-->                       
                        <h3>Как с нами связаться?</h3>
                        <dl>
                            <dt>Адрес</dt>
                            <dd>Украина, Харьков, ул. Клочковская, 195д</dd>

                            <dt>Телефон</dt>
                            <dd>+38 (099) 193-90-78</dd>

                            <dt>Email</dt>
                            <dd><a href="mailto:hello@futurity.pro">hello@futurity.pro</a></dd>

                            <dt>Skype</dt>
                            <dd><a href="skype:futurity.pro">futurity.pro</a></dd>
                        </dl>                 
                        
                    </div>
                    <div id="buy" class="form-contact">
                        <form action="order.php" method="post">
                            <h3>Оформление заявки</h3>
                            <div class="field">
                                <label for="name">Имя</label>
                                <input id="name" name="name" type="text" placeholder="Ваше имя, фамилия">
                            </div>
                            <div class="field">
                                <label for="contact">Контакт</label>
                                <input id="contact" name="contact" type="text" placeholder="Email, телефон или скайп">
                            </div>
                            <div class="field">
                                <label for="message">Сообщение</label>
                                <textarea name="message" id="message" cols="30" rows="7" placeholder="Опишите суть вашего запроса"></textarea>
                            </div>
                            <button type="submit" class="btn-buy">Отправить</button>
                        </form>
                    </div>
                </article>
                <article>
                    <script type="text/javascript" src="//vk.com/js/api/openapi.js?101"></script>

                    <!-- VK Widget -->
                    <div id="vk_groups"></div>
                    <script type="text/javascript">
                        VK.Widgets.Group("vk_groups", {mode: 1, width: "220", height: "400", color1: 'ffffff', color2: '2B587A', color3: 'd13902'}, 1308836);
                    </script>

                    <h2>Futurity &mdash; эксперт в интернет технологиях</h2>
                </article>
            </section>
        </div>
        <footer id="YMapsID">

        </footer>
    </div>
    <div id="bg"></div>
<!-- Start SiteHeart code -->
<script>
    (function(){
        var widget_id = 665851;
        _shcp =[{widget_id : widget_id}];
        var lang =(navigator.language || navigator.systemLanguage
            || navigator.userLanguage ||"en")
            .substr(0,2).toLowerCase();
        var url ="widget.siteheart.com/widget/sh/"+ widget_id +"/"+ lang +"/widget.js";
        var hcc = document.createElement("script");
        hcc.type ="text/javascript";
        hcc.async =true;
        hcc.src =("https:"== document.location.protocol ?"https":"http")
            +"://"+ url;
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hcc, s.nextSibling);
    })();
</script>
<!-- End SiteHeart code -->
</body>
</html>
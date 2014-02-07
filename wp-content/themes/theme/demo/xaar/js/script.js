var timer = false;

function getRandomInt(min, max)
{
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

$(function(){

var view = {
    config: {
        current: '',
        columns: 4,
        speed: 700,
        resizeToBig: false,
        resizeToSmall: false,
        randomResize: false,
        randomMoves: true,
        width: 152,
        contacts: false,
        openedProject: false
    },
    blocks: {},
    random: {},
    changed: false,
    init: function() {
        if(view.config.randomMoves) {
            if(view.config.randomResize || !timer) {
                randomBlocks();
                refreshBlocks(view.random);
            }    
        }
        
        view.config.openedCases = false;
        initBlocks();
        refreshBlocks(view.blocks);
        resetBlocks();
        timer = false;
    }
}

var randomBlocks = function(){
    for(var id=1; id<=16; id++) {
        var left = getRandomInt(0, 1000);
        var top = getRandomInt(0, 1000);

        var idStr = id;

        if (id < 10)
            idStr = '0' + idStr;

        idStr = '#b' + idStr;

        view.random[id] = {
            left: left,
            top: top,
            id: idStr
        }
    }
};

var initBlocks = function(){
    var count = $('.block').length;
    var screenWidth = $(window).width();
    var screenHeight = $(window).height();
    var size = 0;

    if (screenHeight > screenWidth) {
        size = screenWidth;
    } else {
        size = screenHeight;
    }

    size = (size-8) / view.config.columns;

    view.config.width = 152;

    if(size < 152) {
        if(view.config.resizeToSmall) view.config.width = size;
    } else {
        if(view.config.resizeToBig) view.config.width = size;
    }

    var width = view.config.width;

    $('.block').css({width: width-2, height:width-2});

    var margin_left = 0.5 * screenWidth - 0.5 * width * view.config.columns;
    var margin_top = 0.5 * screenHeight - 0.5 * width * (count/view.config.columns);
    if (margin_left < 0) margin_left = 0;
    if (margin_top < 0) margin_top = 0;

    margin_top += 38;

    for(var id=1; id<=16; id++) {
        var line = Math.round((id-view.config.columns+1)/view.config.columns);
        var left = (id-(line*view.config.columns)-1) * width + margin_left;
        var top = line * width + margin_top;

        var idStr = id;

        if (id < 10)
            idStr = '0' + idStr;

        idStr = '#b' + idStr;

        view.blocks[id] = {
            left: left,
            top: top,
            id: idStr
        }
    }
}

var refreshBlocks = function(blocks){
    view.config.openedCases = false;

    $('.active').removeClass('active');

    $('.block').each(function(){
        var $this = $(this);
        var idStr = '#' + $(this).attr('id');
        var id = parseInt(idStr.replace('#b0', '').replace('#b', ''));
        if (id > 0 && id != 5 && id != 9) {
            $this.animate({left:blocks[id].left, top:blocks[id].top});
        }
    });
    $('#b13').animate({'margin-left': 1});
    $('#page').animate({
        left: blocks[5].left, 
        top: blocks[5].top,
        height: view.config.width * 2,
        width: view.config.width * 3 - 2
    });
    $('#sidebar').animate({
        width: view.config.width
    });
    $('#content').animate({
        width: (view.config.width-1)*2 - 2,
        height: (view.config.width-1)*2
    });
    $('#contacts').css({
        left: blocks[13].left,
        top: blocks[13].top,
        width: (view.config.width),
        height: (view.config.width)
    });
    $('#projects').css({
        left: blocks[8].left + view.config.width,
        top: blocks[8].top,
        width: (view.config.width-1),
        height: (view.config.width)*2-1
    });
    $('#logo').animate({
        left: blocks[1].left,
        top: blocks[1].top - 38
    });
}

var resetStates = function(obj, firstAnim) {
    obj.removeClass('active');
    obj.removeClass('changed');

    if(firstAnim)
        obj.addClass('first-anim');
    else
        obj.addClass('anim');
}

var finishAnimation = function() {
    $(this).removeClass('anim');
    $(this).removeClass('first-anim');
}

var resetBlocks = function() {
    view.config.openedCases = false;
    $('#b13').animate({'margin-left': 1});
    view.config.contacts = false;
    $('#next,#prev').hide();
    $('#projects').hide();
    $('#content').html('');   
    var width = view.config.width*3; 
    $('#content').animate({width:view.config.width*2});
    $('#page').animate({'margin-left':0, width:width+2}, function(){
        var $article = $('#b05 article');
        if($article.length) $article.appendTo($('#projects'));
        $('section nav a').removeClass('active');
        var blocks = view.blocks;
        for(current in blocks) {
            if(current > 0 && current != 5 && current != 9) {
                $current = $(blocks[current].id);
                resetStates($current, false);
                $(blocks[current].id).animate({top:blocks[current].top, left:blocks[current].left}, view.config.speed, finishAnimation);                    
            }
            
        }
    });
    return false;
}

var moveBlocks = function(steps, callback) {
    $('#next,#prev').hide();
    firstAnim = false;
    
    view.changed = true
    for(current in steps) {
        var blocks = view.blocks;
        var target = steps[current];
        var $current = $(blocks[current].id);
        resetStates($current, firstAnim);
        $current.addClass('changed');
        $current.animate({top:blocks[target].top, left:blocks[target].left}, view.config.speed, function(){
            if(current==steps.length)
            finishAnimation();
            if(typeof(callback) != 'undefined') callback();
        });
        view.changed = true;
        view.config.openedCases = true;
    }
    
}

var closeProjects = function(callback) {
    $('#next,#prev').hide();
    if(view.config.openedProject) {
        var $article = $('#b05 article');
        if($article.length) $article.appendTo($('#projects'));  
        $('#content').html('');   
        $('#content').attr('class', view.config.current);
        $('#projects article').hide();
        var width = view.config.width*3; 
        $('#content').animate({width:view.config.width*2});
        $('#page').animate({'margin-left':0, width:width+2}, callback);    
    } else callback();
}

var loadPhoto = function(next) {
    $('#next,#prev').show();
    if(next=='next') {
        if(view.config.currentPhoto+1<view.config.photosStack.length)
            view.config.currentPhoto++;
    } else if (next=='prev') {
        if(view.config.currentPhoto>0)
        view.config.currentPhoto--;
    } else {
        view.config.currentPhoto = next;
    }
    if(view.config.currentPhoto+2 > view.config.photosStack.length) {
        $('#next').hide();
    }
    if(view.config.currentPhoto-1 < 0) {
        $('#prev').hide();
    }
    $('#pagination li').removeClass('active');
    $('#pagination li:eq('+view.config.currentPhoto+')').addClass('active');
    var currentImage = view.config.photosStack[view.config.currentPhoto];
    $('#content').html('<img height="302" id="current-photo" src="' + currentImage + '">');
    $('#current-photo').load(function(){
        var width = $('#current-photo').width();
        $('#page').animate({width:width + view.config.width + 2, 'margin-left':view.config.width*2-width-2});
        $('#content').attr('class', '');
        $('#content').animate({width:width});
    });
}

    $(window).resize(function(){
        if(!timer) {
            timer = setTimeout(view.init, 500);    
        }
    });

    view.init();

    $('.menu').click(function(){
        var $this = $(this);
        if(!$this.hasClass('active')) {
            closeProjects(function(){
                $('section nav a').removeClass('active');
                var current = $this.attr('class').replace('block menu ', '').replace(' hover', '').replace('changed', '').replace('anim');
                $this.addClass('hover');
                $this.addClass('clicked');

                var nextAction = function() {
                    $this.removeClass('hover');
                    $this.removeClass('clicked');
                    $('.menu.active').removeClass('active');
                    $this.addClass('active');    
                }

                if(view.config.openedCases) {
                    nextAction();
                } else {
                    moveBlocks({6:2,7:8,10:14,11:15}, nextAction);
                }
                
                view.config.current = current;
                $('#content').attr('class', view.config.current);
                view.config.openedProject = false;
            });    
        }
        return false;
    });

    $('#logo').click(resetBlocks);

    $('.block').hover(function(){$(this).addClass('hover')}, function(){$(this).removeClass('hover')})

    $('section nav a').click(function(){
        var $this = $(this);
        var projects = $this.attr('href').replace('#', '.');
            
        closeProjects(function(){
            $('section nav a').removeClass('active');
            $this.addClass('active');
            $('#content').html('');
            if(projects.length > 1) {
                view.config.openedProject = true;
                $(projects).show();
            }
            $('.divider').remove();
            $('#projects').show();
        });    

        return false;
    });

    $('#projects article').click(function(){
        var $this = $(this);
        var isCurrent = $this.parent().attr('id') == 'b05';
        $('#content').animate({width:0});
        $('#content').html('');
        $('#page').animate({'margin-left':view.config.width*2, width:view.config.width+2}, function(){
            var $article = $('#b05 article');
            if($article.length) $article.appendTo($('#projects'));
            
            $('#content').attr('class', view.config.current);

            if(!isCurrent) {
                view.config.currentPhoto = 0;
                view.config.photosStack = ['public/interior/1.jpg', 'public/interior/2.jpg'];
                $this.appendTo($('#b05'));
                var pageLinks = '';
                for(var i=0;i<view.config.photosStack.length;i++) {
                    pageLinks += '<li class="page" id="page-'+i+'">'+(i+1)+'</li>';
                }
                $('#pagination').html(pageLinks);
                loadPhoto(0);  
            } else {
                $('#next,#prev').hide();
                var width = view.config.width*3;
                $('#page').animate({'margin-left':0, width:width+2});
                $('#content').animate({width:view.config.width*2});
            }
        });
    });

    $('.page').live('click', function(){
        var page = $(this).attr('id').replace('page-', '');
        loadPhoto(page);
    });

    $('#next,#prev').click(function(){
        var dir = $(this).attr('id');
        if(dir == 'next' && view.config.currentPhoto+1>view.config.photosStack.length) return false;
        if(dir == 'prev' && view.config.currentPhoto-1<0) return false;
        $('#content').animate({width:0});
        $('#content').html('');
        $('#page').animate({'margin-left':view.config.width*2, width:view.config.width+2}, function(){
            loadPhoto(dir);
        });    
        return false;
    });

    $('#contacts').click(function(){
        var $this = $('#b13');
        if(!view.config.contacts) {
            $this.animate({'margin-left':-view.config.width});
            view.config.contacts = true;
        } else {
            $this.animate({'margin-left': 1});
            view.config.contacts = false;
        }
        return false;
    });

    // setTimeout(function(){
    //     $('#b06').click();
    //     $('section nav a:eq(0)').click();
    //     $('#projects article:eq(0)').click();    
    // }, 2000);    
})
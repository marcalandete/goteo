(function(a){a.fn.slides=function(b){b=a.extend({},a.fn.slides.option,b);return this.each(function(){a("."+b.container,a(this)).children().wrapAll('<div class="slides_control"/>');var w=a(this),k=a(".slides_control",w),A=k.children().size(),r=k.children().outerWidth(),n=k.children().outerHeight(),d=b.start-1,m=b.effect.indexOf(",")<0?b.effect:b.effect.replace(" ","").split(",")[0],t=b.effect.indexOf(",")<0?m:b.effect.replace(" ","").split(",")[1],p=0,o=0,c=0,q=0,v,h,j,y,x,u,l,f;function e(D,C,B){if(!h&&v){h=true;b.animationStart(q+1);switch(D){case"next":o=q;p=q+1;p=A===p?0:p;y=r*2;D=-r*2;q=p;break;case"prev":o=q;p=q-1;p=p===-1?A-1:p;y=0;D=0;q=p;break;case"pagination":p=parseInt(B,10);o=a("."+b.paginationClass+" li."+b.currentClass+" a",w).attr("href").match("[^#/]+$");if(p>o){y=r*2;D=-r*2}else{y=0;D=0}q=p;break}if(C==="fade"){if(b.crossfade){k.children(":eq("+p+")",w).css({zIndex:10}).fadeIn(b.fadeSpeed,b.fadeEasing,function(){if(b.autoHeight){k.animate({height:k.children(":eq("+p+")",w).outerHeight()},b.autoHeightSpeed,function(){k.children(":eq("+o+")",w).css({display:"none",zIndex:0});k.children(":eq("+p+")",w).css({zIndex:0});b.animationComplete(p+1);h=false})}else{k.children(":eq("+o+")",w).css({display:"none",zIndex:0});k.children(":eq("+p+")",w).css({zIndex:0});b.animationComplete(p+1);h=false}})}else{k.children(":eq("+o+")",w).fadeOut(b.fadeSpeed,b.fadeEasing,function(){if(b.autoHeight){k.animate({height:k.children(":eq("+p+")",w).outerHeight()},b.autoHeightSpeed,function(){k.children(":eq("+p+")",w).fadeIn(b.fadeSpeed,b.fadeEasing)})}else{k.children(":eq("+p+")",w).fadeIn(b.fadeSpeed,b.fadeEasing,function(){if(a.browser.msie){a(this).get(0).style.removeAttribute("filter")}})}b.animationComplete(p+1);h=false})}}else{k.children(":eq("+p+")").css({left:y,display:"block"});if(b.autoHeight){k.animate({left:D,height:k.children(":eq("+p+")").outerHeight()},b.slideSpeed,b.slideEasing,function(){k.css({left:-r});k.children(":eq("+p+")").css({left:r,zIndex:5});k.children(":eq("+o+")").css({left:r,display:"none",zIndex:0});b.animationComplete(p+1);h=false})}else{k.animate({left:D},b.slideSpeed,b.slideEasing,function(){k.css({left:-r});k.children(":eq("+p+")").css({left:r,zIndex:5});k.children(":eq("+o+")").css({left:r,display:"none",zIndex:0});b.animationComplete(p+1);h=false})}}if(b.pagination){a("."+b.paginationClass+" li."+b.currentClass,w).removeClass(b.currentClass);a("."+b.paginationClass+" li:eq("+p+")",w).addClass(b.currentClass)}}}function s(){clearInterval(w.data("interval"))}function g(){if(b.pause){clearTimeout(w.data("pause"));clearInterval(w.data("interval"));l=setTimeout(function(){clearTimeout(w.data("pause"));f=setInterval(function(){e("next",m)},b.play);w.data("interval",f)},b.pause);w.data("pause",l)}else{s()}}if(A<2){return}if(d<0){d=0}if(d>A){d=A-1}if(b.start){q=d}if(b.randomize){k.randomize()}a("."+b.container,w).css({overflow:"hidden",position:"relative"});k.children().css({position:"absolute",top:0,left:k.children().outerWidth(),zIndex:0,display:"none"});k.css({position:"relative",width:(r*3),height:n,left:-r});a("."+b.container,w).css({display:"block"});if(b.autoHeight){k.children().css({height:"auto"});k.animate({height:k.children(":eq("+d+")").outerHeight()},b.autoHeightSpeed)}if(b.preload&&k.find("img:eq("+d+")").length){a("."+b.container,w).css({background:"url("+b.preloadImage+") no-repeat 50% 50%"});var z=k.find("img:eq("+d+")").attr("src")+"?"+(new Date()).getTime();if(a("img",w).parent().attr("class")!="slides_control"){u=k.children(":eq(0)")[0].tagName.toLowerCase()}else{u=k.find("img:eq("+d+")")}k.find("img:eq("+d+")").attr("src",z).load(function(){k.find(u+":eq("+d+")").fadeIn(b.fadeSpeed,b.fadeEasing,function(){a(this).css({zIndex:5});a("."+b.container,w).css({background:""});v=true;b.slidesLoaded()})})}else{k.children(":eq("+d+")").fadeIn(b.fadeSpeed,b.fadeEasing,function(){v=true;b.slidesLoaded()})}if(b.bigTarget){k.children().css({cursor:"pointer"});k.children().click(function(){e("next",m);return false})}if(b.hoverPause&&b.play){k.bind("mouseover",function(){s()});k.bind("mouseleave",function(){g()})}if(b.generateNextPrev){a("."+b.container,w).after('<a href="#" class="'+b.prev+'">Prev</a>');a("."+b.prev,w).after('<a href="#" class="'+b.next+'">Next</a>')}a("."+b.next,w).click(function(B){B.preventDefault();if(b.play){g()}e("next",m)});a("."+b.prev,w).click(function(B){B.preventDefault();if(b.play){g()}e("prev",m)});if(b.generatePagination){if(b.prependPagination){w.prepend("<ul class="+b.paginationClass+"></ul>")}else{}k.children().each(function(){a("."+b.paginationClass,w).append('<li><a href="#'+c+'">'+(c+1)+"</a></li>");c++})}else{a("."+b.paginationClass+" li a",w).each(function(){a(this).attr("href","#"+c);c++})}a("."+b.paginationClass+" li:eq("+d+")",w).addClass(b.currentClass);a("."+b.paginationClass+" li a",w).click(function(){if(b.play){g()}j=a(this).attr("href").match("[^#/]+$");if(q!=j){e("pagination",t,j)}return false});a("a.link",w).click(function(){if(b.play){g()}j=a(this).attr("href").match("[^#/]+$")-1;if(q!=j){e("pagination",t,j)}return false});if(b.play){f=setInterval(function(){e("next",m)},b.play);w.data("interval",f)}})};a.fn.slides.option={preload:false,preloadImage:"/img/loading.gif",container:"slides_container",generateNextPrev:false,next:"next",prev:"prev",pagination:true,generatePagination:true,prependPagination:false,paginationClass:"paginacion",currentClass:"current",fadeSpeed:350,fadeEasing:"",slideSpeed:800,slideEasing:"",start:1,effect:"slide",crossfade:false,randomize:false,play:5000,pause:1,hoverPause:true,autoHeight:false,autoHeightSpeed:350,bigTarget:false,animationStart:function(){},animationComplete:function(){},slidesLoaded:function(){}};a.fn.randomize=function(c){function b(){return(Math.round(Math.random())-0.5)}return(a(this).each(function(){var f=a(this);var e=f.children();var d=e.length;if(d>1){e.hide();var g=[];for(i=0;i<d;i++){g[g.length]=i}g=g.sort(b);a.each(g,function(l,h){var n=e.eq(h);var m=n.clone(true);m.show().appendTo(f);if(c!==undefined){c(n,m)}n.remove()})}}))}})(jQuery);
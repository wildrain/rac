!function($){"use strict";var e=$("body"),t=function(){$("#media-query-breakpoint").length<1&&$("body").append('<var id="media-query-breakpoint"><span></span></var>');var e=$("#media-query-breakpoint").css("content");return"undefined"!=typeof e?(e=e.replace('"',"").replace('"',"").replace("'","").replace("'",""),isNaN(parseInt(e,10))&&($("#media-query-breakpoint span").each(function(){e=window.getComputedStyle(this,":before").content}),e=e.replace('"',"").replace('"',"").replace("'","").replace("'","")),isNaN(parseInt(e,10))&&(e=1199)):e=1199,e};$.fn.uouSelectBox=function(){var e=$(this),a=e.find("select");e.prepend('<ul class="select-clone custom-list"></ul>');var i=a.data("placeholder")?a.data("placeholder"):a.find("option:eq(0)").text(),n=e.find(".select-clone");e.prepend('<input class="value-holder" type="text" disabled="disabled" placeholder="'+i+'"><i class="fa fa-caret-down"></i>');var s=e.find(".value-holder");$.fn.placeholder&&e.find("input, textarea").placeholder(),a.find("option").each(function(){$(this).attr("value")&&n.append('<li data-value="'+$(this).val()+'">'+$(this).text()+"</li>")}),e.click(function(){var a=t();a>991&&(n.slideToggle(100),e.toggleClass("active"))}),n.find("li").click(function(){s.val($(this).text()),a.find('option[value="'+$(this).attr("data-value")+'"]').attr("selected","selected"),e.hasClass("links")&&(window.location.href=a.val())}),e.bind("clickoutside",function(e){n.slideUp(100)}),e.hasClass("links")&&a.change(function(){window.location.href=a.val()})},$.fn.uouCheckboxInput=function(){var e=$(this),t=e.find("input");t.is(":checked")?e.addClass("active"):e.removeClass("active"),t.change(function(){t.is(":checked")?e.addClass("active"):e.removeClass("active")})},$(document).ready(function(){var e=$(".header-language");e.children("a").on("click",function(e){e.preventDefault(),$(this).parent(".header-language").toggleClass("active")}),e.on("clickoutside touchendoutside",function(){e.hasClass("active")&&e.removeClass("active")}),$(".clients-slider").owlCarousel({items:5,navigation:!0,navigationText:["<div class='button prevSlide'><i class='fa fa-angle-left'></i></div>","<div class='button nextSlide'><i class='fa fa-angle-right'></i></div>"]}),$(".testimonials-slider").owlCarousel({singleItem:!0,pagination:!0}),$(".features-tabs").each(function(){var e=$(this),t=e.find(".tab-pane");t.each(function(){var e=$(this).find("img");e.length>0&&($(this).css("background-image","url("+e.attr("src")+")"),e.hide())})});var a=$("#header .header-toolbar-right .header-login, #header .header-toolbar-right .header-register");a.each(function(){var e=$(this);e.children("a").on("click",function(t){t.preventDefault(),e.toggleClass("active")}),e.on("clickoutside touchendoutside",function(){e.hasClass("active")&&e.removeClass("active")})}),$('a[data-toggle="tab"]').on("shown.bs.tab",function(){}),$(".checkbox-input").each(function(){$(this).uouCheckboxInput()}),$(".select-box").each(function(){$(this).uouSelectBox()}),$(".calendar-input").each(function(){var e=$(this).find("input"),t=e.data("dateformat")?e.data("dateformat"):"m/d/y",a=$(this).find(".fa"),i=e.datepicker("widget");e.datepicker({dateFormat:t,minDate:0,beforeShow:function(){e.addClass("active")},onClose:function(){e.removeClass("active"),i.hide(),i.parent().is("body")||i.detach().appendTo($("body"))}}),a.click(function(){e.focus()})}),$(".toggle").each(function(){$(this).click(function(){$(this).parent().parent().find("nav").slideToggle("200")})}),$(".essentials-filters").each(function(){var e=$(".essentials-filters-content").isotope({itemSelector:".essentials-filters-content .vechicle",layoutMode:"fitRows"}),t={};$(".essentials-filters li a").on("click",function(){var a=$(this).attr("data-filter");return a=t[a]||a,e.isotope({filter:a}),$(".essentials-filters li a").each(function(){$(this).removeClass("active")}),$(this).addClass("active"),!1})});var i=t()});var a=!1;e.on("touchmove",function(){a=!0}),e.on("touchstart",function(){a=!1})}(jQuery);
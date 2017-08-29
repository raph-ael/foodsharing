jQuery(function($){
        $.datepicker.regional['de'] = {clearText: 'löschen', clearStatus: 'aktuelles Datum löschen',
                closeText: 'schließen', closeStatus: 'ohne Änderungen schließen',
                prevText: '<zurück', prevStatus: 'letzten Monat zeigen',
                nextText: 'Vor>', nextStatus: 'nächsten Monat zeigen',
                currentText: 'heute', currentStatus: '',
                monthNames: ['Januar','Februar','März','April','Mai','Juni',
                'Juli','August','September','Oktober','November','Dezember'],
                monthNamesShort: ['Jan','Feb','Mär','Apr','Mai','Jun',
                'Jul','Aug','Sep','Okt','Nov','Dez'],
                monthStatus: 'anderen Monat anzeigen', yearStatus: 'anderes Jahr anzeigen',
                weekHeader: 'Wo', weekStatus: 'Woche des Monats',
                dayNames: ['Sonntag','Montag','Dienstag','Mittwoch','Donnerstag','Freitag','Samstag'],
                dayNamesShort: ['So','Mo','Di','Mi','Do','Fr','Sa'],
                dayNamesMin: ['So','Mo','Di','Mi','Do','Fr','Sa'],
                dayStatus: 'Setze DD als ersten Wochentag', dateStatus: 'Wähle D, M d',
                dateFormat: 'dd.mm.yy', firstDay: 1, 
                initStatus: 'Wähle ein Datum', isRTL: false};
        $.datepicker.setDefaults($.datepicker.regional['de']);
});

/*jRater*/
/************************************************************************
*************************************************************************
@Name :         jRating - jQuery Plugin
@Revison :      3.1
@Date :         13/08/2013
@Author:        ALPIXEL - (www.myjqueryplugins.com - www.alpixel.fr)
@License :      Open Source - MIT License : http://www.opensource.org/licenses/mit-license.php

**************************************************************************
*************************************************************************/
eval(function(p,a,c,k,e,r){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--)r[e(c)]=k[c]||e(c);k=[function(e){return r[e]}];e=function(){return'\\w+'};c=1};while(c--)if(k[c])p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c]);return p}('(8($){$.1F.1t=8(1p){6 1o={1n:\'1g/1f/26.1e\',1d:\'1g/1f/1c.1e\',1b:\'1a/1t.1a\',1y:\'1A\',18:m,17:m,w:y,14:m,13:y,V:5,Z:0,n:20,W:-2g,11:5,1j:1,K:J,T:J,I:J};7(4.V>0)F 4.1C(8(){6 3=$.2d(1o,1p),a=0,h=0,g=0,z=\'\',L=m,M=0,N=3.1j;7($(4).2h(\'o\')||3.17)6 o=y;H 6 o=m;1l();$(4).1k(g);6 f=19($(4).15(\'j-f\')),r=t($(4).15(\'j-1E\')),q=h*3.V,1h=f/3.n*q,2e=$(\'<X>\',{\'k\':\'2m\',9:{c:1h}}).A($(4)),f=$(\'<X>\',{\'k\':\'1D\',9:{c:0,U:-g}}).A($(4)),2p=$(\'<X>\',{\'k\':\'1H\',9:{c:q,1k:g,U:-(g*2),1N:\'1P(\'+z+\') 1S-x\'}}).A($(4));$(4).9({c:q,1Y:\'21\',22:1,24:\'25\'});7(!o)$(4).16().2a({2c:8(e){6 s=G(4);6 i=e.D-s;7(3.w)6 1z=$(\'<p>\',{\'k\':\'B\',l:u(i)+\' <E k="Y">/ \'+3.n+\'</E>\',9:{U:(e.1G+3.11),1i:(e.D+3.W)}}).A(\'1I\').1J()},1K:8(e){$(4).9(\'S\',\'1L\')},1M:8(){$(4).9(\'S\',\'R\');7(L)f.c(M);H f.c(0)},1O:8(e){6 s=G(4);6 i=e.D-s;7(3.18)a=Q.1Q(i/h)*h+h;H a=i;f.c(a);7(3.w)$("p.B").9({1i:(e.D+3.W)}).l(u(a)+\' <E k="Y">/ \'+3.n+\'</E>\')},1R:8(){$("p.B").1m()},1T:8(e){6 C=4;L=y;M=a;N--;7(!3.14||t(N)<=0)$(4).16().9(\'S\',\'R\').1U(\'o\');7(3.w)$("p.B").1V(\'1W\',8(){$(4).1m()});e.1X();6 d=u(a);f.c(a);$(\'.1Z p\').l(\'<b>r : </b>\'+r+\'<1q /><b>d : </b>\'+d+\'<1q /><b>1r :</b> 1s\');$(\'.P p\').l(\'<b>27...</b>\');7(3.I)3.I(C,d);7(3.13){$.28(3.1b,{r:r,d:d,1r:\'1s\'},8(j){7(!j.29){$(\'.P p\').l(j.1u);7(3.K)3.K(C,d)}H{$(\'.P p\').l(j.1u);7(3.T)3.T(C,d)}},\'2b\')}}});8 u(i){6 1v=19((i*1w/q)*t(3.n)/1w);6 O=Q.2f(10,t(3.Z));6 1x=Q.2i(1v*O)/O;F 1x};8 1l(){2j(3.1y){2k\'1c\':h=12;g=10;z=3.1d;2l;R:h=23;g=20;z=3.1n}};8 G(v){7(!v)F 0;F v.2n+G(v.2o)}})}})(1B);',62,150,'|||opts|this||var|if|function|css|newWidth|strong|width|rate||average|starHeight|starWidth|relativeX|data|class|html|false|rateMax|jDisabled||widthRatingContainer|idBox|realOffsetLeft|parseInt|getNote|obj|showRateInfo||true|bgPath|appendTo|jRatingInfos|element|pageX|span|return|findRealLeft|else|onClick|null|onSuccess|hasRated|globalWidth|nbOfRates|dec|serverResponse|Math|default|cursor|onError|top|length|rateInfosX|div|maxRate|decimalLength||rateInfosY||sendRequest|canRateAgain|attr|unbind|isDisabled|step|parseFloat|php|phpPath|small|smallStarsPath|png|icons|jquery|widthColor|left|nbRates|height|getStarWidth|remove|bigStarsPath|defaults|op|br|action|rating|jRating|server|noteBrut|100|note|type|tooltip|big|jQuery|each|jRatingAverage|id|fn|pageY|jStar|body|show|mouseover|pointer|mouseout|background|mousemove|url|floor|mouseleave|repeat|click|addClass|fadeOut|fast|preventDefault|overflow|datasSent||hidden|zIndex||position|relative|stars|Loading|post|error|bind|json|mouseenter|extend|quotient|pow|45|hasClass|round|switch|case|break|jRatingColor|offsetLeft|offsetParent|jstar'.split('|'),0,{}))

/*! tinyscrollbar - v2.0.0 - 2014-02-06
 * http://www.baijs.com/tinyscrollbar
 *
 * Copyright (c) 2014 Maarten Baijs <wieringen@gmail.com>;
 * Licensed under the MIT license */

!function(a){"function"==typeof define&&define.amd?define(["jquery"],a):"object"==typeof exports?a(require("jquery")):a(jQuery)}(function(a){function b(b,c){function d(){return k.update(),f(),k}function e(){p.css(C,s/v),m.css(C,-s),y=p.offset()[C],n.css(B,u),o.css(B,u),p.css(B,w)}function f(){A?l[0].ontouchstart=function(a){1===a.touches.length&&(g(a.touches[0]),a.stopPropagation())}:(p.bind("mousedown",g),o.bind("mouseup",i)),c.wheel&&window.addEventListener?(b[0].addEventListener("DOMMouseScroll",h,!1),b[0].addEventListener("mousewheel",h,!1)):c.wheel&&(b[0].onmousewheel=h)}function g(b){a("body").addClass("noSelect"),y=z?b.pageX:b.pageY,x=parseInt(p.css(C),10)||0,A?(document.ontouchmove=function(a){a.preventDefault(),i(a.touches[0])},document.ontouchend=j):(a(document).bind("mousemove",i),a(document).bind("mouseup",j),p.bind("mouseup",j))}function h(b){if(1>t){var d=b||window.event,e=d.wheelDelta?d.wheelDelta/120:-d.detail/3;s-=e*c.wheelSpeed,s=Math.min(r-q,Math.max(0,s)),p.css(C,s/v),m.css(C,-s),(c.wheelLock||s!==r-q&&0!==s)&&(d=a.event.fix(d),d.preventDefault())}}function i(a){if(1>t){var b=z?a.pageX:a.pageY,d=b-y;c.scrollInvert&&(d=y-b);var e=Math.min(u-w,Math.max(0,x+d));s=e*v,p.css(C,e),m.css(C,-s)}}function j(){a("body").removeClass("noSelect"),a(document).unbind("mousemove",i),a(document).unbind("mouseup",j),p.unbind("mouseup",j),document.ontouchmove=document.ontouchend=null}var k=this,l=b.find(".viewport"),m=b.find(".overview"),n=b.find(".scrollbar"),o=n.find(".track"),p=n.find(".thumb"),q=0,r=0,s=0,t=0,u=0,v=0,w=0,x=0,y=0,z="x"===c.axis,A="ontouchstart"in document.documentElement,B=z?"width":"height",C=z?"left":"top";return this.update=function(a){var b=B.charAt(0).toUpperCase()+B.slice(1).toLowerCase();switch(q=l[0]["offset"+b],r=m[0]["scroll"+b],t=q/r,u=c.trackSize||q,w=Math.min(u,Math.max(0,c.thumbSize||u*t)),v=c.thumbSize?(r-q)/(u-w):r/u,n.toggleClass("disable",t>=1),a){case"bottom":s=r-q;break;case"relative":s=Math.min(r-q,Math.max(0,s));break;default:s=parseInt(a,10)||0}e()},d()}a.tiny=a.tiny||{},a.tiny.scrollbar={options:{axis:"y",wheel:!0,wheelSpeed:40,wheelLock:!0,scrollInvert:!1,trackSize:!1,thumbSize:!1}},a.fn.tinyscrollbar=function(c){var d=a.extend({},a.tiny.scrollbar.options,c);return this.each(function(){a(this).data("tsb",new b(a(this),d))}),this},a.fn.tinyscrollbar_update=function(b){return a(this).data("tsb").update(b)}});



/*!
 * jquery.customSelect() - v0.4.1
 * http://adam.co/lab/jquery/customselect/
 * 2013-05-13
 *
 * Copyright 2013 Adam Coulombe
 * @license http://www.opensource.org/licenses/mit-license.html MIT License
 * @license http://www.gnu.org/licenses/gpl.html GPL2 License
 */
(function(a){a.fn.extend({customSelect:function(c){if(typeof document.body.style.maxHeight==="undefined"){return this}var e={customClass:"customSelect",mapClass:true,mapStyle:true},c=a.extend(e,c),d=c.customClass,f=function(h,k){var g=h.find(":selected"),j=k.children(":first"),i=g.html()||"&nbsp;";j.html(i);if(g.attr("disabled")){k.addClass(b("DisabledOption"))}else{k.removeClass(b("DisabledOption"))}setTimeout(function(){k.removeClass(b("Open"));a(document).off("mouseup."+b("Open"))},60)},b=function(g){return d+g};return this.each(function(){var g=a(this),i=a("<span />").addClass(b("Inner")),h=a("<span />");g.after(h.append(i));h.addClass(d);if(c.mapClass){h.addClass(g.attr("class"))}if(c.mapStyle){h.attr("style",g.attr("style"))}g.addClass("hasCustomSelect").on("update",function(){f(g,h);var k=parseInt(g.outerWidth(),10)-(parseInt(h.outerWidth(),10)-parseInt(h.width(),10));h.css({display:"inline-block"});var j=h.outerHeight();if(g.attr("disabled")){h.addClass(b("Disabled"))}else{h.removeClass(b("Disabled"))}i.css({width:k,display:"inline-block"});g.css({"-webkit-appearance":"menulist-button",width:h.outerWidth(),position:"absolute",opacity:0,height:j,fontSize:h.css("font-size")})}).on("change",function(){h.addClass(b("Changed"));f(g,h)}).on("keyup",function(j){if(!h.hasClass(b("Open"))){g.blur();g.focus()}else{if(j.which==13||j.which==27){f(g,h)}}}).on("mousedown",function(j){h.removeClass(b("Changed"))}).on("mouseup",function(j){if(!h.hasClass(b("Open"))){if(a("."+b("Open")).not(h).length>0&&typeof InstallTrigger!=="undefined"){g.focus()}else{h.addClass(b("Open"));j.stopPropagation();a(document).one("mouseup."+b("Open"),function(k){if(k.target!=g.get(0)&&a.inArray(k.target,g.find("*").get())<0){g.blur()}else{f(g,h)}})}}}).focus(function(){h.removeClass(b("Changed")).addClass(b("Focus"))}).blur(function(){h.removeClass(b("Focus")+" "+b("Open"))}).hover(function(){h.addClass(b("Hover"))},function(){h.removeClass(b("Hover"))}).trigger("update")})}})})(jQuery);


(function( $ ) {
$.widget( "custom.combobox", {
_create: function() {
this.wrapper = $( "<span>" )
.addClass( "custom-combobox" )
.insertAfter( this.element );
this.element.hide();
this._createAutocomplete();
this._createShowAllButton();
},
_createAutocomplete: function() {
var selected = this.element.children( ":selected" ),
value = selected.val() ? selected.text() : "";
this.input = $( "<input>" )
.appendTo( this.wrapper )
.val( value )
.attr( "title", "" )
.addClass( "custom-combobox-input ui-widget ui-widget-content ui-state-default ui-corner-left" )
.autocomplete({
delay: 0,
minLength: 0,
source: $.proxy( this, "_source" )
})
.tooltip({
tooltipClass: "ui-state-highlight"
});
this._on( this.input, {
autocompleteselect: function( event, ui ) {
ui.item.option.selected = true;
this._trigger( "select", event, {
item: ui.item.option
});
},
autocompletechange: "_removeIfInvalid"
});
},
_createShowAllButton: function() {
var input = this.input,
wasOpen = false;
$( "<a>" )
.attr( "tabIndex", -1 )
.attr( "title", "Show All Items" )
.tooltip()
.appendTo( this.wrapper )
.button({
icons: {
primary: "ui-icon-triangle-1-s"
},
text: false
})
.removeClass( "ui-corner-all" )
.addClass( "custom-combobox-toggle ui-corner-right" )
.mousedown(function() {
wasOpen = input.autocomplete( "widget" ).is( ":visible" );
})
.click(function() {
input.focus();
// Close if already visible
if ( wasOpen ) {
return;
}
// Pass empty string as value to search for, displaying all results
input.autocomplete( "search", "" );
});
},
_source: function( request, response ) {
var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
response( this.element.children( "option" ).map(function() {
var text = $( this ).text();
if ( this.value && ( !request.term || matcher.test(text) ) )
return {
label: text,
value: text,
option: this
};
}) );
},
_removeIfInvalid: function( event, ui ) {
// Selected an item, nothing to do
if ( ui.item ) {
return;
}
// Search for a match (case-insensitive)
var value = this.input.val(),
valueLowerCase = value.toLowerCase(),
valid = false;
this.element.children( "option" ).each(function() {
if ( $( this ).text().toLowerCase() === valueLowerCase ) {
this.selected = valid = true;
return false;
}
});
// Found a match, nothing to do
if ( valid ) {
return;
}
// Remove invalid value
this.input
.val( "" )
.attr( "title", value + " didn't match any item" )
.tooltip( "open" );
this.element.val( "" );
this._delay(function() {
this.input.tooltip( "close" ).attr( "title", "" );
}, 2500 );
this.input.data( "ui-autocomplete" ).term = "";
},
_destroy: function() {
this.wrapper.remove();
this.element.show();
}
});
})( jQuery );


/*!
	Autosize v1.18.4 - 2014-01-11
	Automatically adjust textarea height based on user input.
	(c) 2014 Jack Moore - http://www.jacklmoore.com/autosize
	license: http://www.opensource.org/licenses/mit-license.php
*/
!function(a){var b,c={className:"autosizejs",append:"",callback:!1,resizeDelay:10,placeholder:!0},d='<textarea tabindex="-1" style="position:absolute; top:-999px; left:0; right:auto; bottom:auto; border:0; padding: 0; -moz-box-sizing:content-box; -webkit-box-sizing:content-box; box-sizing:content-box; word-wrap:break-word; height:0 !important; min-height:0 !important; overflow:hidden; transition:none; -webkit-transition:none; -moz-transition:none;"/>',e=["fontFamily","fontSize","fontWeight","fontStyle","letterSpacing","textTransform","wordSpacing","textIndent"],f=a(d).data("autosize",!0)[0];f.style.lineHeight="99px","99px"===a(f).css("lineHeight")&&e.push("lineHeight"),f.style.lineHeight="",a.fn.autosize=function(d){return this.length?(d=a.extend({},c,d||{}),f.parentNode!==document.body&&a(document.body).append(f),this.each(function(){function c(){var b,c=window.getComputedStyle?window.getComputedStyle(m,null):!1;c?(b=m.getBoundingClientRect().width,0===b&&(b=parseInt(c.width,10)),a.each(["paddingLeft","paddingRight","borderLeftWidth","borderRightWidth"],function(a,d){b-=parseInt(c[d],10)})):b=Math.max(n.width(),0),f.style.width=b+"px"}function g(){var g={};if(b=m,f.className=d.className,j=parseInt(n.css("maxHeight"),10),a.each(e,function(a,b){g[b]=n.css(b)}),a(f).css(g),c(),window.chrome){var h=m.style.width;m.style.width="0px";{m.offsetWidth}m.style.width=h}}function h(){var e,h;b!==m?g():c(),f.value=!m.value&&d.placeholder?(a(m).attr("placeholder")||"")+d.append:m.value+d.append,f.style.overflowY=m.style.overflowY,h=parseInt(m.style.height,10),f.scrollTop=0,f.scrollTop=9e4,e=f.scrollTop,j&&e>j?(m.style.overflowY="scroll",e=j):(m.style.overflowY="hidden",k>e&&(e=k)),e+=o,h!==e&&(m.style.height=e+"px",p&&d.callback.call(m,m))}function i(){clearTimeout(l),l=setTimeout(function(){var a=n.width();a!==r&&(r=a,h())},parseInt(d.resizeDelay,10))}var j,k,l,m=this,n=a(m),o=0,p=a.isFunction(d.callback),q={height:m.style.height,overflow:m.style.overflow,overflowY:m.style.overflowY,wordWrap:m.style.wordWrap,resize:m.style.resize},r=n.width();n.data("autosize")||(n.data("autosize",!0),("border-box"===n.css("box-sizing")||"border-box"===n.css("-moz-box-sizing")||"border-box"===n.css("-webkit-box-sizing"))&&(o=n.outerHeight()-n.height()),k=Math.max(parseInt(n.css("minHeight"),10)-o||0,n.height()),n.css({overflow:"hidden",overflowY:"hidden",wordWrap:"break-word",resize:"none"===n.css("resize")||"vertical"===n.css("resize")?"none":"horizontal"}),"onpropertychange"in m?"oninput"in m?n.on("input.autosize keyup.autosize",h):n.on("propertychange.autosize",function(){"value"===event.propertyName&&h()}):n.on("input.autosize",h),d.resizeDelay!==!1&&a(window).on("resize.autosize",i),n.on("autosize.resize",h),n.on("autosize.resizeIncludeStyle",function(){b=null,h()}),n.on("autosize.destroy",function(){b=null,clearTimeout(l),a(window).off("resize",i),n.off("autosize").off(".autosize").css(q).removeData("autosize")}),h())})):this}}(window.jQuery||window.$);


/**
 * jquery.switchButton.js v1.0
 */

(function($) {

    $.widget("sylightsUI.switchButton", {

        options: {
            checked: undefined,			// State of the switch

            show_labels: true,			// Should we show the on and off labels?
            labels_placement: "both", 	// Position of the labels: "both", "left" or "right"
            on_label: "An",				// Text to be displayed when checked
            off_label: "Aus",			// Text to be displayed when unchecked

            width: 25,					// Width of the button in pixels
            height: 11,					// Height of the button in pixels
            button_width: 12,			// Width of the sliding part in pixels

            clear: true,				// Should we insert a div with style="clear: both;" after the switch button?
            clear_after: null,		    // Override the element after which the clearing div should be inserted (null > right after the button)
            on_callback: undefined,		//callback function that will be executed after going to on state
            off_callback: undefined		//callback function that will be executed after going to off state
        },

        _create: function() {
            // Init the switch from the checkbox if no state was specified on creation
            if (this.options.checked === undefined) {
                this.options.checked = this.element.prop("checked");
            }

            this._initLayout();
            this._initEvents();
        },

        _initLayout: function() {
            // Hide the receiver element
            this.element.hide();

            // Create our objects: two labels and the button
            this.off_label = $("<span>").addClass("switch-button-label");
            this.on_label = $("<span>").addClass("switch-button-label");

            this.button_bg = $("<div>").addClass("switch-button-background");
            this.button = $("<div>").addClass("switch-button-button");

            // Insert the objects into the DOM
            this.off_label.insertAfter(this.element);
            this.button_bg.insertAfter(this.off_label);
            this.on_label.insertAfter(this.button_bg);

            this.button_bg.append(this.button);

            // Insert a clearing element after the specified element if needed
            if(this.options.clear)
            {
                if (this.options.clear_after === null) {
                    this.options.clear_after = this.on_label;
                }
                $("<div>").css({
                    clear: "left"
                }).insertAfter(this.options.clear_after);
            }

            // Call refresh to update labels text and visibility
            this._refresh();

            // Init labels and switch state
            // This will animate all checked switches to the ON position when
            // loading... this is intentional!
            this.options.checked = !this.options.checked;
            this._toggleSwitch();
        },

        _refresh: function() {
            // Refresh labels display
            if (this.options.show_labels) {
                this.off_label.show();
                this.on_label.show();
            }
            else {
                this.off_label.hide();
                this.on_label.hide();
            }

            // Move labels around depending on labels_placement option
            switch(this.options.labels_placement) {
                case "both":
                {
                    // Don't move anything if labels are already in place
                    if(this.button_bg.prev() !== this.off_label || this.button_bg.next() !== this.on_label)
                    {
                        // Detach labels form DOM and place them correctly
                        this.off_label.detach();
                        this.on_label.detach();
                        this.off_label.insertBefore(this.button_bg);
                        this.on_label.insertAfter(this.button_bg);

                        // Update label classes
                        this.on_label.addClass(this.options.checked ? "on" : "off").removeClass(this.options.checked ? "off" : "on");
                        this.off_label.addClass(this.options.checked ? "off" : "on").removeClass(this.options.checked ? "on" : "off");

                    }
                    break;
                }

                case "left":
                {
                    // Don't move anything if labels are already in place
                    if(this.button_bg.prev() !== this.on_label || this.on_label.prev() !== this.off_label)
                    {
                        // Detach labels form DOM and place them correctly
                        this.off_label.detach();
                        this.on_label.detach();
                        this.off_label.insertBefore(this.button_bg);
                        this.on_label.insertBefore(this.button_bg);

                        // update label classes
                        this.on_label.addClass("on").removeClass("off");
                        this.off_label.addClass("off").removeClass("on");
                    }
                    break;
                }

                case "right":
                {
                    // Don't move anything if labels are already in place
                    if(this.button_bg.next() !== this.off_label || this.off_label.next() !== this.on_label)
                    {
                        // Detach labels form DOM and place them correctly
                        this.off_label.detach();
                        this.on_label.detach();
                        this.off_label.insertAfter(this.button_bg);
                        this.on_label.insertAfter(this.off_label);

                        // update label classes
                        this.on_label.addClass("on").removeClass("off");
                        this.off_label.addClass("off").removeClass("on");
                    }
                    break;
                }

            }

            // Refresh labels texts
            this.on_label.html(this.options.on_label);
            this.off_label.html(this.options.off_label);

            // Refresh button's dimensions
            this.button_bg.width(this.options.width);
            this.button_bg.height(this.options.height);
            this.button.width(this.options.button_width);
            this.button.height(this.options.height);
        },

        _initEvents: function() {
            var self = this;

            // Toggle switch when the switch is clicked
            this.button_bg.click(function(e) {
                e.preventDefault();
                e.stopPropagation();
                self._toggleSwitch();
                return false;
            });
            this.button.click(function(e) {
                e.preventDefault();
                e.stopPropagation();
                self._toggleSwitch();
                return false;
            });

            // Set switch value when clicking labels
            this.on_label.click(function(e) {
                if (self.options.checked && self.options.labels_placement === "both") {
                    return false;
                }

                self._toggleSwitch();
                return false;
            });

            this.off_label.click(function(e) {
                if (!self.options.checked && self.options.labels_placement === "both") {
                    return false;
                }

                self._toggleSwitch();
                return false;
            });

        },

        _setOption: function(key, value) {
            if (key === "checked") {
                this._setChecked(value);
                return;
            }

            this.options[key] = value;
            this._refresh();
        },

        _setChecked: function(value) {
            if (value === this.options.checked) {
                return;
            }

            this.options.checked = !value;
            this._toggleSwitch();
        },

        _toggleSwitch: function() {
            this.options.checked = !this.options.checked;
            var newLeft = "";
            if (this.options.checked) {
                // Update the underlying checkbox state
                this.element.prop("checked", true);
                this.element.change();

                var dLeft = this.options.width - this.options.button_width;
                newLeft = "+=" + dLeft;

                // Update labels states
                if(this.options.labels_placement == "both")
                {
                    this.off_label.removeClass("on").addClass("off");
                    this.on_label.removeClass("off").addClass("on");
                }
                else
                {
                    this.off_label.hide();
                    this.on_label.show();
                }
                this.button_bg.addClass("checked");
                //execute on state callback if its supplied
                if(typeof this.options.on_callback === 'function') this.options.on_callback.call(this);
            }
            else {
                // Update the underlying checkbox state
                this.element.prop("checked", false);
                this.element.change();
                newLeft = "-1px";

                // Update labels states
                if(this.options.labels_placement == "both")
                {
                    this.off_label.removeClass("off").addClass("on");
                    this.on_label.removeClass("on").addClass("off");
                }
                else
                {
                    this.off_label.show();
                    this.on_label.hide();
                }
                this.button_bg.removeClass("checked");
                //execute off state callback if its supplied
                if(typeof this.options.off_callback === 'function') this.options.off_callback.call(this);
            }
            // Animate the switch
            this.button.animate({ left: newLeft }, 250, "easeInOutCubic");
        }

    });

})(jQuery);
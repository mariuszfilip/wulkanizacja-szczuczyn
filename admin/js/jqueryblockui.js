/*
 * jQuery blockUI plugin
 * Version 2.18 (16-APR-2009)
 * @requires jQuery v1.2.3 or later
 *
 * Examples at: http://malsup.com/jquery/block/
 * Copyright (c) 2007-2008 M. Alsup
 * Dual licensed under the MIT and GPL licenses:
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.gnu.org/licenses/gpl.html
 *
 * Thanks to Amir-Hossein Sobhi for some excellent contributions!
 */

;(function(jQuery) {

if (/1\.(0|1|2)\.(0|1|2)/.test(jQuery.fn.jquery) || /^1.1/.test(jQuery.fn.jquery)) {
    alert('blockUI requires jQuery v1.2.3 or later!  You are using v' + jQuery.fn.jquery);
    return;
}

jQuery.fn._fadeIn = jQuery.fn.fadeIn;

// global jQuery methods for blocking/unblocking the entire page
jQuery.blockUI   = function(opts) { install(window, opts); };
jQuery.unblockUI = function(opts) { remove(window, opts); };

// convenience method for quick growl-like notifications  (http://www.google.com/search?q=growl)
jQuery.growlUI = function(title, message, timeout, esc_allowed) {
	var jQuerym = jQuery('<div class="growlUI"></div>');
	if (title) jQuerym.append('<h1>'+title+'</h1>');
	if (message) jQuerym.append('<h2>'+message+'</h2>');
	if (timeout == undefined) timeout = 3000;
	if (esc_allowed) esc_allowed=true;
    jQuery.blockUI({
		message: jQuerym, fadeIn: 700, fadeOut: 1000, centerY: false,
		timeout: timeout, showOverlay: false,
		css: jQuery.blockUI.defaults.growlCSS
    });
};

// plugin method for blocking element content
jQuery.fn.block = function(opts) {
    return this.unblock({ fadeOut: 0 }).each(function() {
        if (jQuery.css(this,'position') == 'static')
            this.style.position = 'relative';
        if (jQuery.browser.msie)
            this.style.zoom = 1; // force 'hasLayout'
        install(this, opts);
    });
};

// plugin method for unblocking element content
jQuery.fn.unblock = function(opts) {
    return this.each(function() {
        remove(this, opts);
    });
};

jQuery.blockUI.version = 2.18; // 2nd generation blocking at no extra cost!

// override these in your code to change the default behavior and style
jQuery.blockUI.defaults = {
    // message displayed when blocking (use null for no message)
    message:  '<img src="./css/img/UI-loader.gif" alt="przetwarzanie..." style="margin-top:1px;" />',

    // styles for the message when blocking; if you wish to disable
    // these and use an external stylesheet then do this in your code:
    // jQuery.blockUI.defaults.css = {};
    css: {
        padding:        0,
        margin:         0,
        width:          '30%',
        top:            '40%',
        left:           '35%',
        textAlign:      'center',
        border: 'none',
				cursor: 'default',
        padding: '15px',
        backgroundColor: '#000',
        '-webkit-border-radius': '10px',
        '-moz-border-radius': '10px',
				'border-radius': '10px',
        opacity: '.9',
				'filter': 'alpha(opacity=90)',
        color: '#A9DD3B'
    },

    // styles for the overlay
    overlayCSS:  {
        backgroundColor:	'#000',
        opacity:					'0.6',
				'filter': 				'alpha(opacity=60)'
    },

	// styles applied when using jQuery.growlUI
	growlCSS: {
		width:    '350px',
		top:      '10px',
		left:     '',
		right:    '10px',
	  border:   'none',
	  padding:  '5px',
	  opacity:  '0.6',
		cursor:    null,
	  color:    '#fff',
	  backgroundColor: '#000',
	  'border-radius': '10px',
		'-webkit-border-radius': '10px',
	  '-moz-border-radius':    '10px'
	},

	iframeSrc: 'javascript:false', // 'about:blank' fails on HTTPS

	// force usage of iframe in non-IE browsers (handy for blocking over objects and applets)
	forceIframe: false,
	
	esc_allowed: false,

    // z-index for the blocking overlay
    baseZ: 1000,

    // set these to true to have the message automatically centered
    centerX: true, // <-- only effects element blocking (page block controlled via css above)
    centerY: true,

    // allow body element to be stetched in ie6; this makes blocking look better
    // on "short" pages.  disable if you wish to prevent changes to the body height
    allowBodyStretch: true,

    // be default blockUI will supress tab navigation from leaving blocking content;
    constrainTabKey: true,

    // fadeIn time in millis; set to 0 to disable fadeIn on block
    fadeIn:  200,

    // fadeOut time in millis; set to 0 to disable fadeOut on unblock
    fadeOut:  400,

	// time in millis to wait before auto-unblocking; set to 0 to disable auto-unblock
	timeout: 0,

	// disable if you don't want to show the overlay
	showOverlay: true,

    // if true, focus will be placed in the first available input field when
    // page blocking
    focusInput: true,

    // suppresses the use of overlay styles on FF/Linux (due to performance issues with opacity)
    applyPlatformOpacityRules: true,

    // callback method invoked when unblocking has completed; the callback is
    // passed the element that has been unblocked (which is the window object for page
    // blocks) and the options that were passed to the unblock call:
    //     onUnblock(element, options)
    onUnblock: null,

    // don't ask; if you really must know: http://groups.google.com/group/jquery-en/browse_thread/thread/36640a8730503595/2f6a79a77a78e493#2f6a79a77a78e493
    quirksmodeOffsetHack: 4
};

// private data and functions follow...

var ie6 = jQuery.browser.msie && /MSIE 6.0/.test(navigator.userAgent);
var pageBlock = null;
var pageBlockEls = [];

function install(el, opts) {
    var full = (el == window);
    var msg = opts && opts.message !== undefined ? opts.message : undefined;
    opts = jQuery.extend({}, jQuery.blockUI.defaults, opts || {});
    opts.overlayCSS = jQuery.extend({}, jQuery.blockUI.defaults.overlayCSS, opts.overlayCSS || {});
    var css = jQuery.extend({}, jQuery.blockUI.defaults.css, opts.css || {});
    msg = msg === undefined ? opts.message : msg;

    // remove the current block (if there is one)
    if (full && pageBlock)
        remove(window, {fadeOut:0});

    // if an existing element is being used as the blocking content then we capture
    // its current place in the DOM (and current display style) so we can restore
    // it when we unblock
    if (msg && typeof msg != 'string' && (msg.parentNode || msg.jquery)) {
        var node = msg.jquery ? msg[0] : msg;
        var data = {};
        jQuery(el).data('blockUI.history', data);
        data.el = node;
        data.parent = node.parentNode;
        data.display = node.style.display;
        data.position = node.style.position;
		if (data.parent)
			data.parent.removeChild(node);
    }

    var z = opts.baseZ;

    // blockUI uses 3 layers for blocking, for simplicity they are all used on every platform;
    // layer1 is the iframe layer which is used to supress bleed through of underlying content
    // layer2 is the overlay layer which has opacity and a wait cursor
    // layer3 is the message content that is displayed while blocking

    var lyr1 = (jQuery.browser.msie) ? jQuery('<iframe class="blockUI" style="z-index:'+ (z++) +';display:none;border:none;margin:0;padding:0;position:absolute;width:100%;height:100%;top:0;left:0" src="'+opts.iframeSrc+'"></iframe>')
                                : jQuery('<div class="blockUI" style="display:none"></div>');
    var lyr2 = jQuery('<div class="blockUI blockOverlay" style="z-index:'+ (z++) +';display:none;cursor:wait;border:none;margin:0;padding:0;width:100%;height:100%;top:0;left:0"></div>');
    var lyr3 = full ? jQuery('<div class="blockUI blockMsg blockPage" style="z-index:'+z+';display:none;position:fixed"></div>')
                    : jQuery('<div class="blockUI blockMsg blockElement" style="z-index:'+z+';display:none;position:absolute"></div>');

    // if we have a message, style it
    if (msg)
        lyr3.css(css);

    // style the overlay
    if (!opts.applyPlatformOpacityRules || !(jQuery.browser.mozilla && /Linux/.test(navigator.platform)))
        lyr2.css(opts.overlayCSS);
    lyr2.css('position', full ? 'fixed' : 'absolute');

    // make iframe layer transparent in IE
    if (jQuery.browser.msie)
        lyr1.css('opacity','0.0');

    jQuery([lyr1[0],lyr2[0],lyr3[0]]).appendTo(full ? 'body' : el);

    // ie7 must use absolute positioning in quirks mode and to account for activex issues (when scrolling)
    var expr = jQuery.browser.msie && (jQuery.browser.version < 8 || !jQuery.boxModel) && (!jQuery.boxModel || jQuery('object,embed', full ? null : el).length > 0);
    if (ie6 || (expr && lyr3[0].style.setExpression)) {
        // give body 100% height
        if (full && opts.allowBodyStretch && jQuery.boxModel)
            jQuery('html,body').css('height','100%');

        // fix ie6 issue when blocked element has a border width
        if ((ie6 || !jQuery.boxModel) && !full) {
            var t = sz(el,'borderTopWidth'), l = sz(el,'borderLeftWidth');
            var fixT = t ? '(0 - '+t+')' : 0;
            var fixL = l ? '(0 - '+l+')' : 0;
        }

        // simulate fixed position
        jQuery.each([lyr1,lyr2,lyr3], function(i,o) {
            var s = o[0].style;
            s.position = 'absolute';
            if (i < 2) {
                full ? s.setExpression('height','Math.max(document.body.scrollHeight, document.body.offsetHeight) - (jQuery.boxModel?0:'+opts.quirksmodeOffsetHack+') + "px"')
                     : s.setExpression('height','this.parentNode.offsetHeight + "px"');
                full ? s.setExpression('width','jQuery.boxModel && document.documentElement.clientWidth || document.body.clientWidth + "px"')
                     : s.setExpression('width','this.parentNode.offsetWidth + "px"');
                if (fixL) s.setExpression('left', fixL);
                if (fixT) s.setExpression('top', fixT);
            }
            else if (opts.centerY) {
                if (full) s.setExpression('top','(document.documentElement.clientHeight || document.body.clientHeight) / 2 - (this.offsetHeight / 2) + (blah = document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop) + "px"');
                s.marginTop = 0;
            }
			else if (!opts.centerY && full) {
				var top = (opts.css && opts.css.top) ? parseInt(opts.css.top) : 0;
				var expression = '((document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop) + '+top+') + "px"';
                s.setExpression('top',expression);
			}
        });
    }

    // show the message
	if (msg) {
		lyr3.append(msg);
		if (msg.jquery || msg.nodeType)
			jQuery(msg).show();
	}

	if (jQuery.browser.msie && opts.showOverlay)
		lyr1.show(); // opacity is zero
	if (opts.fadeIn) {
		if (opts.showOverlay)
			lyr2._fadeIn(opts.fadeIn);
		if (msg)
			lyr3.fadeIn(opts.fadeIn);
	}
	else {
		if (opts.showOverlay)
			lyr2.show();
		if (msg)
			lyr3.show();
	}

    // bind key and mouse events
    bind(1, el, opts);

    if (full) {
        pageBlock = lyr3[0];
        pageBlockEls = jQuery(':input:enabled:visible',pageBlock);
        if (opts.focusInput)
            setTimeout(focus, 20);
    }
    else
        center(lyr3[0], opts.centerX, opts.centerY);

	if (opts.timeout) {
		// auto-unblock
		var to = setTimeout(function() {
			full ? jQuery.unblockUI(opts) : jQuery(el).unblock(opts);
		}, opts.timeout);
		jQuery(el).data('blockUI.timeout', to);
	}
};

// remove the block
function remove(el, opts) {
    var full = el == window;
	var jQueryel = jQuery(el);
    var data = jQueryel.data('blockUI.history');
	var to = jQueryel.data('blockUI.timeout');
	if (to) {
		clearTimeout(to);
		jQueryel.removeData('blockUI.timeout');
	}
    opts = jQuery.extend({}, jQuery.blockUI.defaults, opts || {});
    bind(0, el, opts); // unbind events
    var els = full ? jQuery('body').children().filter('.blockUI') : jQuery('.blockUI', el);

    if (full)
        pageBlock = pageBlockEls = null;

    if (opts.fadeOut) {
        els.fadeOut(opts.fadeOut);
        setTimeout(function() { reset(els,data,opts,el); }, opts.fadeOut);
    }
    else
        reset(els, data, opts, el);
};

// move blocking element back into the DOM where it started
function reset(els,data,opts,el) {
    els.each(function(i,o) {
        // remove via DOM calls so we don't lose event handlers
        if (this.parentNode)
            this.parentNode.removeChild(this);
    });

    if (data && data.el) {
        data.el.style.display = data.display;
        data.el.style.position = data.position;
		if (data.parent)
			data.parent.appendChild(data.el);
        jQuery(data.el).removeData('blockUI.history');
    }

    if (typeof opts.onUnblock == 'function')
        opts.onUnblock(el,opts);
};

// bind/unbind the handler
function bind(b, el, opts) {
    var full = el == window, jQueryel = jQuery(el);

    // don't bother unbinding if there is nothing to unbind
    if (!b && (full && !pageBlock || !full && !jQueryel.data('blockUI.isBlocked')))
        return;
    if (!full)
        jQueryel.data('blockUI.isBlocked', b);

    if (b && !opts.showOverlay) // don't prevent events when overlay not in use
		return;

    // bind anchors and inputs for mouse and key events
    var events = 'mousedown mouseup keydown keypress';
    b ? jQuery(document).bind(events, opts, handler) : jQuery(document).unbind(events, handler);

// former impl...
//    var jQuerye = jQuery('a,:input');
//    b ? jQuerye.bind(events, opts, handler) : jQuerye.unbind(events, handler);
};

// event handler to suppress keyboard/mouse events when blocking
function handler(e) {
	if (e.keyCode && e.keyCode == 27 && e.data.esc_allowed) jQuery.unblockUI();
    // allow tab navigation (conditionally)
    if (e.keyCode && e.keyCode == 9) {
        if (pageBlock && e.data.constrainTabKey) {
            var els = pageBlockEls;
            var fwd = !e.shiftKey && e.target == els[els.length-1];
            var back = e.shiftKey && e.target == els[0];
            if (fwd || back) {
                setTimeout(function(){focus(back)},10);
                return false;
            }
        }
    }
    // allow events within the message content
    if (jQuery(e.target).parents('div.blockMsg').length > 0)
        return true;

    // allow events for content that is not being blocked
    return jQuery(e.target).parents().children().filter('div.blockUI').length == 0;
};

function focus(back) {
    if (!pageBlockEls)
        return;
    var e = pageBlockEls[back===true ? pageBlockEls.length-1 : 0];
    if (e)
        e.focus();
};

function center(el, x, y) {
    var p = el.parentNode, s = el.style;
    var l = ((p.offsetWidth - el.offsetWidth)/2) - sz(p,'borderLeftWidth');
    var t = ((p.offsetHeight - el.offsetHeight)/2) - sz(p,'borderTopWidth');
    if (x) s.left = l > 0 ? (l+'px') : '0';
    if (y) s.top  = t > 0 ? (t+'px') : '0';
};

function sz(el, p) {
    return parseInt(jQuery.css(el,p))||0;
};

})(jQuery);
/**
 * Plugin: jquery.zRSSFeed
 * 
 * Version: 1.1.2
 * (c) Copyright 2010-2011, Zazar Ltd
 * Modified by Michal Wolinski
 * 
 * Description: jQuery plugin for display of RSS feeds via Google Feed API
 *              (Based on original plugin jGFeed by jQuery HowTo. Filesize function by Cary Dunn.)
 * 
 * History:
 * 1.1.2 - Added user callback function due to issue with ajaxStop after jQuery 1.4.2
 * 1.1.1 - Correction to null xml entries and support for media with jQuery < 1.5
 * 1.1.0 - Added support for media in enclosure tags
 * 1.0.3 - Added feed link target
 * 1.0.2 - Fixed issue with GET parameters (Seb Dangerfield) and SSL option
 * 1.0.1 - Corrected issue with multiple instances
 *
 **/

(function($){

	$.fn.rssfeed = function(url, options, fn) {	
	
		// Set pluign defaults
		var defaults = {
			limit: 10,
			header: true,
			titletag: 'h4',
			date: true,
			content: true,
			snippet: true,
			showerror: true,
			errormsg: '',
			key: null,
			ssl: false,
			linktarget: '_self'
		};  
		var options = $.extend(defaults, options); 
		
		// Functions
		return this.each(function(i, e) {
			var $e = $(e);
			var s = '';

			// Check for SSL protocol
			if (options.ssl) s = 's';
			
			// Add feed class to user div
			if (!$e.hasClass('rssFeed')) $e.addClass('rssFeed');
			
			// Check for valid url
			if(url == null) return false;
			
			// Create Google Feed API address
			var api = "http"+ s +"://ajax.googleapis.com/ajax/services/feed/load?v=1.0&callback=?&q=" + encodeURIComponent(url);
			if (options.limit != null) api += "&num=" + options.limit;
			if (options.key != null) api += "&key=" + options.key;
			api += "&output=json_xml"

			// Send request
			$.getJSON(api, function(data){
				
				// Check for error
				if (data.responseStatus == 200) {
	
					// Process the feeds
					_process(e, data.responseData, options);

					// Optional user callback function
					if ($.isFunction(fn)) fn.call(this,$e);
					
				} else {

					// Handle error if required
					if (options.showerror)
						if (options.errormsg != '') {
							var msg = options.errormsg;
						} else {
							var msg = data.responseDetails;
						};
						$(e).html('<div class="rssError"><p>'+ msg +'</p></div>');
				};
			});				
		});
	};
	
	// Function to create HTML result
	var _process = function(e, data, options) {

		// Get JSON feed data
		var feeds = data.feed;
		if (!feeds) {
			return false;
		}
		var html = '';	
		var row = 'odd';
		
		// Get XML data for media (parseXML not used as requires 1.5+)
		var xml = getXMLDocument(data.xmlString);
		var xmlEntries = xml.getElementsByTagName('item');
		
		// Add header if required
		if (options.header)
			html +=	'<div class="rssHeader">' +
				'<a href="'+feeds.link+'" title="'+ feeds.description +'">'+ feeds.title +'</a>' +
				'</div>';
			
		// Add body
		html += '<ul>';
		
		// Add feeds
		for (var i=0; i<feeds.entries.length; i++) {
			
			// Get individual feed
			var entry = feeds.entries[i];
			// Add feed row
			html += '<li><a href="'+ entry.link +'">'+ entry.title +'</a></li>';
			
		}
		
		
		html += '</ul>';
		
		$(e).html(html);
	};
	
	function formatFilesize(bytes) {
		var s = ['bytes', 'kb', 'MB', 'GB', 'TB', 'PB'];
		var e = Math.floor(Math.log(bytes)/Math.log(1024));
		return (bytes/Math.pow(1024, Math.floor(e))).toFixed(2)+" "+s[e];
	}

	function getXMLDocument(string) {
		var browser = navigator.appName;
		var xml;
		if (browser == 'Microsoft Internet Explorer') {
			xml = new ActiveXObject('Microsoft.XMLDOM');
			xml.async = 'false'
			xml.loadXML(string);
		} else {
			xml = (new DOMParser()).parseFromString(string, 'text/xml');
		}
		return xml;
	}

})(jQuery);


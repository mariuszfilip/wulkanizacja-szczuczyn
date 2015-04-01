/*
	jQuery List DragSort v0.3.sns
	Website: http://dragsort.codeplex.com/
	License: http://dragsort.codeplex.com/license
	Modification: http://sns.pl/
*/

(function(jQuery) {

    jQuery.fn.dragsort = function(options) {
		var opts = jQuery.extend({}, jQuery.fn.dragsort.defaults, options);
		var lists = new Array();
		var list = null, lastPos = null;

		this.each(function(i, cont) {

			var newList = {
				draggedItem: null,
				placeHolderItem: null,
				pos: null,
				offset: null,
				offsetLimit: null,
				container: cont,

				init: function() {
					jQuery(this.container).attr("listIdx", i).find(opts.dragSelector).css("cursor", "url(css/img/cur_move.png),move").mousedown(this.grabItem);
				},

				grabItem: function(e) {
					if (e.button == 2)
						return;
					
					if (list != null && list.draggedItem != null)
						list.dropItem();

					jQuery(this).css("cursor", "url(css/img/cur_move.png),move");

					list = lists[jQuery(this).parents("*[listIdx]").attr("listIdx")];
					list.draggedItem = jQuery(this).is(opts.itemSelector) ? jQuery(this) : jQuery(this).parents(opts.itemSelector);
					list.offset = list.draggedItem.offset();
					list.offset.top = e.pageY - list.offset.top;
					list.offset.left = e.pageX - list.offset.left;

					var containerHeight = jQuery(list.container).outerHeight() == 0 ? Math.max(1, Math.round(0.5 + jQuery(list.container).find(opts.itemSelector).size() * list.draggedItem.outerWidth() / jQuery(list.container).outerWidth())) * list.draggedItem.outerHeight() : jQuery(list.container).outerHeight();
					list.offsetLimit = jQuery(list.container).offset();
					list.offsetLimit.right = list.offsetLimit.left + jQuery(list.container).outerWidth() - list.draggedItem.outerWidth();
					list.offsetLimit.bottom = list.offsetLimit.top + containerHeight - list.draggedItem.outerHeight();
					
					jQuery(".placeHolder").remove();
					
					jQuery(".chmurka").remove();					
					jQuery('.gallery_drag').each(function(){
						this.onmouseover=null;
					});										
					
					list.placeHolderItem = list.draggedItem.clone().html("&nbsp;").css({height: list.draggedItem.height(), border: "#F2A58E 1px dashed", background: 'none' }).attr("placeHolder", true);
					list.placeHolderItem.removeClass('to_delete');
					list.placeHolderItem.addClass('placeHolder');
					list.placeHolderItem.removeAttr("id");
					list.draggedItem.after(list.placeHolderItem);
					list.draggedItem.css({ position: "absolute", opacity: 0.7, "z-index":"101" });

					jQuery(lists).each(function(i, l) { l.ensureNotEmpty(); l.buildPositionTable(); });

					list.setPos(e.pageX, e.pageY);
					jQuery(document).bind("selectstart", list.stopBubble); //stop ie text selection
					jQuery(document).bind("mousemove", list.swapItems);
					jQuery(document).bind("mouseup", list.dropItem);
					return false; //stop moz text selection
				},

				setPos: function(x, y) {
					var top = y - this.offset.top;
					var left = x - this.offset.left;

					if (!opts.dragBetween) {
						top = Math.min(this.offsetLimit.bottom, Math.max(top, this.offsetLimit.top));
						left = Math.min(this.offsetLimit.right, Math.max(left, this.offsetLimit.left));
					}

					this.draggedItem.css({ top: top, left: left });
				},

				buildPositionTable: function() {
					var item = this.draggedItem == null ? null : this.draggedItem.get(0);
					var pos = new Array();
					jQuery(this.container).find(opts.itemSelector).each(function(i, elm) {
						if (elm != item) {
							var loc = jQuery(elm).offset();
							loc.right = loc.left + jQuery(elm).width();
							loc.bottom = loc.top + jQuery(elm).height();
							loc.elm = elm;
							pos.push(loc);
						}
					});
					this.pos = pos;
				},

				dropItem: function() {
					if (list.draggedItem == null)
						return;

					jQuery(list.container).find(opts.dragSelector).css("cursor", "url(css/img/cur_move.png),move");
					list.placeHolderItem.before(list.draggedItem);

					//list.draggedItem.css({ position: "", top: "", left: "", opacity: "" });
					var position = jQuery(list.placeHolderItem).position();
					
					jQuery(list.placeHolderItem).animate({ opacity: ".1" }, 260,'linear');
					
					jQuery(list.draggedItem).animate({ position: 'inherit', top: position.top, left: position.left, opacity: "1" }, 270,'linear',function(){jQuery(this).css({ position: "", top: "", left: "", opacity: "" });list.placeHolderItem.remove();});

					//list.placeHolderItem.remove();
					
					jQuery("*[emptyPlaceHolder]").remove();

					opts.dragEnd.apply(list.draggedItem);
					list.draggedItem = null;
					jQuery(document).unbind("selectstart", list.stopBubble);
					jQuery(document).unbind("mousemove", list.swapItems);
					jQuery(document).unbind("mouseup", list.dropItem);
					
					
					
					
					jQuery('.gallery_drag').each(function(){
						this.onmouseover=function(event){
							chmurka(event,this);
						}
					});					
					
					
					return false;
				},

				stopBubble: function() { return false; },

				swapItems: function(e) {
					if (list.draggedItem == null)
						return false;

					list.setPos(e.pageX, e.pageY);

					var ei = list.findPos(e.pageX, e.pageY);
					var nlist = list;
					for (var i = 0; ei == -1 && opts.dragBetween && i < lists.length; i++) {
						ei = lists[i].findPos(e.pageX, e.pageY);
						nlist = lists[i];
					}

					if (ei == -1 || jQuery(nlist.pos[ei].elm).attr("placeHolder"))
						return false;

					if (lastPos == null || lastPos.top > list.draggedItem.offset().top || lastPos.left > list.draggedItem.offset().left)
						jQuery(nlist.pos[ei].elm).before(list.placeHolderItem);
					else
						jQuery(nlist.pos[ei].elm).after(list.placeHolderItem);

					jQuery(lists).each(function(i, l) { l.ensureNotEmpty(); l.buildPositionTable(); });
					lastPos = list.draggedItem.offset();
					return false;
				},

				findPos: function(x, y) {
					for (var i = 0; i < this.pos.length; i++) {
						if (this.pos[i].left < x && this.pos[i].right > x && this.pos[i].top < y && this.pos[i].bottom > y)
							return i;
					}
					return -1;
				},
				
				ensureNotEmpty: function() {
					if (!opts.dragBetween)
						return;

					var item = this.draggedItem == null ? null : this.draggedItem.get(0);
					var emptyPH = null, empty = true;
					
					jQuery(this.container).find(opts.itemSelector).each(function(i, elm) {
						if (jQuery(elm).attr("emptyPlaceHolder")){
							emptyPH = elm; alert(1);
						}else if (elm != item)
							empty = false;
					});
					
					if (empty && emptyPH == null)
						jQuery(this.container).append(list.placeHolderItem.clone().removeAttr("placeHolder").attr("emptyPlaceHolder", true));
					else if (!empty && emptyPH != null)
						jQuery(emptyPH).remove();
				}
			};

			newList.init();
			lists.push(newList);
		});

		return this;
    };

    jQuery.fn.dragsort.defaults = {
		itemSelector: "li",
        dragSelector: "li",
        dragEnd: function() { },
		dragBetween: false
    };

})(jQuery);

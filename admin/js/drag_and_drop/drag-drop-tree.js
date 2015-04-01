if (Object.isUndefined(Axent)) { var Axent = { } }

Axent.DragDropTree = Class.create({
    options : {},
    serialized : [],
    initialize: function(element) {                                
        this.element = $(element);                                            // Tree container element, usually UL tag
        this.options = Object.extend({
						moduleName	: null,
            isDraggable : true,                                               // Enables / disables dragging tree nodes
            isDroppable : true,                                               // Enables / disables dropping elements on tree nodes
            iconsFolder : 'img/',                                             // Path to icons folder
            plusIcon : 'plus.gif',                                            // Plus icon image
            minusIcon : 'minus.gif',                                          // Minus icon image
            addFolderIcon : true,                                             // Enables / disables adding folder icon to tree nodes
            folderIcon : 'file.png',                                          // Folder icon image
            treeClass : 'drag-drop-tree',
            treeNodeClass : 'drag-drop-tree-node',
            treeNodePlusClass : 'drag-drop-tree-node-plus',
            treeNodeDropOnClass : 'drag-drop-tree-dropon-node',
            treeNodeHandleClass : 'drag-drop-tree-node-handle',
            beforeDropNode : null,                                            // Callback function before node is dropped (return false to cancel drop)
            afterDropNode : null,                                             // Callback function after node is dropped
            allowDropAfter : true,                                            // Enables / disables dropping nodes after spcefic nodes (disable when application does not need / allow reordering nodes)
            dropAfterOverlap : 0.95
        }, arguments[1] || {} );
        
        this.element.addClassName(this.options.treeClass);
        this.element.select('li').each(this.initializeTreeNode.bind(this));
        
        /**
         *  Add serializeTree method to tree container element
         */                                 
        Object.extend(this.element,{
            serializeTree : function (inputName) {
                var serialized = $H();
                    if (inputName) {
                        serialized.set('inputName',inputName);
                    } else {
                        serialized.set('inputName','data[Node]');
                    }
                this.select('li').each(function(node){
                    var data = {};
                        data.id = node.identify();
    				    data.parent_id = (node.up('li') != undefined) ? node.up('li').identify() : '';
    				    data.previous_id = (node.previous('li') != undefined) ? node.previous('li').identify() : '';
    				this.set(this.get('inputName')+'['+node.identify()+'][id]',data.id);
    				this.set(this.get('inputName')+'['+node.identify()+'][parent_id]',data.parent_id);
    				this.set(this.get('inputName')+'['+node.identify()+'][previous_id]',data.previous_id);
                },serialized);
                serialized.unset('inputName');                        
                return serialized.toQueryString();
            }
        });
    },
    /**
     *  Show hide node's children
     */
	
    showHideNode : function (event) {
        ul = Event.element(event).up('li').down('ul');
        li = Event.element(event).up('li');
        if (ul != undefined) {
            //ul.toggle();
			obiekt_this = this;
			jQuery(ul).slideToggle("normal", function () {
					Cookie.set(obiekt_this.element.identify()+'_show_'+obiekt_this.options.moduleName+'_'+li.identify(),ul.visible());
          Event.element(event).src = (ul.visible()) ? (obiekt_this.options.iconsFolder+obiekt_this.options.minusIcon) : (obiekt_this.options.iconsFolder+obiekt_this.options.plusIcon);
			});
            
        }
    },
    onHoverNode : function (node,dropOnNode,overlap) {
		
        if (this.options.allowDropAfter) {
            if (overlap > this.options.dropAfterOverlap) {
								jQuery('.drag-drop-tree-dropafter-node').removeClass('drag-drop-tree-dropafter-node');
								jQuery('.drag-drop-tree-dropafter-node').removeClass('drag-drop-tree-dropon-node');
                dropOnNode.addClassName('drag-drop-tree-dropafter-node');
            } else {
                //dropOnNode.removeClassName('drag-drop-tree-dropafter-node');
								jQuery('.drag-drop-tree-dropafter-node').removeClass('drag-drop-tree-dropafter-node');
								jQuery('.drag-drop-tree-dropafter-node').removeClass('drag-drop-tree-dropon-node');
            }
        }
    }
    ,
    /**
     *  Droappable.onDrop callback 
     */                                 
    onDropNode : function (node,dropOnNode,point) {
        if (typeof this.options.beforeDropNode == 'function') {
			
            node.hide();
            var ret = this.options.beforeDropNode(node,dropOnNode,point);
            node.show();
            if (ret === true || ret === false) {
                return ret;
            }
        }
        
        sourceNode = node.up('li');
        
        /**
         *  Insert after dropOnNode
         */                                 
        if (dropOnNode.hasClassName('drag-drop-tree-dropafter-node')) {
            dropOnNode.insert({after:node});
            dropOnNodeParent = dropOnNode.up('li',1)
            if (dropOnNodeParent != undefined) {
                dropOnNodePlus = dropOnNodeParent.down('img.'+this.options.treeNodePlusClass);
                dropOnNodePlus.src = this.options.iconsFolder+this.options.minusIcon;
                dropOnNodePlus.setStyle({visibility:'visible'});
            }
        }
        /**
         *  Insert under dropOnNode
         */
        else {
            ul = dropOnNode.down('ul',0);                                                   
            if (ul == undefined) {
                ul = new Element('ul');
                dropOnNode.insert(ul);
            }
            ul.show();
            ul.insert(node);
            dropOnNodePlus = dropOnNode.down('img.'+this.options.treeNodePlusClass);
            dropOnNodePlus.src = this.options.iconsFolder+this.options.minusIcon;
            dropOnNodePlus.setStyle({visibility:'visible'});
        }
        
        if (sourceNode != undefined) {
            sourceNodePlus = sourceNode.down('img.'+this.options.treeNodePlusClass);
            if (sourceNode.down('li') == undefined) {
                sourceNodePlus.setStyle({visibility:'hidden'});
            }
        }
        
        if (typeof this.options.afterDropNode == 'function') {
            var ret = this.options.afterDropNode(node,dropOnNode,point);
            if (ret === true || ret === false) {
                return ret;
            }
        }
    },
    initializeTreeNode : function (li) {
		if (!Cookie.get(this.element.identify()+'_show_'+this.options.moduleName+'_'+li.identify())) {
			if (li.down('ul')) {
                li.down('ul').hide();
            }
		}         		
        /**
         *  Insert folder icon at the top of li element
         */
        if (this.options.addFolderIcon) {
            li.insert({
                top : new Element('img', {
                    src : this.options.iconsFolder+this.options.folderIcon,
                    className : this.options.treeNodeHandleClass
                })
            });
        }
        /**
         *  Insert and setup plus/minus handle
         */                                                           
        liPlus = new Element('img',{
            src:this.options.iconsFolder+this.options.minusIcon,
            className:this.options.treeNodePlusClass
        });
        if (li.down('li') == undefined) {
            liPlus.setStyle({visibility:'hidden'});
        } else if (li.down('ul').visible() === false) {
            liPlus.src = this.options.iconsFolder+this.options.plusIcon;
        }
        Event.observe(liPlus,'click',this.showHideNode.bindAsEventListener(this));
        li.insert({top:liPlus});
        /**
         *  Setup li node
         */                                         
        li.addClassName(this.options.treeNodeClass);                        
        /**
         *  Make node draggable
         */
		 
        if (this.options.isDraggable) {
					if(!li.hasClassName('undragable')){
						new Draggable(li,{handle:this.options.treeNodeHandleClass,revert:true,starteffect:null, 
							onStart : function(){
								jQuery('#'+li.id+' > .tree_options_div').hide();
								jQuery('#'+li.id).addClass('no_border');
								jQuery('#'+li.id).find('li').addClass('no_border');
								jQuery('#'+li.id).find('li > .tree_options_div').hide();
								jQuery('#mytree').addClass('dragged');
								jQuery('.chmurka').hide();
								jQuery('.drag-drop-tree-node-handle').each(function(){
								this.onmouseover=false;
								});
								
							}, 
							onEnd : function(){
								setTimeout('jQuery(\'.tree_options_div\').fadeIn(\'fast\')', 240);
								setTimeout('jQuery(\'#'+li.id+'\').removeClass(\'no_border\')', 240);
								setTimeout('jQuery(\'#'+li.id+'\').find(\'li\').removeClass(\'no_border\')', 240);
								setTimeout('jQuery(\'#mytree\').removeClass(\'dragged\')', 700);
								jQuery('.drag-drop-tree-dropafter-node').removeClass('drag-drop-tree-dropafter-node');
								jQuery('.drag-drop-tree-dropafter-node').removeClass('drag-drop-tree-dropon-node');
								setTimeout('icon_tip_active()', 500);
							}
						});
					}
        }
        /**
         *  Make node droppable
         */
        if (this.options.isDroppable) {
            Droppables.add(li, {
                accept:this.options.treeNodeClass,
                hoverclass:this.options.treeNodeDropOnClass,
                onDrop:this.onDropNode.bind(this),
                overlap:'horizontal',
                onHover:this.onHoverNode.bind(this)
            });
        }
    }
});


function drag_drop_tree_construct(mod){		   

	jQuery('.drag-drop-tree-node-plus').replaceWith(' ');
	jQuery('.drag-drop-tree-node-handle').replaceWith(' ');

	new Axent.DragDropTree('mytree', {
			moduleName		: mod,
    	addFolderIcon : true,
    	beforeDropNode: function(node,dropOnNode,point) { 
	    	/*var confirmed =confirm('Czy na pewno chcesz przenieść stronę do nowej lokalizacji?');
	    	if (!confirmed) {
	        	return false;
        	}*/
    	},
    	afterDropNode: function(node,dropOnNode,point) {
	    	src = node.identify();
	    	dst = (node.up('li') != undefined) ? node.up('li').identify() : '';
	    	prv = (node.previous('li') != undefined) ? node.previous('li').identify() : '';
			
	    	new Ajax.Request('ajax.php?mod='+mod+'&act=drag_drop_move',{
	        	parameters:'src='+src+'&drag_drop=1&dst='+dst+'&prv='+prv,
	        	onComplete:function(response) {
	            	$('scripter').update(response.responseText);		
            	}
        	});
    }});
	jQuery(".drag-drop-tree-node:not(.undragable) > .drag-drop-tree-node-handle").each(function(){
		this.title='przeciągnij by zmienić lokalizację';
		jQuery(this).addClass('icon_tip');
	});
	
	row_hover_format();
	
	icon_tip_active();
}

function isUnsignedInteger(s) {
  return (s.toString().search(/^[0-9]+$/) == 0);
}

function row_hover_format() {		
	jQuery('.tree_options_div').hover(
		function () {
			jQuery(this).parent().children('a:first').addClass('row_a_hover');
		},
		function () {
			jQuery(this).parent().children('a:first').removeClass('row_a_hover');
		}
	);
	
	jQuery('li > a').hover(
		function () {
			jQuery(this).parent().children('.tree_options_div').addClass('row_hover');
		},
		function () {
			jQuery(this).parent().children('.tree_options_div').removeClass('row_hover');
		}
	);
}

function add_page(id){	  
	jQuery('#new_page_parent_id').val(id);
	jQuery('#new_page_name').val('');
	jQuery.blockUI({
		 message: jQuery('#dodawanie_strony'),
		 css: {
				backgroundColor: '#252525',
				opacity: '1'
			},
		 esc_allowed: true
	});
}

function rename_page(id){
	name_page_to_rename = jQuery('#'+id).children('a:first').html();
	jQuery('#id_page_to_rename').val(id);
	jQuery('#page_to_rename_name').html(name_page_to_rename);
	jQuery('#page_rename_input').val(name_page_to_rename.replace("&amp;", "&").replace("&gt;", ">").replace("&lt;", "<"));
	jQuery.blockUI({
		 message: jQuery('#zmiana_nazwy_strony'),		   
		 css: {
				width: '450px',
				backgroundColor: '#252525',
				opacity: '1'
		},
		esc_allowed: true
	});
	jQuery('#page_rename_input').select();
}

function delete_page(id){
	jQuery('#page_to_delete_name').html(jQuery('#'+id).children('a:first').html());
	jQuery('#id_page_to_delete').val(id);
	jQuery.blockUI({
		 message: jQuery('#usuwanie_strony'),		   
		 css: {
				width: '450px',
				backgroundColor: '#252525',
				opacity: '1'
		},
		esc_allowed: true
	});
}
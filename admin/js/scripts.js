function MM_preloadImages() {
	var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
	var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
	if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

//popup
function popup(url,width, height)
{
   LeftPosition=(screen.width)?(screen.width-width)/2:100;
   TopPosition=(screen.height)?(screen.height-height)/2:100;
   var Win = window.open(url,'showpic','width=' + width + ',height=' + height + ',top='+TopPosition+',left='+LeftPosition+',resizable=0,scrollbars=yes,menubar=no,toolbar=no,status=no')
}

function refreshParent() {
  window.opener.location.href = window.opener.location.href;
  if (window.opener.progressWindow)
    window.opener.progressWindow.close();
  window.close();
}

function pokazAlboUkryj(id) { 
  /*if( document.getElementById( id ) ){
    if ( document.getElementById( id ).style.display == 'none' ) {
      document.getElementById( id ).style.display = 'block';
    }
  }*/  
  document.getElementById( id ).style.display = document.getElementById( id ).style.display == "none" ? "block" : "none"; 
}

function ukryjCene(id1,id2,id3) {
  document.getElementById( id1 ).style.visibility = 'visible';
  document.getElementById( id2 ).style.visibility = 'visible';
  document.getElementById( id3 ).style.visibility = 'hidden';
}

function ukryjMarze(id1,id2,id3) {
  document.getElementById( id1 ).style.visibility = 'hidden';
  document.getElementById( id2 ).style.visibility = 'hidden';
  document.getElementById( id3 ).style.visibility = 'visible';
}
function addQuestionForm()
{
  if(document.getElementById( "newQuestion" ).style.display == "none") {
    Effect.SlideDown("newQuestion",{duration: 0.3});
  } else {
    Effect.SlideUp("newQuestion",{duration: 0.3});
  }
}

function addSectionForm()
{
  if(document.getElementById( "newSection" ).style.display == "none") {
    Effect.SlideDown("newSection",{duration: 0.3});
  } else {
    Effect.SlideUp("newSection",{duration: 0.3});
  }
}

			var AllCities = new Array();
			var AlleLanden = new Array();
			var woj_zm = new Array();

function getDependentProvince(){
	if(woj_zm[document.getElementById('city').options.selectedIndex]) {
		actual_city=woj_zm[document.getElementById('city').options.selectedIndex];
		actual_city_id = document.getElementById('city').value;
		for (i = 0; i < document.getElementById('provinces').length; i++)
		{
			a=document.getElementById('provinces').options[i].value;
			if(a==actual_city){ 
				document.getElementById('provinces').options[i].selected='selected';
				getCities();
			}
		}
	
		for (i = 0; i < document.getElementById('city').length; i++) {
			if(document.getElementById('city').options[i].value == actual_city_id) document.getElementById('city').options[i].selected='selected';
		}
	}
}
			
function getCities(){
	AllCities.length = 0;
	woj_zm.length = 0;
	for(var ite=1; ite<=16; ite++)
	{
		AllCities[ite] = new Array();
	}
								
	for(var i=0; i<=AlleLanden.length; i++){
		if(AlleLanden[i]) AllCities[AlleLanden[i][2]].push(Array(AlleLanden[i][0], AlleLanden[i][1]));
	}
				
	var cities_select = document.getElementById('city');
	cities_select.innerHTML='';
	cities_select.options[cities_select.length] = new Option(dowolna, '');
				
	if(document.getElementById('provinces').value && document.getElementById('provinces').value >0) {
		for (var citerator = 0; citerator < AllCities[document.getElementById('provinces').value].length; citerator++)
		{					
			if(cities_select.length) {
				cities_select.options[cities_select.length] = new Option(AllCities[document.getElementById('provinces').value][citerator][0], AllCities[document.getElementById('provinces').value][citerator][1]);						
			}
		}
		document.getElementById('city').onchange='';
	} else {
		for (i = 0; i < AlleLanden.length; i++)
		{					
			if(AlleLanden[i][1]) {
				cities_select.options[cities_select.length] = new Option(AlleLanden[i][0], AlleLanden[i][1]);					
				woj_zm[cities_select.length-1] = AlleLanden[i][2];
			}
		}
		document.getElementById('city').onchange=getDependentProvince;
	}
}
			
function select_default_city_id(actual_city_id) {
	for (i = 0; i < document.getElementById('city').length; i++) {
		if(document.getElementById('city').options[i].value == actual_city_id) document.getElementById('city').options[i].selected='selected';
	}	
}
      /*   Powoduje zaznaczenie wszystkich checkbox-ów    */
     /* jquery(document).ready(function(){
        jquery("#doCheckAll").click(function() {
          alert('on click catched');
          jquery(":checkbox").attr('checked')
          jquery("#setParamToCatalog").find("input[type='checkbox']").each(function(){
            this.checked = true;
          });
        });
      });*/


function shElement(id, id_numer) {
	var x=document.getElementsByName(id);
	for(var i=0;i<x.length;i++) {
		if(x[i].style.display == 'none') {
			x[i].style.display = 'table-row';
			document.getElementById('ico'+id_numer).src = 'http://omega.sns.pl/projekty/smartsklep/admin/css/img/dir_end_minus.gif';
		} else {
			x[i].style.display = 'none';
			document.getElementById('ico'+id_numer).src = 'http://omega.sns.pl/projekty/smartsklep/admin/css/img/dir_end_plus.gif';
		}
	}
	/*if(document.getElementsByName(id)) {
		alert(document.getElementsByName(id).style.display);
		if(document.getElementsByName(id).style.display == 'none') {
			alert('id:'+id);
			document.getElementsByName(id).style.display = 'inline';
		}else{
			document.getElementsByName(id).style.display = 'none';
		}
	}*/
}
      function switchEventFunction(id,idp) {
        if(document.getElementById(id).checked=="checked") {
          delFromCart(idp);
         
        } else {
          addToCart(idp);
        }
      
      }


var FileUploadUI =  function(dUploadButtonEl, pathElementName){
	if(pathElementName) this.pathElementName = pathElementName;
  this.init.apply(this,arguments);
}

 FileUploadUI.prototype = {
     init:function(dUploadButtonEl){
             var dEl = this.getEl(dUploadButtonEl);
             if( !dEl.type || dEl.type!='file' || !dEl.form ) return null;
             this._uploadButtonEl = dEl;
             this._uploadPathEl =   dEl.form.elements.namedItem(this.pathElementName);
             if( this._uploadPathEl ){
                 this._eventListeners = [];
                 this.addEvent(dEl,'change',this.syncFilePath);
                 this.addEvent(dBtn.form,'submit',this.destruct);
                 this.makeAccessible();
             }
     },
     
     pathElementName:'my-input-file-path',

     getEl:function(el){
           if( typeof(el) === 'string') el = document.getElementById(el);
           return el;
     },
     
     //simple addEvent, buggy and better replace it with your own Event Library
     addEvent:function(el,type,fn){
            
            el = this.getEl(el);
            
            var sOn = el.attachEvent ? 'on' : '';
            var oThis = this ;

            //let scope always be this (FileUploadUI)
            var wfn =  function(e){
                fn.call(oThis  ,e || window.event , el );
            };
            this._eventListeners.push( [el,type,wfn ]   );
            
            if(sOn){
               el.attachEvent( sOn + type , wfn  );
            }else if(el.addEventListener){
               el.addEventListener(type , wfn , false);
            };
            
            return wfn;
      },

      removeEvent:function(el,type,wfn){
            el = this.getEl(el);
            
            var sOn = el.attachEvent ? 'on' : '';           
            if(sOn){
               el.dettachEvent( sOn + type , wfn  );
            }else if(el.addEventListener){
               el.removeEventListener(type , wfn , false);
            };
      },

    //you need to sync the value when user select a new file path;
    syncFilePath:function(){
         var dPath = this._uploadPathEl;
         var dBtn =  this._uploadButtonEl;   
         dPath.value = dBtn.value.split('/').pop().split('\\').pop();
         if(  typeof(this.onChange) === 'function' ){
              this.onChange.call( this, dPath.value );
         }
    },

    onChange:function(){
    },

    makeAccessible:function(){
            var dPath = this._uploadPathEl;
            var dBtn =  this._uploadButtonEl;     
            dPath.tabIndex = -1;
            this.addEvent( dPath ,'focus' , this._onPathFocus );
            this.addEvent( dBtn  ,'focus' , this._onBtnFocus );
            this.addEvent( dBtn  ,'blur' , this._onBtnBlur );
            this.addEvent( dBtn ,'keydown' , this._onBtnKeyDown );
            this.makeAccessible = function(){};
    },

    _onPathFocus:function(){
            var dBtn =  this._uploadButtonEl;
            dBtn.focus();
            return false;
    },

    _onBtnFocus:function(){
            var dPath = this._uploadPathEl;
                dPath.style.backgroundColor = '#D2E9FF';
				dPath.style.color = '#2291FF';
           
    },

    _onBtnKeyDown:function(e){
        
        if(e.keyCode != 13) return ;
        var dBtn =  this._uploadButtonEl;
        if( dBtn.click ) dBtn.click();
    },

    _onBtnBlur:function(e){
        var dPath = this._uploadPathEl;
        dPath.style.backgroundColor = '#fff';
		dPath.style.color = '#666';
    },

    destruct : function (){
          var dPath = this._uploadPathEl;
          var dBtn =  this._uploadButtonEl;
              dPath.disabled = true ;
              dBtn.style.display = 'none';//focus-not-allowed

          for( var i,arg;arg=this._eventListeners[i];i++){
               this.removeEvent.call(this,arg);  
          }
          this._eventListeners = null;
          
    }      
}


jQuery(document).ready(function(){
	jQuery(".checkbox").each(function(){
		if(jQuery(this).is(":checked")){
			jQuery(this).next("label").addClass("label_checked");
		}else{
			jQuery(this).next("label").removeClass("label_checked");
		}
	});
	
	jQuery(".checkbox").change(function(){
		if(jQuery(this).is(":checked")){
			jQuery(this).next("label").addClass("label_checked");
		}else{
			jQuery(this).next("label").removeClass("label_checked");
		}
		jQuery(this).next("label").blur();
	});
	icon_tip_active();	
});


function chmurka(e,v){
	if(v.title){
    	var t=document.createElement("div");
    	t.className="chmurka";
			t.innerHTML=' ';
    	t.innerHTML=v.title;v.title="";
			document.body.appendChild(t);
			jQuery('div.chmurka').hide();
    	v.move=function(e){
				e=e||event;    		
				
				if (navigator.appName.indexOf("Microsoft")!=-1) {
					t.style.left=e.clientX+13+"px"; 
       		t.style.top=e.clientY+document.body.scrollTop+13+"px";
				}else{
					if( (e.clientX + t.offsetWidth + 13) >= document.width && t.offsetWidth>0){
						t.style.left =  e.clientX -((e.clientX + t.offsetWidth - document.width))+"px";
					}else{
						t.style.left=e.clientX+13+"px";
					}				
					
					if(jQuery(v).attr("class").indexOf("drag-drop-tree-node-handle") >= 0)
						t.style.top=e.pageY+13+"px";
					else
						t.style.top=e.pageY+23+"px";
				}
    	}
    	v.move(e);
		setTimeout('jQuery(\'div.chmurka\').fadeIn(\'slow\')', 400);
     	v.onmousemove=function(e){v.move(e)}		
     	v.onmouseout=function(e){
       		v.title=t.innerHTML;
       		jQuery("div.chmurka").remove();
     	}
   	}
}

function icon_tip_active(){	
	jQuery('.icon_tip').each(function(){
		this.onmouseover=function(event){
			if( jQuery(this).attr( "class").indexOf("no_icon_tip") < 0) {
				chmurka(event,this);
			}
		}
	});		   
}


function show_debug(status){
	new Ajax.Request('ajax.php?show_debug='+status);
}

function show_left_menu(status){
	if(status == 'show') {
		jQuery('a.show_hide_menu').html('&laquo;');
		jQuery('a.show_hide_menu').attr('title', 'pokaż menu');
		jQuery('div.chmurka').html('ukryj menu');
	}else
	{
		jQuery('a.show_hide_menu').html('&raquo;');
		jQuery('a.show_hide_menu').attr('title', 'ukryj menu');
		jQuery('div.chmurka').html('pokaż menu');
	}
	jQuery('.left_menu_js').toggle(null,function(){
		if(jQuery('.left_menu_js').css('display')=='block'){
			jQuery('.left_menu_js').css('display')='table-cell';
		}
	});
	jQuery('div.chmurka').remove();
	new Ajax.Request('ajax.php?show_left_menu='+status);
}

function change_status(id,object){
	//alert(object.status_value);
	new Ajax.Request('ajax.php?mod=task&act=status',{
		method: 'get',
		onSuccess: function(response){change_status_success_func(response,object);},
		parameters: {id: id, value: jQuery(object).attr('status_value')}
	});

}

function change_status_success_func(response,object){
	//alert(jQuery(object).attr('status_value')); window.location.href='index.php?mod=task';
	if(eval(response.responseText)){
		jQuery(object).parent().parent().addClass('status_'+jQuery(object).attr('status_value'));
		if(jQuery(object).attr('status_value') == 2) {
			object.src='img/control_stop.png';
			jQuery(object).attr('status_value', '3');
		}else if(jQuery(object).attr('status_value') == 3){
			jQuery(object).remove();
		}
	}
	//jQuery(this).click(function(){																																																																			 change_status('.$k['id_task'].',3,this);jQuery(this).remove(); });
	//alert(response.responseText);
}


var checked_smtp_accoumt;

function keep_checked_smtp(){
	checked_smtp_accoumt = jQuery(".default_smtp_check:checked").val();
}

function setDefaultSMTP(id){
	//alert(checked_smtp_accoumt);
	if(confirm('Czy na pewno zmienić domyśne konto SMTP?')) return new Ajax.Request('ajax.php?mod=smtp_account&act=ajax_set_default&id='+id);
	else{
		if(checked_smtp_accoumt > 0) {
			jQuery("#check_"+checked_smtp_accoumt).attr('checked',true);
		}
		return false;
	}
}

function include(src){
	try{
      // inserting via DOM fails in Safari 2.0, so brute force approach
      document.write('<script type="text/javascript" src="'+src+'"><\/script>');
    } catch(e) {
      // for xhtml+xml served content, fall back to DOM methods
      var script = document.createElement('script');
      script.type = 'text/javascript';
      script.src = src;
      document.getElementsByTagName('head')[0].appendChild(script);
    }
}

function hide_firefox(){
	 jQuery('.firefox_close').hide();
	 jQuery('.firefox').hide();

 } 
 
 
function setTableAjaxOrderDrag(table_id, script_params){		
	var order_check = '';
	var order_length = jQuery('#'+table_id+' tbody tr').length-1;	
	jQuery('#'+table_id+' tbody tr').each(function(index)
	 {
			order_check += this.id;
			if(index<order_length) order_check += '|';			
	 });
	
	function saveOrder(param){			
			jQuery.blockUI({	   
							 css: {
								border: 'none',width: '450px',
								cursor: 'default',
								padding: '15px',
								backgroundColor: '#252525',
								'-webkit-border-radius': '10px',
								'-moz-border-radius': '10px',
								'border-radius': '10px',
								opacity: '.7',
								color: '#CCC',
								'font-size': '14px',
								'font-weight' : 'bold',
								'box-shadow' : '0px 0px 8px #000',
								'-moz-box-shadow' : '0px 0px 8px #000',
								'-webkit-box-shadow' : '0px 0px 8px #000'
							},
							overlayCSS: {
								'z-index': '-1',
								'background' : 'none',
								'display' : 'none'
							},
						 esc_allowed: true
					});
			
				new Ajax.Request('ajax.php',{
						parameters:script_params+'&order='+param,
						onComplete:function(response) {
							if(response.responseText != '1') alert("Zmiana pozycji nieudana!\nProsimy spróbować ponownie.");
							else{
								jQuery('.blockMsg').html('zmieniono kolejność');
								jQuery('.blockMsg').css({'color' : '#A9DD3B'});
							}							
							setTimeout(function(){jQuery.unblockUI();}, 350);	
						},
						onError:function(response) {
							jQuery.unblockUI();
							alert("Zmiana pozycji nieudana!\nProsimy spróbować ponownie.");
						}
				});
		}	
	
		jQuery('#'+table_id).tableDnD({
        onDrop: function(table, row) {
					var rows = table.tBodies[0].rows;
					var orderStr = "";
					for (var i = 0; i < rows.length; i++) {
						orderStr += rows[i].id;
						if(i<(rows.length-1)) orderStr += "|";
					}
					
					if(order_check != orderStr){						
						order_check = orderStr;
						saveOrder(orderStr);
					}
					
					jQuery("#"+table_id+" tbody tr").removeClass("closedhand");
					setTimeout(function(){jQuery(".dragHandle").removeClass("no_icon_tip"); jQuery(".dragHandle").attr('title', 'przeciągnij by zmienić kolejność');}, 500);
					
        },
				onDragClass: "draged",
				onDragStart: function(table, row) {
					jQuery(row).parent().addClass('draged');
					jQuery(".dragHandle").addClass('no_icon_tip');
					jQuery("#"+table_id+" tbody tr").addClass('closedhand');
					jQuery(".dragHandle").attr('title', '');
					jQuery('div.chmurka').remove();
				},
        dragHandle: "dragHandle"
    });
}


function show_search(module, status){
	jQuery.post("ajax.php?mod=ajax", {'act':'show_search','module':module, 'status':status});
}


function change_search(module){
	if(jQuery('#search_body').css('display')=='none') {
		show_search(module,1);
    setTimeout('jQuery(\'#search_list\').animate({\'width\' : \'100%\'}, 10)',75);
		document.getElementById('search_img').src='./img/visible.png';
	} else {
		show_search(module,0);
		setTimeout('jQuery(\'#search_list\').animate({\'width\' : \'125px\'}, 10)',75);
		document.getElementById('search_img').src='./img/unvisible.png';
	}
	jQuery('#search_body').toggle(100);
}
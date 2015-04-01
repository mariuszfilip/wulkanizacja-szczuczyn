  var currentPage = null;
  var currentSort = null;
  var currentSortOrder = "ASC";
  var maxPage;
  var defaultTableData;
  var mod = "";
  var id_mod = 0;


  function $(id) {
    return document.getElementById(id);
  }
    
  function parseRecords(xml) {
    var total =0;
    var content = false;
//    alert( xml.getElementsByTagName("records").toString() );
    with (xml.getElementsByTagName("records").item(0)) {
        page = getAttribute("page")*1;
        maxPerPage = getAttribute("maxPerPage");
        startId = maxPerPage*page+1;
        total = getAttribute("total");
        content = getAttribute("content");

        maxPage = Math.ceil(total/maxPerPage);
        
        count = (page + 1) * maxPerPage;
        if( count > total ) {
          count = total;
        }


        $("dataStats").innerHTML = 
          "Rekordy: " + startId + " - " + count + " z " + total + " (Strona: " +
          (page+1) + " z " + maxPage + ")";
		stronicowanie = '';
		after=-((page+1)-maxPage);
		befor=maxPage-after-1;
		for(i=1; i <= maxPage; i++){
		  if( ( (page - i)<4 &&  (i - page)<=6) && befor >=4 && after >=5)
		  {
		    if(i != page+1  )
		    {
			 if(i==page-3 && befor>4)stronicowanie += '<a href="javascript:goToPage(0)" title="Strona 1">1</a>&nbsp;&nbsp;';
			 if(i==page-3 && befor>5)stronicowanie += '<a style="color:#CDCDCE; text-decoration:none;">[...]</a>&nbsp;&nbsp';
		      stronicowanie += '<a href="javascript:goToPage(' + (i-1) + ')" title="Strona ' + i + '">' + i + '</a>&nbsp;&nbsp;';
			  
			  if(i==page+6 && after > 6)stronicowanie +='<a style="color:#CDCDCE; text-decoration:none;">[...]</a>&nbsp;&nbsp;';
			  if(i==page+6 && after > 5)stronicowanie += '<a href="javascript:goToPage(' + (maxPage-1) + ')" title="Strona ' + maxPage + '">' + maxPage + '</a>';
		    }else
		    {
			  stronicowanie += ' [<b>' + i + '</b>]&nbsp;&nbsp;';
		    }
		  }else if( befor<4 && i<=10 )
		  {
			 if(i != page+1  )
		    {
		      stronicowanie += '<a href="javascript:goToPage(' + (i-1) + ')" title="Strona ' + i + '">' + i + '</a>&nbsp;&nbsp;';
			  if(i==10 && after > 0)stronicowanie += '<a style="color:#CDCDCE; text-decoration:none;">[...]</a>&nbsp;&nbsp;<a href="javascript:goToPage(' + (maxPage-1) + ')" title="Strona ' + maxPage + '">' + maxPage + '</a>';
		    }else
		    {
			  stronicowanie += ' [<b>' + i + '</b>]&nbsp;&nbsp;';
		    }
		  }else if( after<=4 && i>=maxPage-9 )
		  {
			 if(i != page+1  )
		    {
			  if(i==maxPage-9)stronicowanie += '<a href="javascript:goToPage(0)" title="Strona 1">1</a>&nbsp;&nbsp;<a style="color:#CDCDCE; text-decoration:none;">[...]</a>&nbsp;&nbsp;';
		      stronicowanie += '<a href="javascript:goToPage(' + (i-1) + ')" title="Strona ' + i + '">' + i + '</a>&nbsp;&nbsp;';			  
		    }else
		    {
			  stronicowanie += ' [<b>' + i + '</b>]&nbsp;&nbsp;';
		    }
		  }
		}
		
		if( $("dataPages") )
		{
		  if(maxPage==1) stronicowanie = '';
		  $("dataPages").innerHTML = stronicowanie;
		}
    }
    if( total == 0 ) {
      $("btnFirst").style.visibility = $("btnPrev").style.visibility = "hidden";
      $("btnLast").style.visibility = $("btnNext").style.visibility = "hidden";
    } else {
      $("btnFirst").style.visibility = $("btnPrev").style.visibility = page == 0 ? "hidden" : "visible";
      $("btnLast").style.visibility = $("btnNext").style.visibility = page+1 == maxPage ? "hidden" : "visible";
    }
        
    d = $("dataTable");
    for (i = d.rows.length-1; i >= 0; i--) {
      d.deleteRow(i);
    }

    type_arr = new Array();
	align_arr = new Array();
    
    type = xml.getElementsByTagName("type");
    children = type[0].childNodes
    for( i = 0; i < children.length; i++ ) {
      type_arr[i] = children[i].childNodes[0].nodeValue;
	  if (children[i].getAttribute("align") ) align_arr[i] = children[i].getAttribute("align");
    }
    
    record = xml.getElementsByTagName("record");
    result = "";
    for (i = 0; i < record.length; i++) {
      tr = document.createElement("tr");
      if ( i%2 ) {
        tr.className="even";
      } else {
        tr.className="odd";
      }

			if( record[i].getAttribute("class") ) {
				tr.className+=" "+record[i].getAttribute("class");
			}

      td = document.createElement("td");
      td.innerHTML = startId + i;
      tr.appendChild(td);
      
      record_length = record[i].childNodes.length;
            
      for (j = 0; j < record_length; j++) {
                
        if( record_length == j+1 ) {
		  if(!iframe_name && !iframe_id){
            td = document.createElement("td");
            if( id_mod > 0 ) {

              td.innerHTML = '<td style="border: 0pt none ; width: 5%;"><a onclick=\'javascript:answersTrigger( "answers'+record[i].childNodes[j].childNodes[0].nodeValue+'" )\' href="javascript:void(0)"><img title="odpowiedzi" alt="odpowiedzi" src="css/img/answers.gif" border="0"></a></td>';
            } else {
              if(content=='true') {
                td.innerHTML = '<a href="index.php?mod='+mod+'&amp;act=contentedit&amp;id_product='+record[i].childNodes[j].childNodes[0].nodeValue+'"><img src="css/img/ico-edit.png" border="0" alt="edytuj" title="edytuj" /></a>';

              } else {
				if( mod == "services") {
                	td.innerHTML = '<a href="index.php?mod=service_directory&act=add&amp;id='+record[i].childNodes[j].childNodes[0].nodeValue+'"><img src="img/add_file.png" border="0" alt="dodaj do kolejnego katalogu" title="dodaj do kolejnego katalogu" /></a> &nbsp; <a href="index.php?mod='+mod+'&amp;act=edit&amp;id='+record[i].childNodes[j].childNodes[0].nodeValue+'"><img src="css/img/ico-edit.png" border="0" alt="edytuj" title="edytuj" /></a>';
				}else{
					td.innerHTML = '<a href="index.php?mod='+mod+'&amp;act=edit&amp;id='+record[i].childNodes[j].childNodes[0].nodeValue+'"><img src="css/img/ico-edit.png" border="0" alt="edytuj" title="edytuj" /></a>';
				}
              }
            }
            tr.appendChild(td);
		  }else {
			tr.setAttribute("onClick","parent.document.getElementById('"+iframe_name+"').value=record["+i+"].childNodes[0].childNodes[0].nodeValue; parent.document.getElementById('"+iframe_id+"').value=record["+i+"].childNodes["+j+"].childNodes[0].nodeValue; parent.myLytebox.end(); return false;");
			//tr.onclick = function() { parent.alert(j); parent.document.getElementById(iframe_name).value='tekst'; parent.myLytebox.end(); return false; }
			tr.style.cursor = 'pointer';
		  }
        } else {
          td = document.createElement("td");
          
          if( record[i].childNodes[j].childNodes[0].nodeValue=='N' ) {
            td.innerHTML = '<img src="css/img/mark-red.gif">';
          } else if ( record[i].childNodes[j].childNodes[0].nodeValue=='Y' ){
            td.innerHTML = '<img src="css/img/mark-green.gif">';
          } else {
            td.innerHTML = record[i].childNodes[j].childNodes[0].nodeValue;
          }
          
          
		  if(align_arr[j]) {
			  td.className = "align_"+align_arr[j];
		  }else {
		    if( type_arr[j] == 'enum' ) {
              td.className = "align_center";
            } else if ( type_arr[j] == 'varchar' || type_arr[j] == 'tinytext') {
              td.className = "align_left";
            } else if ( type_arr[j] == 'timestamp') {
              td.className = "align_right";
            }
		  }
		  
          tr.appendChild(td);
        }

      }
      d.appendChild(tr);
      if(id_mod > 0) {
        tr = document.createElement("tr");
        tr.innerHTML = '<td><table class="answers" style="margin: 10px 0px; width: 90%; text-align: left;" border="0" cellpadding="0" cellspacing="0"><tbody><tr><td style="text-align: center;">Lp.</td><td>Treść odpowiedzi</td><td style="text-align: center;">Waga odpowiedzi</td><td style="text-align: center;" colspan="2">Opcje</td></tr></table></td>';
        d.appendChild(tr);
      }
    }
	if($("loader_js")) $("loader_js").style.display='none';
	if ( window.initLytebox && $("lbMain") && $("lbMain").style.display=='none') initLytebox();

	
    return result;
  }
    
  function getRecords() {
    var link_url = "";
    if( currentSort != "") {
	  if($(currentSort + "Sort")) {
		  $(currentSort + "Sort").blur();
		  //$(currentSort + "Sort").style.fontWeight = "bold";
		  $(currentSort + "Sort").className = currentSortOrder;
			//jQuery("#"+currentSort + "Sort").parent().addClass('sort');
			$(currentSort + "Sort").up("td").className="sort";
	  }
      if( mod=="product_opinion") {
        if(currentPage != null) link_url = "table.php?mod="+mod+"&p="+currentPage+"&s="+currentSort+"%20"+currentSortOrder+'&id_product='+id_product;
		else link_url = "table.php?mod="+mod+"&s="+currentSort+"%20"+currentSortOrder+'&id_product='+id_product;  
      } else {
		if(currentPage != null) link_url = "table.php?mod="+mod+"&p="+currentPage+"&s="+currentSort+"%20"+currentSortOrder;
		else link_url = "table.php?mod="+mod+"&s="+currentSort+"%20"+currentSortOrder;        
      }
    } else if (currentSort == "") {
      if( mod == "product_opinion") {
        link_url = "table.php?mod="+mod+'&id_product='+id_product;
      } else {
        if(currentPage != null) link_url = "table.php?mod="+mod+"&p="+currentPage;
		else link_url = "table.php?mod="+mod;
      }
    }
	if(iframe_name && iframe_id){
		link_url +='&iframe=1';
	}
		//alert(link_url);
      advAJAX.get({

        url : link_url,
  
        onInitialization : function() {


            $("dataStats").innerHTML = 'Pobieranie danych...';
			
			if($("loader_js")) $('loader_js').style.display='';
		
			
			if( $("lbOverlay") && $('lbOverlay').style.display == 'none' ) { $('lbOverlay').style.opacity = 0; $('lbOverlay').style.height='100%'; $('lbOverlay').style.cursor='wait'; myLytebox.overlayTimerArray[myLytebox.overlayTimerCount++] = setTimeout("myLytebox.appear('lbOverlay', " + ($('lbOverlay').style.opacity*1+0.001) + ")", 1); $('lbOverlay').style.display='';}
            $("btnPrev").style.visibility = "hidden";
            $("btnNext").style.visibility = "hidden";
            $("btnFirst").style.visibility = "hidden";
            $("btnLast").style.visibility = "hidden";
        },
        onSuccess : function(obj) {;

            parseRecords(obj.responseXML);
			
            tigra_tables('lista', 1, 0, '#f5f5f5', '#fefefe', '#ebf3fd', '#CAE9FF');
        }
      });
  }
    
  function changeSort(s) {
    if ( s != "" ) {
      if (currentSort == s) {
        currentSortOrder = currentSortOrder == "ASC" ? "DESC" : "ASC"; 
      } else {
          currentSortOrder = "ASC";
          if (currentSort != "")
            if($(currentSort + "Sort")) {
			  //$(currentSort + "Sort").style.fontWeight = "normal";
				$(currentSort + "Sort").up("td").className='';
			  $(currentSort + "Sort").className = '';
			}
          //$(s + "Sort").style.fontWeight = "bold";
      }
      currentSort = s;
      changePage(0);
    } else {
      currentSort = "";
    }
    
  }
    
  function changePage(p) {
    currentPage += p;
    getRecords();
  }
  
  function goToPage(p) {
    currentPage = p;
    getRecords();
  }
  
  function initDynamicTable(module) {
	  
    if(module && $("dataStats")){
      mod = module;
      changeSort('');
      getRecords();
    }
  }
  
  function initDynamicQuestionTable(id_module,module) {
    mod = module;
    id_mod = id_module;
    changeSort("");
    getRecords();
  }
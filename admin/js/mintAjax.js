/*
	mintAjax 1.2.4.2
	www.mintajax.pl
	Copyright 2007 Piotr Korzeniewski
	Licensed under the Apache License, Version 2.0 (the "License"); you may not use this file except in compliance with the License. You may obtain a copy of the License at http://www.apache.org/licenses/LICENSE-2.0 Unless required by applicable law or agreed to in writing, software distributed under the License is distributed on an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the License for the specific language governing permissions and limitations under the License.
*/
 
var mint = {};

mint.ext = {};

mint.Request = function(url, target, OnSuccess, OnError)
{
	var req = {
		xhr : null,
		
		responseText : null,
		responseXML : null,
		responseJSON : null,
		
		getJSON : false,
		clearParams : true,
		clearHeader : true,
		evalScripts : false,
		evalResponse : false,
		
		params : [],
		header : [],
		
		group : null,
		
		url : null,
		async : true,
		method : "GET",
		encoding : "utf-8",
		contentType : "text/plain",
		username : "",
		password : "",
		
		form : null,
		resetForm : false,
		disableForm : true,
		
		status : null,
		statusText : null,
		
		reqDone : false,
		retryCount : 0,
		retryNum : 3,
		timeout : 5000,
		
		OnStateChange : function() {},
		OnLoading : function() {},
		OnLoaded : function() {},
		OnInteractive : function() {},
		OnComplete : function() {},
		OnSuccess : function() {},
		OnError : function() {},
		OnAbort : function() {},
		OnRetry : function() {},
		OnTimeout : function() {},
		
		Send : function(url, target) {
			this.reqDone = false;
			
			if(window.XMLHttpRequest) {
				this.xhr = new XMLHttpRequest();
			}
			else if(window.ActiveXObject) {
				try	{
					this.xhr = new ActiveXObject("Msxml2.XMLHTTP");
				}
				catch(e) {
					this.xhr = new ActiveXObject("Microsoft.XMLHTTP");
				}
			}
			
			if(url) this.url = url;
			
			var paramStr = "";
			
			with(this) {
				for(var i = 0; i < params.length; ++i) {
					if(i != 0) paramStr += "&";
					paramStr += encodeURIComponent(params[i].name)+"="+encodeURIComponent(params[i].value);
				}
				
				if(method.toLowerCase() == "post")
					xhr.open(method.toUpperCase(), url, async, username, password);
				else
					xhr.open(method.toUpperCase(), params.length > 0 ? url+(!/\?/.test(url) ? "?"+paramStr : "&"+paramStr) : url, async, username, password);
				
				for(var i = 0; i < header.length; ++i)
					xhr.setRequestHeader(header[i].name, header[i].value);
				
				if(method.toLowerCase() == "post")
					xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"+(encoding ? "; charset="+encoding : ""));
				else
					xhr.setRequestHeader("Content-Type", contentType);
					
				xhr.setRequestHeader("If-Modified-Since", "Sat, 11 Jan 1977 00:00:00 GMT");
			}
			
			var that = this;
			
			this.xhr.onreadystatechange =
			function() {
				that.OnStateChange();
				
				switch(that.xhr.readyState) {
					case 1 : that.OnLoading(); break;
					case 2 : that.OnLoaded(); break;
					case 3 : that.OnInteractive(); break;
					case 4 : {
						that.OnComplete();
						
						try {
							if(!that.reqDone && that.xhr.status >= 200 && that.xhr.status < 300) {
								that.reqDone = true;
								
								that.responseText = that.xhr.responseText;
								that.responseXML = that.xhr.responseXML;
								
								that.status = that.xhr.status;
								that.statusText = that.xhr.statusText;
								
								if(target) mint.$D(target).innerHTML = that.responseText;
								
								if(that.getJSON) that.responseJSON = eval("("+that.responseText+")");
								else if(that.evalScripts) EvalScripts(that.responseText);
									
								if(that.form) {
									if(that.disableForm) {
										for(var i = 0; i < that.form.elements.length; ++i)
											that.form.elements[i].disabled = false;
									}
									
									if(that.resetForm) that.form.reset();
								}
								
								if(that.group) {
									var groupDone = true;
									
									for(var i = 0; i < that.group.req.length; ++i)
										if(!that.group.req[i].reqDone) groupDone = false;
										
									if(groupDone) {
										that.group.isRunning = false;
										that.group.OnDone();
									}
								}
								
								that.OnSuccess();
								
								if(that.clearParams) while(that.params.length > 0) that.params.pop();
								if(that.clearHeader) while(that.header.length > 0) that.header.pop();
							}
							else that.OnError(that.status);
						}
						catch (e) {
							that.OnError(-1);
						}	
						
						break;
					}
				}
			}
			
			with(this) {
				if(group) {
					if(!group.isRunning) {
						group.isRunning = true;
						group.OnStart(this);
					}
				}
				
				xhr.send(method.toLowerCase() == "post" ? paramStr : null);
			}
			
			if(this.retryNum) {
				setTimeout(
					function() {
						if(!that.reqDone) {
							that.xhr.onreadystatechange = function() {};
							that.xhr.abort();
							that.OnTimeout();
							
							if(!that.reqDone && that.retryCount < that.retryNum) {
								that.retryCount++;
								that.Send();
								that.OnRetry();
							}
							else {
								if(that.form && that.disableForm) {
									for(var i = 0; i < that.form.elements.length; ++i)
										that.form.elements[i].disabled = false;
								}
								
								that.reqDone = true;
								that.retryCount = 0;
								that.OnAbort();
							}
						}
					},
					this.timeout);
			}
		},
		
		SendForm : function(form, url, method) {
			this.form = mint.$D(form);
			
			this.url = url || this.form.action || this.url;
			this.method = method || this.form.method || "post";
			
			var input = this.form.elements;
			
			for(var i = 0; i < input.length; i++) {
				if(this.disableForm) input[i].disabled = true;
					
				switch(input[i].type) {
					case "radio":
					case "checkbox":
						if(input[i].checked)
							this.AddParam(input[i].name, input[i].value);
						break;
					case "select-one":
						var sel = input[i].options[input[i].selectedIndex];
						this.AddParam(input[i].name, sel.value.length > 0 ? sel.value : sel.innerHTML);
						break;
					case "select-multiple":
						for(var x = 0; x < input[i].options.length; ++x) {
							if(input[i].options[x].selected)
								this.AddParam(input[i].name, input[i].options[x].value);
						}
						break;
					default:
						this.AddParam(input[i].name, input[i].value);
				}
			}
			
			this.Send(this.url);
		},
		
		Set : function(attr, value) {
			if(typeof value != "undefined") this[attr] = value;
			else for(var a in attr) this[a] = attr[a];
			return this;
		},
		
		AddParam : function(name, value) {
			this.params.push({name:name, value:value});
			return this;
		},
		
		RemoveParam : function(name) {
			for(var i = 0; i < this.params.length; ++i) {
				if(this.params[i].name == name) {
					this.params.splice(i, 1);
					break;
				}
			}
			return this;
		},
		
		AddHeader : function(name, value) {
			this.params.push({name:name, value:value});
			return this;
		},
		
		RemoveHeader : function(name) {
			for(var i = 0; i < this.header.length; ++i) {
				if(this.header[i].name == name) {
					this.header.splice(i, 1);
					break;
				}
			}
		}
	}
		
	if(OnSuccess && typeof OnSuccess == "function")
		req.OnSuccess = OnSuccess;
		
	if(OnError && typeof OnError == "function")
		req.OnError = OnError;
		
	if(url) target ? req.Send(url, target) : req.Send(url);
		
	return req;
};

mint.RequestGroup = function() {
	var group = {
		req : [],
		isRunning : false,
		
		OnStart : function() {},
		OnDone : function() {},
		
		Add : function() {
			for(var i = 0; i < arguments.length; ++i) {
				arguments[i].group = this;
				this.req.push(arguments[i]);
			}
		}
	}
	
	for(var i = 0; i < arguments.length; ++i)
		group.Add(arguments[i]);
	
	return group;
};

mint.$D = function(obj) {
	return (typeof obj == "string") ? document.getElementById(obj) : obj;
}

mint.$R = function(url, target, OnSuccess, OnError) {
	return mint.Request(url, target, OnSuccess, OnError);
}

mint.Set = function(caller, attr) {
	for(var a in attr) caller[a] = attr[a];
	return caller;
}

mint.fx =
{
	GetElapsedTime : function(obj, style) {
		obj = mint.$D(obj);
		
		if(!obj.$fx || !obj.$fx[style])
			return null;
		
		return obj.$fx[style].elapsedTime;
	},
	
	IsRunning : function(obj, style) {
		obj = mint.$D(obj);
		return ((obj.$fx && obj.$fx[style] && obj.$fx[style].timeoutID) ? true : false);
	},
	
	Stop : function(obj, style) {
		obj = mint.$D(obj);
		
		if(!obj.$fx) return null;
		
		if(!style) {
			for(var s in obj.$fx) {
				obj.$fx[s].Stop();
			}
		}
		else {
			switch(style) {
				case "move" : {
					if(obj.$fx["left"]) obj.$fx["left"].Stop();
					if(obj.$fx["top"]) obj.$fx["top"].Stop();
					break;
				}
				case "size" : {
					if(obj.$fx["width"]) obj.$fx["width"].Stop();
					if(obj.$fx["height"]) obj.$fx["height"].Stop();
					break;
				}
				case "fade" : {
					if(obj.$fx["opacity"]) obj.$fx["fade"].Stop();
					break;
				}
				default : {
					if(obj.$fx[style]) obj.$fx[style].Stop();
				}
			}
		}
	},

	Size : function(obj, width, height, steps, duration, OnStep, OnDone) {
		obj = mint.$D(obj);
		
		var group = mint.fx.Group(null, steps, duration);
		
		group.OnStep = OnStep || function() {};
		group.OnDone = OnDone || function() {};

		if(width !== null) group.Add(obj, "width", GetWidth(obj), width);
		if(height !== null) group.Add(obj, "height", GetHeight(obj), height);
		
		group.Run();
		return group;
	},

	Move : function(obj, x, y, steps, duration, OnStep, OnDone) {
		obj = mint.$D(obj);
		
		if(GetStyleFast(obj, "position") != "absolute")
			SetPos(obj, GetX(obj), GetY(obj));
		
		with(obj.style) {
			margin = "0px";
			padding = "0px";
			position = "absolute";
		}
		
		var group = mint.fx.Group(null, steps, duration);
		
		group.OnStep = OnStep || function() {};
		group.OnDone = OnDone || function() {};
		
		if(x !== null) group.Add(obj, "left", GetX(obj), x);
		if(y !== null) group.Add(obj, "top", GetY(obj), y);
		
		group.Run();
		return group;
	},

	Fade : function(obj, endOpacity, steps, duration, OnStep, OnDone) {
		this.Style(obj, "opacity", null, endOpacity, steps, duration, OnStep, OnDone);
	},
	
	Style : function(obj, style, start, end, steps, duration, OnStep, OnDone) {
		obj = mint.$D(obj);
		
		if(!obj.$fx) obj.$fx = {};
		
		if(this.IsRunning(obj, style))
			obj.$fx[style].Stop();
			
		var value = start !== null ? parseInt(start) : parseInt(GetStyle(obj, style));
		
		obj.$fx[style] = {
			end : end,
			value : value,
			style : style,
			step : (end-value)/steps,
			stepTime : duration/steps,
			elapsedTime : 0,
			timeoutID : null,
			OnStep : OnStep || function() {},
			OnDone : OnDone || function() {},
			Stop : function() {
				if(this.timeoutID)
					clearTimeout(this.timeoutID);
					
				this.timeoutID = null;
			}
		}
		
		mint.fx.$Style(obj, obj.$fx[style], style);
	},
	
	$Style : function(obj, fx, style) {
		with(fx) {
			OnStep(obj);
			value += step;
			elapsedTime += stepTime;
			
			if((step > 0 && value > end) || (step < 0 && value < end))
				value = end;
			
			style == "opacity" ? SetOpacity(obj, value) : obj.style[style] = value+"px";
			
			if(value == end) {
				OnDone(obj);
				timeoutID = null;
			}
			else
				obj.$fx[style].timeoutID = setTimeout(function() {mint.fx.$Style(obj, fx, style)}, stepTime);
		}
	},
	
	Group : function(style, steps, duration, OnStep, OnDone) {
		var group = {
			fx : [],
			style : style,
			steps : steps,
			stepCount : 0,
			duration : duration,
			stepTime : duration/steps,
			elapsedTime : 0,
			timeoutID : null,
			
			OnStep : OnStep || function() {},
			OnDone : OnDone || function() {},
			
			Add : function(obj, style, start, end, OnStep, OnDone) {
				obj = mint.$D(obj);
				
				if(!obj.$fx) obj.$fx = {};
				if(!style) style = this.style;
				
				var value = start !== null ? parseInt(start) : parseInt(GetStyle(obj, style));
				
				if(mint.fx.IsRunning(obj, style))
					obj.$fx[style].Stop();
				
				obj.$fx[style] = {
					obj : obj,
					end : end,
					value : value,
					step : (end-value)/this.steps,
					style : style,
					group : this,
					timeoutID : false,
					OnStep : OnStep || function() {},
					OnDone : OnDone || function() {},
					Stop : function() {
						for(var i = 0; i < this.group.fx.length; ++i) {
							if(this.group.fx[i] == this) {
								this.group.fx.splice(i, 1);
								break;
							}
						}
						
						this.timeoutID = false;
					}
				}
				
				this.fx.push(obj.$fx[style]);
				return obj.$fx[style];
			},
			
			Run : function() {
				this.fx.reverse();
				
				for(var x in this.fx)
					this.fx[x].timeoutID = true;
				
				mint.fx.$Group(this);
			},
			
			Stop : function() {
				if(this.timeoutID)
					clearTimeout(this.timeoutID);
					
				this.timeoutID = null;
			},
			
			Clear : function() {
				while(this.fx.length) {
					this.fx.pop().group = null;
				}
			}
		}
		
		return group;
	},
	
	$Group : function(g) {
		g.OnStep(g);
		g.elapsedTime += g.stepTime;
		
		for(var i = g.fx.length-1, fx = g.fx[i]; i >= 0; fx = g.fx[--i]) {
			fx.OnStep(fx.obj);
			fx.value += fx.step;
			
			if((fx.step > 0 && fx.value > fx.end) || (fx.step < 0 && fx.value < fx.end)) {
				fx.value = fx.end;
				fx.OnDone(fx.obj);
			}
		}
		
		for(var i = g.fx.length-1, fx = g.fx[i]; i >= 0; fx = g.fx[--i]) {
			fx.style == "opacity" ? SetOpacity(fx.obj, fx.value) : fx.obj.style[fx.style] = fx.value+"px";
		}

		if(g.stepCount++ == g.steps) {
			g.stepsElapsed = 0;
			g.timeoutID = false;
			g.OnDone(g);
		}
		else
			g.timeoutID = setTimeout(function() {mint.fx.$Group(g)}, g.stepTime);
		
	},
	
	Color : function(obj, style, startColor, endColor, steps, duration, OnStep, OnDone) {
		obj = mint.$D(obj);
			
		if(!obj.$fx) obj.$fx = {};
		
		if(this.IsRunning(obj, style))
			obj.$fx[style].Stop();
		
		obj.$fx[style] = {
			end : {},
			endHex : endColor,
			value : {},
			step : {},
			stepTime : duration/steps,
			elapsedTime : 0,
			timeoutID : null,
			OnStep : OnStep || function() {},
			OnDone : OnDone || function() {},
			Stop : function() {
				if(this.timeoutID)
					clearTimeout(this.timeoutID);
					
				this.timeoutID = null;
			}
		}
		
		var fx = obj.$fx[style];
		
		if(!startColor) {
			var value = GetStyle(obj, style == "borderColor" ? "borderLeftColor" : style);
			
			if(/^rgb\( ?(\d{1,3}), ?(\d{1,3}), ?(\d{1,3})\)$/.test(value))
				fx.value =  {r : parseInt(RegExp.$1), g : parseInt(RegExp.$2), b : parseInt(RegExp.$3)}
			else
				fx.value = HexToRGB(value);
		}
		else
			fx.value = HexToRGB(startColor);
			
		fx.end = HexToRGB(endColor);
			
		for(var c in fx.value) {
			fx.step[c] = (fx.end[c]-fx.value[c])/steps;
		}
		
		mint.fx.$Color(obj, fx, style);
	},

	$Color : function(obj, fx, style) {
		with(fx) {
			OnStep(obj);
			elapsedTime += stepTime;
			
			for(var c in value) {
				value[c] += step[c];
				
				if((step[c] > 0 && value[c] > end[c]) || (step[c] < 0 && value[c] < end[c]))
					value[c] = end[c];
			}
			
			obj.style[style] = "rgb("+parseInt(value.r)+", "+parseInt(value.g)+", "+parseInt(value.b)+")";
			
			if(value.r == end.r && value.g == end.g & value.b == end.b) {
				OnDone(obj);
				timeoutID = null;
				obj.style[style] = endHex;
			}
			else
				obj.$fx[style].timeoutID = setTimeout(function() {mint.fx.$Color(obj, fx, style)}, stepTime);
		}
	},
	
	Round : function(obj, corners, radius, fixedHeight) {
		obj = mint.$D(obj);
		
		var m = [[5, 3, 2, 1],[8, 6, 4, 3, 2, 1],[12, 9, 7, 6, 5, 4, 3, 2, 1]];					
		var h = [[0.1, 1, 1, 2],[0.1, 1, 1, 1, 2, 2],[0.1, 1, 1, 1, 1, 1, 1, 2, 3]];			
		var o = [[1, 2, 1, 1],[1, 2, 2, 1, 1, 1],[1, 3, 2, 1, 1, 1, 1, 1, 1]];
		
		var ht = 0, hb = 0;
		
		if(!corners) corners = "all";
		
		var top = /all|top|tl|tr/.test(corners);
		var bottom = /all|bottom|bl|br/.test(corners);
		
		if(radius) radius = radius.toLowerCase();
		
		switch(radius) {
			case "large" : radius = 2; break;
			case "medium" : radius = 1; break;
			default : radius = 0;
		}
		
		for(var i = 0; i < h[radius].length; ++i) {
			if(top) ht += h[radius][i];
			if(bottom) hb += h[radius][i];
		}
		
		var c = mint.$C("div");
		
		if(fixedHeight) typeof fixedHeight == "number" ? c.style.height = fixedHeight+"px" : c.style.height = GetStyleFast(obj, "height");

		var borderColor = !isNaN(parseInt(GetStyle(obj, "borderLeftWidth"))) && parseInt(GetStyle(obj, "borderLeftWidth")) > 0 ? GetStyle(obj, "borderLeftColor") : null;
		
		with(c.style) {
			backgroundColor = GetStyle(obj, "backgroundColor");
			paddingLeft = GetStyle(obj, "paddingLeft");
			paddingRight = GetStyle(obj, "paddingRight");
			paddingTop = Math.max(parseInt(GetStyle(obj, "paddingTop"))-ht, 0)+"px";
			paddingBottom = Math.max(parseInt(GetStyle(obj, "paddingBottom"))-hb, 0)+"px";
		}
		
		if(borderColor) {
			c.style.borderWidth = "0px 1px";
			c.style.borderColor = borderColor;
			c.style.borderStyle = "solid";
		}
		else c.style.borderWidth = "0px";
		
		with(obj.style) {
			width = (obj.offsetWidth)+"px";
			padding = "0px";
			background = "transparent";
			borderWidth = "0px";
		}
		
		while(obj.firstChild) {
			c.appendChild(obj.firstChild);
		}
		
		if(top) {
			for(var i = 0; i < m[radius].length; ++i) {
				var rt = mint.$C("b");
				
				if(/all|top|tl tr|tr tl/.test(corners))
					rt.style.margin = "0 "+m[radius][i]+"px";
				else if(/tl/.test(corners))
					rt.style.marginLeft = m[radius][i]+"px";
				else if(/tr/.test(corners))
					rt.style.marginRight = m[radius][i]+"px";
				
				with(rt.style) {
					height = h[radius][i]+"px";
					lineHeight = "0px";
					display = "block";
					overflow = "hidden";
					backgroundColor = c.style.backgroundColor;
				}
				
				if(borderColor) {
					rt.style.borderWidth = "0 "+o[radius][i]+"px";
					
					if(/tl/.test(corners) && !/tr|top|all/.test(corners))
						rt.style.borderRightWidth = "1px";
					else if(/tr/.test(corners) && !/tl|top|all/.test(corners))
						rt.style.borderLeftWidth = "1px";
					
					rt.style.borderColor = borderColor;
					rt.style.borderStyle = "solid";
				}
				
				obj.appendChild(rt);
			}
		}
		
		obj.appendChild(c);
		
		if(bottom) {
			for(var i = 0; i < m[radius].length; ++i) {
				var bt = mint.$C("b");
				
				if(/all|bottom|bl br|br bl/.test(corners))
					bt.style.margin = "0 "+m[radius][m[radius].length-1-i]+"px";
				else if(/bl/.test(corners))
					bt.style.marginLeft = m[radius][m[radius].length-1-i]+"px";
				else if(/br/.test(corners))
					bt.style.marginRight = m[radius][m[radius].length-1-i]+"px";
				
				with(bt.style) {
					height = h[radius][h[radius].length-1-i]+"px";
					display = "block";
					overflow = "hidden";
					backgroundColor = c.style.backgroundColor;
				}
				
				if(borderColor) {
					bt.style.borderWidth = "0 "+o[radius][o[radius].length-1-i]+"px";
					
					if(/bl/.test(corners) && !/br|bottom|all/.test(corners))
						bt.style.borderRightWidth = "1px";
					else if(/br/.test(corners) && !/bl|bottom|all/.test(corners))
						bt.style.borderLeftWidth = "1px";
					
					bt.style.borderColor = borderColor;
					bt.style.borderStyle = "solid";
				}
				
				obj.appendChild(bt);
			}
		}
		
		if(top && borderColor)
			obj.firstChild.style.borderTopWidth = "1px";
		else if(borderColor)
			obj.style.borderTop = "1px solid "+borderColor;

		if(bottom && borderColor)
			obj.lastChild.style.borderBottomWidth = "1px";
		else if(borderColor)
			c.style.borderBottom = "1px solid "+borderColor;
		
		return c;
	}
};

mint.gui =
{
	drag : null,
	startX : 0,
	startY : 0,
	startW : 0,
	startH : 0,
	offsetX : 0,
	offsetY : 0,

	stack : [],
	stackOffset : 0,

	tabWidgets : [],
	treeWidgets :[],
	gridWidgets : [],
	accordionWidgets : [],
	dragObjects : [],
	dropZones : [],

	Init : function() {
		var that = this;
		AddEvent(document.getElementsByTagName("html")[0], "mousemove", function(e) {that.OnMouseMove(e)});
		AddEvent(document.getElementsByTagName("html")[0], "mouseup", function(e) {that.OnMouseUp(e)});
	},

	OnMouseMove : function(e) {
		if(this.drag) {
			if(window.getSelection)
				window.getSelection().removeAllRanges();
			else if(document.getSelection)
				document.getSelection().removeAllRanges();
			else if(document.selection)
				document.selection.empty();
				
			var d = this.drag, z, x = e.clientX-this.offsetX, y = e.clientY-this.offsetY;
			
			if(!d.isDragged && d.threshold != 0 && Math.pow(x, 2)+Math.pow(y, 2) > Math.pow(d.threshold, 2)) {
				SetPos(d.obj, GetX(d.obj), GetY(d.obj));
				d.obj.style.position = "absolute";	
				
				d.OnDragStart(d.obj);
				d.isDragged = true;
			}
			
			if(d.isDragged) d.OnDrag(d.obj);
			
			if(!d.resize || (d.resize && d.resizeCtrl && !e.ctrlKey)) {
				if(!d.lockX) {
					if(d.minX !== null && x < d.minX) SetX(d.obj, d.minX);
					else if(d.maxX !== null && x+GetWidth(d.obj) > d.maxX) SetX(d.obj, d.maxX-GetWidth(d.obj));
					else SetX(d.obj, x);
				}
				
				if(!d.lockY) {
					if(d.minY !== null && y < d.minY) SetY(d.obj, d.minY);
					else if(d.maxY !== null && y+GetHeight(d.obj) > d.maxY) SetY(d.obj, d.maxY-GetHeight(d.obj));
					else SetY(d.obj, y);
				}
			}
			else {
				var w = this.startW+(e.clientX-this.startX), h = this.startH+(e.clientY-this.startY);
				
				mint.$(d.obj).addClass(d.resizeClass);
				
				if(!d.lockWidth) {
					if(d.minWidth !== null && w < d.minWidth) SetWidth(d.obj, d.minWidth);
					else if(d.maxWidth !== null && w > d.maxWidth) SetWidth(d.obj, d.maxWidth);
					else SetWidth(d.obj, w);
				}
				
				if(!d.lockHeight) {
					if(d.minHeight !== null && h < d.minHeight) SetHeight(d.obj, d.minHeight);
					else if(d.maxWidth !== null && h > d.maxWidth) SetHeight(d.obj, d.maxHeight);
					else SetHeight(d.obj, h);
				}
				
				d.OnResize(d.obj);
			}
			
			
			var z = this.dropZones[this.dropZones.length-1];
			
			for(var i = this.dropZones.length-1; i >= 0; --i, z = this.dropZones[i]) {
				if(IsInside(z.obj, e.clientX+GetScrollX(), e.clientY+GetScrollY(), true)) {
					if((z.acceptClass && mint.$(d.obj).hasClass(z.acceptClass)) || (!z.acceptClass && z.OnAccept(d.obj))) {
						if(z.limit !== null && z.items.length >= z.limit) break;
						
						if(!z.hover) {
							mint.$(z.obj).addClass(z.hoverClass);	
							z.hover = d;
							z.OnHoverIn(d.obj);
						}
						
						if(!z.over && (z.over = GetChildAtPos(z.obj, e.clientX+GetScrollX(), e.clientY+GetScrollY(), true))) {
							if(z.useDummyNode) {
								if(z.dummyNode)
									z.obj.removeChild(z.dummyNode);
									
								z.dummyNode = d.obj.cloneNode(false);
								z.dummyNode.style.position = "static";
								
								if(z.autoInline) {
									z.dummyNode.style.cssFloat = "left";
									z.dummyNode.style.clear = "none";
								}
								
								z.dummyNodeClass ? z.dummyNode.className = z.dummyNodeClass : z.dummyNode.style.visibility = "hidden";
									
								z.obj.insertBefore(z.dummyNode, z.over);
								z.over = z.dummyNode;
							}
							else {
								mint.$(z.over).addClass(z.overClass);
								z.OnOverIn(d.obj, z.over);
							}
						}
						else {
							if(z.over != GetChildAtPos(z.obj, e.clientX+GetScrollX(), e.clientY+GetScrollY(), true))
								z.ResetOverState();
							else if(!z.dummyNode)
								z.OnOver(d.obj, z.over);
						}
						
						z.OnHover(d.obj);
						return true;
					}
				}
				else if(z.hover) {
					z.ResetOverState();
					z.ResetHoverState();
				}
			}
		}
		
		return true;
	},

	OnMouseUp : function(e) {
		if(this.drag) {
			var d = this.drag;
			
			for(var i = this.dropZones.length-1, z = this.dropZones[i]; i >= 0; --i, z = this.dropZones[i]) {
				if(IsInside(z.obj, e.clientX+GetScrollX(), e.clientY+GetScrollY(), true) && z.obj != d.obj) {
					if((z.acceptClass && mint.$(d.obj).hasClass(z.acceptClass)) || (!z.acceptClass && z.OnAccept(d.obj))) {
						z.over && z.insertInside ? z.InsertItem(d.obj, z.over == z.dummyNode ? $(z.over).next() : z.over) : z.InsertItem(d.obj);
						
						d.dropZone = z;
						
						z.ResetOverState();
						z.ResetHoverState();
					}
					
					break;
				}
			}
			
			if(!d.dropZone && d.returnTo !== null) d.returnTo.InsertItem(d.obj);
			
			mint.$(d.obj).removeClass(d.dragClass);
			mint.$(d.obj).removeClass(d.resizeClass);
			
			d.OnDragStop(d.obj);
			
			this.drag.isDragged = false;
			this.drag = null;
		}
	},

	AddToStack : function(obj) {
		mint.$D(obj).style.zIndex = this.stack.push(mint.$D(obj))+this.stackOffset;
	},
	
	RemoveFromStack : function(obj) {
		with(this) {
			for(var i = mint.$D(obj).style.zIndex-1-stackOffset; i < stack.length-1; ++i) {
				stack[i] = stack[i+1];
				stack[i].style.zIndex = i+1+stackOffset;
			}
			
			stack.pop();
		}
	},
	
	MoveOnTop : function(obj) {
		this.RemoveFromStack(obj);
		this.AddToStack(obj);
	},
	
	SetStackOffset : function(offset) {
		this.stackOffset = offset;
	},

	$DragStart : function(e) {
		var m = mint.gui, d = this.dragObject, t = this, pos = GetPos(t);
		
		m.drag = d;
		m.startX = e.clientX;
		m.startY = e.clientY;
		m.startW = GetWidth(d.obj)-(parseInt(GetStyle(d.obj, "paddingLeft")) || 0)-(parseInt(GetStyle(d.obj, "paddingRight")) || 0);
		m.startH = GetHeight(d.obj)-(parseInt(GetStyle(d.obj, "paddingTop")) || 0)-(parseInt(GetStyle(d.obj, "paddingBottom")) || 0);
		m.offsetX = e.clientX-pos.x;
		m.offsetY = e.clientY-pos.y;
		
		mint.$(d.obj).addClass(d.dragClass);
		
		if(d.moveOnTop) m.MoveOnTop(t);
		if(d.threshold) return;
		
		if(d.dropZone) {
			d.dropZone.RemoveItem(t);
			m.OnMouseMove(e);
			d.dropZone = null;
		}
		
		if(GetStyleFast(t, "position") != "absolute") {
			SetPos(t, pos.x, pos.y);
			t.style.position = "absolute";
		}
		
		if(t.parentNode != document.body) document.body.appendChild(t);
			
		d.OnDragStart(t);
		d.isDragged = true;
		
		e.cancelBubble = true;
		if(e.stopPropagation) e.stopPropagation();
		
		return false;
	},

	RegisterDragObject : function(obj) {
		obj = mint.$D(obj);
		
		this.AddToStack(obj);
		
		AddEvent(obj, "mousedown", mint.gui.$DragStart);
		AddEvent(obj, "dragstart", function() {return false;});
		
		if(GetStyleFast(obj, "right") !== "") obj.style.right = "";
		if(GetStyleFast(obj, "bottom") !== "") obj.style.bottom = "";
		
		var ch = obj.childNodes;
		
		for(var i = 0; i < ch.length; ++i) {
			if(ch[i] && ch[i].tagName) {
				AddEvent(ch[i], "mousedown", function(e) {
					e.cancelBubble = true;
					if(e.stopPropagation) e.stopPropagation();
					return true;
				});
			}
		}
		
		var d = {
			obj : obj,
			grips: [],
			minX : null,
			maxX : null,
			minY : null,
			maxY : null,
			minWidth : null,
			maxWidth : null,
			maxWidth : null,
			maxHeight : null,
			lockX : false,
			lockY : false,
			lockWidth : false,
			lockHeight : false,
			dragClass : null,
			hoverClass : null,
			dropZone : null,
			moveOnTop : true,
			threshold : 0,
			isDragged : false,
			resize : false,
			resizeCtrl : false,
			returnTo : null,
			OnDrag : function() {},
			OnDragStart : function() {},
			OnDragStop : function() {},
			OnResize : function() {},
			
			AddGrip : function(grip, only) {
				grip = mint.$D(grip);
				grip.dragObject = obj;
				
				for(var i  in this.grips) if(this.grips[i] == grip) return null;
				
				AddEvent(grip, "mousedown", function(e) {mint.gui.$DragStart.call(obj, e)});
				if(only) RemoveEvent(obj, "mousedown", mint.gui.$DragStart);
				
				this.grips.push(grip);
			},
			
			RemoveGrip : function(grip) {
				grip = mint.$D(grip);
				grip.dragObject = null;
				
				RemoveEvent(grip, "mousedown", function(e) {mint.gui.$DragStart.call(this.dragObject.obj, e)});
				
				for(var i in this.grips) {
					if(this.grips[i] == grip) {
						this.grips.splice(i, 1);
						break;
					}
				}
			},
			
			SetBBox : function(obj)  {
				obj = obj ? this.obj.parentNode : mint.$D(obj);
				
				var pos = GetPos(obj, true), size = GetSize(obj);
				
				with(this) {
					minX = pos.x;
					maxX = pos.x+size.width;
					minY = pos.y;
					maxY = pos.y+size.height;
				}
			},
			
			RemoveBBox : function() {
				with(this) {
					minX = maxX = minY = maxY = null;
				}
			}
		}
		
		obj.dragObject = d;
		
		this.dragObjects.push(d);
		
		return d;
	},

	UnregisterDragObject : function(obj) {
		obj = mint.$D(obj);
		
		RemoveEvent(obj, "mousedown", this.$DragStart);
		RemoveEvent(obj, "dragstart", function() {return false;});
		
		for(var i in this.dragObjects) {
			if(this.dragObjects[i] == obj.dragObject) {
				this.dragObjects.splice(i, 1);
				obj.dragObject = null
				return true;
			}
		}
		
		return false;
	},

	RegisterDropZone : function(obj) {
		obj = mint.$D(obj);
		
		var z = {
			obj: obj,
			items: [],
			over: null,
			hover: null,
			overClass: null,
			hoverClass: null,
			acceptClass: null,
			dummyNode: null,
			dummyNodeClass: null,
			useDummyNode: true,
			insertInside: true,
			autoInline: true,
			limit:  null,
			returnItems: false,
			reqConfig: {},
			OnAdd: function() {},
			OnRemove: function() {},
			OnDrag: function() {},
			OnDrop: function() {},
			OnHover: function() {},
			OnHoverIn: function() {},
			OnHoverOut: function() {},
			OnOver: function() {},
			OnOverIn: function() {},
			OnOverOut: function() {},
			OnAccept: function() {return true;},
			OnLimit: function() {},
			OnSendDone: function() {},
			OnLoadDone: function() {},
			
			InsertItem: function(obj, before) {
				var item = mint.$D(obj);
				
				with(this) {
					if(!item.dragObject) return;
					if(item.dragObject.dropZone && item.dragObject.dropZone == this) return;
					
					if(limit !== null && limit == items.length) {
						OnLimit(obj);
						return;
					}
					
					obj.insertBefore(item, $D(before) || null);
					
					with(item) {
						dragObject.dropZone = this;
						dragObject.returnTo = null;
						
						if(autoInline) {
							style.cssFloat = "left";
							style.clear = "none";
						}
						
						style.position = "static";
					}
					
					if(before) {
						for(var i = 0; i < items.length; ++i) {
							if(items[i] == $D(before)) {
								i == 0 ? items.unshift(item) : items.splice(i, 0, item);
								break;
							}
						}
					}
					else items.push(item);
					
					OnAdd(item);
				}
			},
			
			RemoveItem: function(obj) {
				obj = mint.$D(obj);
				
				SetPos(obj, GetX(obj), GetY(obj));
				obj.style.position = "absolute";
				
				document.body.appendChild(obj).dragObject.dropZone = null;
				
				for(var i in this.items) {
					if(this.items[i] == obj) {
						this.items.splice(i, 1);
						break;
					}
				}
				
				if(this.returnItems) obj.dragObject.returnTo = this;
				
				this.OnRemove(obj);
			},
			
			SendItems: function(url) {
				var that = this;
				
				with(this) {
					var list = [], req = mint.Request().Set(reqConfig);
					
					for(var i in items) if(items[i].id) list.push(items[i].id);
					
					req.OnSuccess = function() {
						that.OnSendDone();
					}
					
					req.AddParam("items", list.join(","));
					req.Send(url);
				}
			},
			
			LoadItems: function(url) {
				var that = this;
				
				with(this) {
					var req = mint.Request().Set(reqConfig);
					
					req.OnSuccess = function() {
						var list = this.responseText.split(",");
						
						for(var i in list) {
							if($D(list[i]) && $D(list[i]).dragObject) that.InsertItem(list[i]);
						}
						
						that.OnLoadDone(list);
					}
					
					req.Send(url);
				}
			},
			
			ResetOverState: function() {
				with(this) {
					if(!over) return;
					
					if(dummyNode) {
						obj.removeChild(dummyNode);
						dummyNode = null;
					}
					else {
						mint.$(over).removeClass(overClass);
						OnOverOut(over);
					}
					
					over = null;
				}
			},
			
			ResetHoverState: function() {
				if(!this.hover) return;
				
				mint.$(this.obj).removeClass(this.hoverClass);
				
				this.OnHoverOut(this.hover);
				this.hover = null;
			}
		}
		
		obj.dropZone = z;
		
		this.dropZones.push(z);
		
		return z;
	},
	
	UnregisterDropZone : function(obj) {
		obj = mint.$D(obj);
		
		for(var i in this.dropZones) {
			if(this.dropZones[i] == obj.dropZone) {
				this.dropZones.splice(i, 1);
				obj.dropZone = null;
				return true;
			}
		}
		
		return false;
	},
	
	LiveWidget : function(target, name, link) {
		var w = {
			target : target ? mint.$D(target) : null,
			items : [],
			name : name,
			link : link,
			useHash : false,
			useCache : true,
			useSaving : false,
			autoTextUpdate : true,
			selectFirstItem : true,
			activeItem : null,
			widgetParam : "widget",
			itemParam : "item",
			alwaysUpdate : false,
			fading : false,
			fadeDuration : 500,
			fadeSteps : 25,
			overTimer : null,
			overOpen : false,
			overWait : 200,
			hoverClass : null,
			response : null,
			reqConfig : {},
			
			OnSelect : function() {},
			OnDeselect : function() {},
			OnInsert : function() {},
			OnUpdate : function() {},
			OnRetrieve : function() {},
			OnError : function() {},
			
			$AddItem : function() {},
			$RemoveItem : function() {},
			$Update : function() {},
			$RemoveItem : function() {},
			
			Set : function(attr) {return mint.Set(this, attr)},
			
			AddItem : function(obj, name, type, link) {
				obj = mint.$D(obj);
				
				var t = this.LiveItem(obj, name, type, link);
				
				with(this) {
					$AddItem(t);
					
					AddEvent(t.obj, "click", function() {if(this.liveItem.enabled) this.liveWidget.OpenItem(this.liveItem)});
					
					LoadItem(t);
					items.push(t);
				}
				
				return t;
			},
			
			RemoveItem : function(item) {
				with(this) {
					if(typeof item == "string") item = GetItem(item);
					if(activeItem == item) Deselect(item);
					
					for(var i in items) if(items[i] == item) items.splice(i, 1);
					
					$RemoveItem(item);
				}
			},
			
			OpenItem : function(item) {
				if(this.useHash && item.name) window.location.hash = item.name;
				
				this.Select(item);
			},
			
			LoadItem : function(item) {
				with(this) {
					if(useHash) {
						if((selectFirstItem && window.location.hash.length === 0 && items.length === 0) ||
							(window.location.hash.length > 0 && window.location.hash === "#"+item.name)) return Select(item);
					}
					else if(useSaving && name && !isNaN(parseInt(GetCookie(name)))) {
						if(parseInt(GetCookie(name)) === item.index) return Select(item);
					}
					else if(selectFirstItem && items.length === 0) return Select(item);
				}
				
				return false;
			},
			
			LiveItem : function(obj, name, type, link, target) {
				var t = {
					obj : mint.$D(obj),
					name : name,
					type : type || "text",
					link : link || null,
					target : target || null,
					cache : null,
					index : this.items.length,
					enabled : true
				}
				
				t.obj.liveItem = t;
				t.obj.liveWidget = this;
				
				return t;
			},
			
			GetItem : function(name) {
				if(!name || typeof name != "string") return name;
				
				for(var i in this.items) {
					if(this.items[i].name == name)
						return this.items[i];
				}
				
				return null;
			},
			
			Select : function(item) {
				if(this.activeItem != item || this.alwaysUpdate)
					this.GetLiveData(item);
				
				return true;
			},
			
			Deselect : function(item) {
			},
			
			GetLiveData : function(liveItem) {
				var t = liveItem, w = this;
				
				with(w) {
					if(activeItem && activeItem != t) {
						var a = activeItem;
						activeItem = null;
						Deselect(a);
						OnDeselect(a);
					}
						
					activeItem = t;
					OnSelect(t);
					
					if(useSaving && name) SetCookie(name, t.index);
					
					if(useCache && t.cache) {
						if(autoTextUpdate && t.type.toLowerCase() == "text" && target)
							fading ? Fade(t.cache) : target.innerHTML = t.cache;
						
						if(reqConfig.evalScripts) EvalScripts(t.cache);
						
						$Update(t, t.cache);
						OnUpdate(t, t.cache);
					}
					else if(t.type) {
						var req = mint.Request().Set(reqConfig);
						
						req.OnSuccess = function() {
							switch(t.type.toLowerCase()) {
								case "text" : w.response = this.responseText; break;
								case "json" : w.response = this.responseJSON; break;
								case "xml" : w.response = this.responseXML; break;
								default : w.response = null;
							}
							
							if(t.type.toLowerCase() == "text" && w.autoTextUpdate && w.target)
								w.fading ? w.Fade(w.response) : w.target.innerHTML = w.response;
								
							if(w.useCache) t.cache = w.response;
							
							w.$Update(t, w.response);
							w.OnUpdate(t, w.response);
						}
						
						if(t.link || link) {
							if(widgetParam && name) req.AddParam(widgetParam, name);
							if(itemParam && t.name) req.AddParam(itemParam, t.name);
							
							req.getJSON = t.type == "json" ? true : false;
							
							req.Send(t.link ? t.link : link);
							OnRetrieve(t);
						}
					}
				}
			},
			
			Fade : function(content) {
				var w = this;
				
				if(w.target.innerHTML.length == 0 || !/\S/.test(w.target.innerHTML))
					w.target.innerHTML = content;
				else {
					mint.fx.Style(w.target, "opacity", null, 0, w.fadeSteps, mint.fx.IsRunning(w.target, "opacity") ? mint.fx.GetElapsedTime(w.target, "opacity") : w.fadeDuration, null,
						function() {
							w.OnInsert(content)
							w.target.innerHTML = content;
							mint.fx.Style(w.target, "opacity", 0, 100, w.fadeSteps, w.fadeDuration);
						});
				}
			},
			
			Over: function(obj) {
				var that = this;
				mint.$(obj).addClass(this.hoverClass);
				if(this.overOpen) this.overTimer = setTimeout(function() {that.Select(obj.liveItem)}, that.overWait);
			},
			
			Out: function(obj) {
				if(this.overOpen && this.overTimer) {
					clearTimeout(this.overTimer);
					this.overTimer = null;
				}
				
				mint.$(obj).removeClass(this.hoverClass);
			}
		}
		
		return w;
	},
	
	CreateTabWidget : function(target, name, link) {
		var w = this.LiveWidget(target, name, link);
		
		w.activeClass = null;
		w.activeImage = null;
		w.inactiveImage = null;
		w.imageClass= null;
		w.imagePosition = "left";
		
		w.$AddItem = function(t) {
			t.img = mint.$C("img");
			t.img.style.verticalAlign = "middle";
			
			with(this) {
				if(imageClass) t.img.className = imageClass;
				
				inactiveImage ? t.img.src = inactiveImage : t.img.style.display = "none";
				imagePosition == "left" ? t.obj.insertBefore(t.img, t.obj.firstChild) : t.obj.appendChild(t.img);
			}
			
			var that = this;
			AddEvent(t.obj, "mouseover", function() {that.Over(this)});
			AddEvent(t.obj, "mouseout", function() {that.Out(this)});
		};
		
		w.$RemoveItem = function(item) {
			RemoveEvent(item.obj, "click", function() {if(this.liveItem.enabled) this.liveWidget.OpenItem(this.liveItem)});
			RemoveHover(item.obj);
		}
		
		w.AddTab = function(obj, name, type, link) {
			this.AddItem(obj, name, type, link);
		};
		
		w.Select = function(item) {
			with(this) {
				mint.$(item.obj).addClass(activeClass);
				
				if(activeImage) {
					item.img.src = activeImage;
					item.img.style.display = "";
				}
				
				if(activeItem != item || alwaysUpdate)
					w.GetLiveData(item);
			}
		};
		
		w.Deselect = function(item) {
			mint.$(item.obj).removeClass(this.activeClass);
				
			this.inactiveImage ? item.img.src = this.inactiveImage : item.img.style.display = "none";
		};
		
		this.tabWidgets.push(w);
		
		return w;
	},

	CreateTreeWidget : function(tree, target, name, link) {
		var w = mint.gui.LiveWidget(target, name, link);
		
		w.tree = mint.$D(tree);
		w.indent = 25;
		w.newItemUnfold = true;
		w.useClass = true;
		w.useImage = true;
		w.areaClass = null;
		w.imageClass = null;
		w.imagePosition = "left";
		w.foldAnimation = true;
		w.foldDuration = 500;
		w.foldSteps = 25;
		w.selectBeforeOpen = false;
		// item, itemSelect, fold, foldSelect, unfold, unfoldSelect [+Class/Image]
		
		w.$AddItem = w.AddItem;
		
		w.InsertItem = function(parent, name, type, link, text) {
			this.AddItem(parent, name, type, link, text);
		}
		
		w.AddItem = function(parent, name, type, link, title) {
			parent = this.GetItem(parent);
			
			var that = this, t = {
				obj : mint.$C("div"),
				area : mint.$C("div"),
				img : mint.$C("img"),
				parent : parent || null,
				name : name,
				type : type || null,
				link : link || null,
				cache : null,
				index : this.items.length,
				fold : true
			}
			
			t.obj.liveItem = t;
			t.obj.liveWidget = this;
			t.obj.innerHTML = title || name || "";
			
			if(this.imageClass) t.img.className = this.imageClass;
			
			t.img.style.display = "none";
			t.img.style.verticalAlign = "middle";
			
			t.img.onload = function() {this.style.display = ""}
			t.img.onerror = function() {this.style.display = "none"}
			
			this.imagePosition == "left" ? t.obj.insertBefore(t.img, t.obj.firstChild) : t.obj.appendChild(t.img);
			
			with(t.area.style) {
				height = "0px";
				display = "none";
				overflow = "hidden";
				marginLeft = this.indent+"px";
			}
			
			if(parent) {
				parent.area.appendChild(t.obj);
				parent.area.appendChild(t.area);
				
				if(this.newItemUnfold) {
					with(parent.area.style) {
						height = GetHeight(parent.area);
						height = "";
						display = "block";
					}
					parent.fold = false;
				}
				else parent.fold = true;
				
				this.UpdateItem(parent);
			}
			else {
				this.tree.appendChild(t.obj);
				this.tree.appendChild(t.area);
			}
			
			AddEvent(t.obj, "click", function() {this.liveWidget.OpenItem(this.liveItem);});
			
			AddEvent(t.obj, "selectstart", function() {return false});
			AddEvent(t.obj, "mousedown", function() {return false});
			
			AddEvent(t.obj, "mouseover", function() {that.Over(this)});
			AddEvent(t.obj, "mouseout", function() {that.Out(this)});
			
			this.LoadItem(t);
			
			w.UpdateItem(t);
			
			this.items.push(t);
			return t;
		}
		
		w.$RemoveItem = function(item) {
			while(item.area.childNodes.length > 0) 
				this.RemoveItem(item.area.childNodes[0].liveItem);
				
			item.obj.parentNode.removeChild(item.obj);
			item.area.parentNode.removeChild(item.area);
		}
		
		w.MoveBefore = function(item, before) {
			item = this.GetItem(item);
			before = this.GetItem(before);
			
			if(item && before) {
				var area = before.parent ? before.parent.area : this.tree;
				
				area.insertBefore(item.obj, before.obj);
				area.insertBefore(item.area, before.obj);
				
				item.parent = before.parent;
			}
		}
		
		w.MoveAfter = function(item, after) {
			item = this.GetItem(item);
			after = this.GetItem(after);
			
			if(item && after) {
				var area = after.parent ? after.parent.area : this.tree;
				var next = mint.$(after.area).next();
				
				if(next) this.MoveBefore(item, next.liveItem);
				else {
					area.appendChild(item.obj);
					area.appendChild(item.area);
					
					item.parent = after.parent;
				}
			}
		}
		
		w.Load = function(url) {
			var that = this, req = mint.Request().Set(this.reqConfig);
			
			req.OnSuccess = function() {
				for(var i in this.responseJSON) that.LoadNode(this.responseJSON[i]);
			}
			
			req.Set({getJSON: true}).Send(url);
		}
		
		w.LoadNode = function(node, parent) {
			var item = this.AddItem(parent, node.name, node.type, node.link, node.title);
			if(node.child) for(var i in node.child) this.LoadNode(node.child[i], item);
		}
		
		w.Select = function(item) {
			with(this) {
				if(!selectBeforeOpen || (selectBeforeOpen && activeItem == item))
					item.fold ? Unfold(item) : Fold(item);
				
				if(activeItem != item || alwaysUpdate) {
					GetLiveData(item);
					UpdateItem(item);
				}
			}
		}
		
		w.Deselect = function(item) {
			this.UpdateItem(item);
		}
		
		w.Fold = function(item) {
			item = this.GetItem(item);
			
			if(item) {
				if(item.fold) return;
				
				with(item) {
					if(area.hasChildNodes()) {
						if(this.foldAnimation) {
							mint.fx.Style(area, "height", GetHeight(area), 0, this.foldSteps, mint.fx.IsRunning(area, "height") ? mint.fx.GetElapsedTime(area, "height") : this.foldDuration, null, function() {mint.$(area).hide()});
							
							if(parent) {
								parent.area.style.height = GetHeight(parent.area);
								parent.area.style.height = "";
							}	
						}
						else mint.$(area).hide();
					}
				}
				
				item.fold = true;
				this.UpdateItem(item);
			}
			else {
				for(var i = 0; i < this.items.length; i++) {
					if(this.items[i].area.hasChildNodes()) this.Fold(this.items[i]);
				}
			}
		}
		
		w.Unfold = function(item) {
			item = this.GetItem(item);
			
			if(item) {
				if(!item.fold) return;
				
				with(item) {
					if(area.hasChildNodes()) {
						area.style.display = "block";
						
						if(this.foldAnimation)
							mint.fx.Style(area, "height", GetHeight(area), item.area.scrollHeight, this.foldSteps, mint.fx.IsRunning(area, "height") ? mint.fx.GetElapsedTime(area, "height") : this.foldDuration, null, function() {area.style.height = ""});
						else
							area.style.height = "";
					}
				}
					
				item.fold = false;
				this.UpdateItem(item);
			}
			else {
				for(var i = 0; i < this.items.length; i++) {
					if(this.items[i].area.hasChildNodes()) this.Unfold(this.items[i]);
				}
			}
		}
		
		w.UpdateItem = function(item) {
			if(item.area.hasChildNodes()) {
				if(this.activeItem == item)
					this.UpdateSet(item, item.fold ? ["foldSelect", "fold", "itemSelect", "item"] : ["unfoldSelect", "unfold", "itemSelect", "item"]);
				else
					this.UpdateSet(item, item.fold ? ["fold", "item"] : ["unfold", "item"]);
				
				item.area.className = item.areaClass || this.areaClass || item.area.className;
			}
			else
				this.UpdateSet(item, this.activeItem == item ? ["itemSelect", "item"] : ["item"]);
		}
		
		w.UpdateSet = function(item, list) {
			var classFound = false, imageFound = false;
			
			for(var i = 0; i < list.length; i++) {
				if(this.useClass && !classFound && (item[list[i]+"Class"] || this[list[i]+"Class"])) {
					item.obj.className = item[list[i]+"Class"] || this[list[i]+"Class"];
					classFound = true;
				}
					
				if(this.useImage && !imageFound && (item[list[i]+"Image"] || this[list[i]+"Image"])) {
					item.img.src = item[list[i]+"Image"] || this[list[i]+"Image"];
					imageFound = true;
				}
				
				if(classFound && imageFound) break;
			}
			
			if(!imageFound) item.img.src = null;
		}
		
		this.treeWidgets.push(w);
		
		return w;
	},
	
	CreateAccordionWidget : function(name, link) {
		var w = mint.gui.LiveWidget(null, name, link);
		
		w.fading = true;
		w.openClass = null;
		w.slideBoth = true;
		w.slideDuration = 450;
		w.slideSteps = 15;
		w.slideWait = 80;
		w.prevItem = null;
		w.alwaysOpen = true;
		w.staticHeight = null;
		w.ignoreLinks = true;
		
		w.OnOpen = function() {};
		w.OnClose = function() {};
	
		w.AddItem = function(header, target, name, type, link) {
			var that = this, t = {
				header : mint.$D(header),
				target : mint.$D(target),
				content : mint.$C("div"),
				name : name || null,
				type : type || null,
				link : link || null,
				open : true,
				cache : null,
				index : this.items.length
			}
			
			t.header.liveItem = t.target.liveItem = t.content.liveItem = t;
			t.header.liveWidget = t.target.liveWidget = t.content.liveWidget = this;
			
			while(t.target.firstChild) t.content.appendChild(t.target.firstChild);
			
			t.target.appendChild(t.content);
			
			if(GetStyle(t.target, "paddingTop"))
				t.content.style.marginTop = GetStyle(t.target, "paddingTop");
				
			if(GetStyle(t.target, "paddingBottom"))
				t.content.style.marginBottom = GetStyle(t.target, "paddingBottom");
			
			with(t.target.style) {
				overflow = "hidden";
				paddingTop = "0px";
				paddingBottom = "0px";
			}
			
			AddEvent(t.header, "click", function() {that.OpenItem(this.liveItem)});
			AddEvent(t.header, "selectstart", function() {return false});
			AddEvent(t.header, "mousedown", function() {return false});
			AddEvent(t.header, "mouseover", function() {that.Over(this)});
			AddEvent(t.header, "mouseout", function() {that.Out(this)});
			
			if(this.staticHeight) SetHeight(t.target, this.staticHeight);
			
			if(!this.LoadItem(t)) {
				if(this.fading) SetOpacity(t.content, 0);
				
				t.open = false;
				t.height = t.target.scrollHeight;
				t.target.style.height = "0.01px";
			}
			
			this.items.push(t);
			return t;
		}
		
		w.AddStatic = function(container, header, target, offset) {
			var c = mint.$D(container), h = c.getElementsByTagName(header);
			
			for(var i = 0; i < h.length; i++)
				if(h[i].parentNode == c && h[i].getElementsByTagName("a").length == 0) this.AddItem(h[i], mint.$(h[i]).next(target));
		}
		
		w.$Update = function(item, response) {
			item.content.innerHTML = response;
			this.Slide(item, this.prevItem);
		}
		
		w.$RemoveItem = function(item) {
			RemoveEvent(item.header, "click", function() {this.liveWidget.OpenItem(this.liveItem)});
			RemoveEvent(item.header, "selectstart", function() {return false});
			RemoveEvent(item.header, "mousedown", function() {return false});
			RemoveEvent(item.header, "mouseover", this.HeaderOver);
			RemoveEvent(item.header, "mouseout", this.HeaderOut);
		}
		
		w.Select = function(item) {
			with(this) {
				if(!activeItem || activeItem != item) {
					prevItem = activeItem;
					activeItem = item;
					item.link || (link && item.name) ? GetLiveData(item) : w.Slide(item, prevItem);
				}
				else if(!alwaysOpen) {
					prevItem = activeItem;
					activeItem = null;
					!item.open ? w.Slide(item, null) : w.Slide(null, item);
				}
			}
			
			return true;
		}
		
		w.Slide = function(open, close) {
			var group = mint.fx.Group("height", this.slideSteps, this.slideDuration);
			
			if(open) {
				mint.$(open.header).addClass(this.openClass);
				
				open.height = open.target.scrollHeight;
				open.open = true;
				
				group.Add(open.target, "height", GetHeight(open.target), this.staticHeight || open.height);
				if(this.fading) group.Add(open.content, "opacity", null, 100);
				
				this.OnOpen(open);
			}
			
			if(close) {
				mint.$(close.header).removeClass(this.openClass);
				close.open = false;
				
				group.Add(close.target, "height", GetHeight(close.target), 0.01);
				if(this.fading) group.Add(close.content, "opacity", null, 0);
				
				this.OnClose(close);
			}
			
			group.Run();
		}
		
		w.HeaderOver = function() {
			var w = this.liveWidget, t = this.liveItem;
			
			mint.$(t.header).addClass(w.hoverClass);
			if(w.overOpen) w.overTimer = setTimeout(function() {w.Select(t)}, w.overWait);
		}
		
		w.HeaderOut = function() {
			var w = this.liveWidget, t = this.liveItem;
			
			mint.$(t.header).removeClass(w.hoverClass);
			
			if(w.overOpen && w.overTimer) {
				clearTimeout(w.overTimer);
				w.overTimer = null;
			}
		}
		
		this.accordionWidgets.push(w);
		
		return w;
	},

	CreateGridWidget : function(grid) {
		var w = {
			obj : mint.$D(grid),
			desc : false,
			sortIndex : null,
			selectClass : null,
			multiSelect : true,
			selRows : [],
			caseSensitive : true,
			selective : false,
			exclude : null,
			excludeFirstRow : true,
			excludeLastRow : false,
			remoteDataSeparator : ",",
			remoteRowSeparator : ";",
			supportPolishChars : true,
			reqConfig : {},
			
			OnSelect : function() {},
			OnDeselect : function() {},
			OnSort : function() {},
			OnChange : function() {},
			OnAscSort : function() {},
			OnDescSort : function() {},
			OnInsert : function() {},
			OnDelete : function() {},
			OnRemoteLoading : function() {},
			OnRemoteDone : function() {},
			OnRemoteError : function() {},
			
			AddSortCell : function(index) {
				var cell = this.obj.rows[0].cells[index];
				
				cell.gridWidget = this;
				cell.gridSortIndex = index;
				
				AddEvent(cell, "mousedown", function() {return false});
				AddEvent(cell, "selectstart", function() {return false});
				AddEvent(cell, "click", this.Sort);
				
				return cell;
			},
			
			AddSortCells : function(index) {
			   if(arguments.length > 0) for(var i = 0; i < arguments.length; ++i) this.AddSortCell(arguments[i]);
			   else for(var i = 0; i < this.obj.rows[0].cells.length; ++i) this.AddSortCell(i); 
			},
			
			FixTable : function() {
				if(this.obj.tBodies.length == 0)
					this.obj.appendChild(mint.$C("tBody"));
					
				if(!this.obj.tHead && this.excludeFirstRow) {
					this.obj.createTHead ? this.obj.createTHead() : this.obj.insertBefore(mint.$C("tHead"), this.obj.tBodies[0]);
					if(this.obj.tBodies[0].rows.length > 0) this.obj.tHead.appendChild(this.obj.rows[0]);
				}
				
				if(!this.obj.tFoot && this.excludeLastRow) {
					this.obj.createTFoot ? this.obj.createTFoot() : this.obj.appendChild(mint.$C("tFoot"));
					if(this.obj.tBodies[0].rows.length > 0) this.obj.tFoot.appendChild(this.obj.rows[this.obj.rows.length-1]);
				}
			},
			
			SortBy : function(index, desc) {
				var cell = this.obj.rows[0].cells[index];
				
				cell.gridWidget = this;
				cell.gridSortIndex = index;
					
				if(desc) this.desc = true;
					
				this.Sort.call(cell);
			},
			
			Sort : function() {
				var grid = this.gridWidget;
				var rows = [];
				
				for(var r = 0; r < grid.obj.tBodies[0].rows.length; r++)
					rows.push(grid.obj.tBodies[0].rows[r]);
					
				if(grid.sortIndex !== null && grid.sortIndex != this.gridSortIndex) {
					grid.OnChange(rows[0].cells[grid.sortIndex]);
					grid.desc = false;
				}
					
				grid.sortIndex = this.gridSortIndex;
				grid.OnSort(rows[0].cells[grid.sortIndex]);
				
				var sortCell = rows[0].cells[grid.sortIndex].innerHTML;
				
				if(/^\d\d\D\d\d\D\d\d\d\d$/.test(sortCell)) {
					var sortFunc = function(a, b) {
						try {
							a = a.cells[grid.sortIndex].innerHTML.replace(/^(\d\d)\D(\d\d)\D(\d\d\d\d)$/, "$3$2$1");
							b = b.cells[grid.sortIndex].innerHTML.replace(/^(\d\d)\D(\d\d)\D(\d\d\d\d)$/, "$3$2$1")
							
							if(a < b) return -1;
							if(a > b) return 1;
							
						} catch(error) {}
						
						return 0;
					}
				}
				else if(/^\d\d\d\d\D\d\d\D\d\d$/.test(sortCell)) {
					var sortFunc = function(a, b) {
						try {
							a = a.cells[grid.sortIndex].innerHTML.split(/\D/).reverse().join("");
							b = b.cells[grid.sortIndex].innerHTML.split(/\D/).reverse().join("");
							
							a = a.replace(/^(\d\d)(\d\d)(\d\d\d\d)$/, "$3$2$1");
							b = b.replace(/^(\d\d)(\d\d)(\d\d\d\d)$/, "$3$2$1");
						
							if(a < b) return -1;
							if(a > b) return 1;
							
						} catch(error) {}
						
						return 0;
					}
				}
				else if(!isNaN(parseInt(sortCell))) {
					var sortFunc = function(a, b) {
						return parseFloat(a.cells[grid.sortIndex].innerHTML) - parseFloat(b.cells[grid.sortIndex].innerHTML);
					}
				}
				else if(typeof sortCell == "string") {
					var sortFunc = function(a, b) {
						try {
							a = a.cells[grid.sortIndex].innerHTML;
							b = b.cells[grid.sortIndex].innerHTML;
							
							if(grid.supportPolishChars) {
								var pl = [261, 263, 281, 322, 324, 243, 347, 378, 380];
								var en = [97, 99, 101, 108, 110, 111, 115, 122, 122];
							}
							
							if(grid.caseSensitive) {
								if(grid.supportPolishChars) {
									pl = [260, 262, 280, 321, 323, 211, 346, 377, 379].concat(pl);
									en = [65, 67, 69, 76, 78, 79, 83, 90, 90].concat(en);
								}
							}
							else {
								a = a.toLowerCase();
								b = b.toLowerCase();
							}
							
							if(!a || !b) return 0;
							
							var length = a.length > b.length ? a.length : b.length;
							
							for(var i = 0; i < length; i++) {
								if(isNaN(a.charCodeAt(i))) return -1;
								if(isNaN(b.charCodeAt(i))) return 1;
								
								if(a.charCodeAt(i) == b.charCodeAt(i)) continue;
								
								if(a.charCodeAt(i) > 243 && a.charCodeAt(i) < 380 && b.charCodeAt(i) > 243 && b.charCodeAt(i) < 380) {
									for(var c in pl) {
										if(a.charCodeAt(i) == pl[c]) return -1;
										if(b.charCodeAt(i) == pl[c]) return 1;
									}
								}
								else if((a.charCodeAt(i) > 243 && a.charCodeAt(i) < 380) || (b.charCodeAt(i) > 243 && b.charCodeAt(i) < 380)) {
									for(var c in pl) {
										if((a.charCodeAt(i) == pl[c] && en[c] < b.charCodeAt(i)) || (b.charCodeAt(i) == pl[c] && en[c] > a.charCodeAt(i)))
											return -1;
										else if((a.charCodeAt(i) == pl[c] && en[c] > b.charCodeAt(i)) || (b.charCodeAt(i) == pl[c] && en[c] < a.charCodeAt(i)))
											return 1;
									}
								}
								
								if(a.charCodeAt(i) < b.charCodeAt(i)) return -1;
								if(a.charCodeAt(i) > b.charCodeAt(i)) return 1;
							}
						} catch(error) {}
						
						return 0;
					}
				}
				else {
					var sortFunc = function(a, b) {
						try {
							a = a.cells[grid.sortIndex].innerHTML.toLowerCase();
							b = b.cells[grid.sortIndex].innerHTML.toLowerCase();
						
							if(a < b) return -1;
							if(a > b) return 1;
							
						} catch(error) {}
						
						return 0;
					}
				}
				
				rows.sort(sortFunc);
				
				if(grid.desc) rows.reverse();
				
				grid.desc ? grid.OnDescSort(grid.sortIndex, rows[0].cells[grid.sortIndex]) : grid.OnAscSort(grid.sortIndex, rows[0].cells[grid.sortIndex]);
				grid.desc = !grid.desc;
				
				grid.OnSort(grid.sortIndex);
				
				for(var r = 0; r < rows.length; r++)
					grid.obj.tBodies[0].appendChild(rows[r]);
			},
			
			LoadTextData : function(url) {
				var grid = this, req = mint.Request().Set(this.reqConfig);
				
				req.OnSuccess = function() {
					var rows = this.responseText.split(grid.remoteRowSeparator);
					
					for(var r in rows) if(rows[r])
						grid.InsertRow(rows[r].split(grid.remoteDataSeparator));
					
					if(grid.selective) grid.SetSelective();
					grid.OnRemoteDone(this.responseText);
				}
				
				req.Set({OnError: this.OnRemoteError, getJSON: false}).Send(url);
				this.OnRemoteLoading();
			},
			
			LoadJSONData : function(url) {
				var grid = this, req = mint.Request().Set(this.reqConfig);
				
				req.OnSuccess = function() {
					for(var d in this.responseJSON)
						grid.InsertRow(this.responseJSON[d]);
					
					if(grid.selective) grid.SetSelective();
					grid.OnRemoteDone(this.responseJSON);
				}
				
				req.Set({OnError: this.OnRemoteError, getJSON: true}).Send(url);
				this.OnRemoteLoading();
			},
			
			Select : function(row) {	
				r = this.GetRow(row);
				
				if(r.gridSelect === true) return;
					
				r.gridSelect = true;
				mint.$(r).addClass(this.selectClass);
				
				this.selRows.push(r);
				this.OnSelect(r);
			},
			
			Deselect : function(row) {
				r = this.GetRow(row);
				
				if(r.gridSelect === false) return;
					
				for(var i in this.selRows) {
					if(this.selRows[i] == r) {
						this.selRows.splice(i, 1);
						break;
					}
				}
				
				r.gridSelect = false;
				mint.$(r).removeClass(this.selectClass);
				
				this.OnDeselect(r);
			},
			
			SelectAll : function() {
				for(var i = 0; i < this.obj.tBodies[0].rows.length; i++)
					this.Select(this.obj.tBodies[0].rows[i]);
			},
			
			DeselectAll : function() {
				for(var i = this.selRows.length-1; i >= 0; i--)
					this.Deselect(this.selRows[i]);
			},
			
			SetSelective : function() {
				this.selective = true;
				
				this.exclude ? this.exclude.length = 0 : this.exclude = [];
					
				if(arguments.length > 0) {
					for(var i = 0; i < arguments.length; i++)
						this.exclude.push(arguments[i]);
				}
				
				for(var r = 0, row = this.obj.tBodies[0].rows[0]; r < this.obj.tBodies[0].rows.length; row = this.obj.tBodies[0].rows[++r]) {
					if(!row.gridSelective) {
						row.gridWidget = this;
						row.gridSelect = false;
						row.gridSelective = true;
						
						AddEvent(row, "selectstart", function() {return false});
						AddEvent(row, "mousedown", this.$OnSelect);
					}
				}
			},
			
			$OnSelect : function() {
				var w = this.gridWidget;
				
				if(!this.gridSelect) {
					if(!w.multiSelect && w.selRows.length !== 0)
						w.Deselect(w.selRows[0]);
						
					w.Select(this);
				}
				else
					w.Deselect(this);
					
				return false;
			},
			
			IsSelected : function(row) {
				return this.GetRow(row).gridSelect;
			},
			
			GetRow : function(index) {
				if(typeof index =="number" && index >= this.obj.tBodies[0].rows.length)
					return null;
					
				return (typeof index == "number") ? this.obj.tBodies[0].rows[index] : index;
			},
			
			GetSelRows : function() {
				return this.selRows;
			},
			
			DeleteRow : function(row) {
				r = this.GetRow(row);
				
				this.OnDelete(r);
				if(r.gridSelect) this.Deselect(r);
				this.obj.deleteRow(r.rowIndex);
			},
			
			DeleteSelRows : function()  {
				for(var i = this.selRows.length-1; i >= 0; --i)
					this.DeleteRow(this.selRows[i]);
			},
			
			DeleteAllRows : function() {
				for(var i = this.obj.tBodies[0].rows.length-1; i >= 0; --i)
					this.DeleteRow(this.obj.tBodies[0].rows[i]);
			},	
			
			InsertRow : function(values) {
				return this.InsertBefore(null, typeof values == "object" ? values : arguments);
			},
			
			InsertBefore : function(before, values) {
				var tr = mint.$C("tr");
				
				this.obj.tBodies[0].insertBefore(tr, before ? this.GetRow(before) : null);
				
				if(typeof values == "object" && values.length) {
					for(var i = 0; i < values.length; i++)
						tr.insertCell(-1).appendChild(document.createTextNode(values[i]));
				}
				else {
					for(var i = 1; i < arguments.length; i++)
						tr.insertCell(-1).appendChild(document.createTextNode(arguments[i]));
				}
				
				if(this.selective) this.SetSelective();
				
				this.OnInsert(tr);
				return tr;
			}
		}
		
		w.FixTable();
		this.gridWidgets.push(w);
		return w;
	}
};

mint.gui.Init();

mint.$ = function(id) {
	if(!id) return null;
		
	var e = (typeof id == "string") ? document.getElementById(id) : id;
	
	if(!e) return null;
	
	e.getTagName = function(tag) {
		return this.tagName ? this.nodeName.toLowerCase() : null;
	}
		
	e.next = function(tag, offset) {
		var next = this.nextSibling;
		
		for(var i = 0; next; next = next.nextSibling) {
			if(!mint.$(next).isWhitespace() && ((tag && mint.$(next) && mint.$(next).getTagName() == tag) || (!tag && mint.$(next))))
				if(!offset || ++i == offset)
					break;
		}
			
		return mint.$(next);
	}
	
	e.prev = function(tag, offset) {
		var prev = this.previousSibling;
		
		for(var i = 0; prev; prev = prev.previousSibling) {
			if(!mint.$(prev).isWhitespace() && ((tag && mint.$(prev) && $(prev).getTagName() == tag) || (!tag && mint.$(prev))))
				if(!offset || ++i == offset)
					break;
		}
		
		return mint.$(prev);
	}
	
	e.up = function() {
		return mint.$(this.parentNode);
	}
	
	e.down = function(tag, offset) {
		var child = this.firstChild;
		
		if((tag && mint.$(child).getTagName() != tag) || offset) child = mint.$(child).next(tag, offset);
		
		while(mint.$(child).isWhitespace()) {
			child = mint.$(child).next(tag, offset);
		}
			
		return child;
	}
	
	e.appendTo = function(parent) {
		return parent.appendChild(this);
	}
	
	e.getElementsByClass = function(className, tag) {
		var r = [];
		var n = this.getElementsByTagName(tag || '*');
		var p = new RegExp('(^|\\s)'+className+'(\\s|$)');
		
		for(var i = 0; i < n.length; ++i)
			if(p.test(n[i].className))
				r.push(n[i]);
		
		return r;
	}
	
	e.hide = function() {
		if(!this._style) this._style = {};
		this._style.width = GetStyleFast(this, "width");
		this._style.height = GetStyleFast(this, "height");
		this._style.display = GetStyleFast(this, "display");
		this.style.display = "none";
	}
	
	e.show = function() {
		this.style.display = this._style && this._style.display ? this._style.display : "";
	}
	
	e.toggle = function() {
		GetStyleFast(this, "display") == "none" ? this.show() : this.hide();
	}
	
	e.hasClass = function(name) {
		if(!name) return;
		
		var cl = this.className.split(" ");
		
		for(var c in cl)
			if(cl[c] == name) return true;
		
		return false;
	}
	
	e.addClass = function(name) {
		if(!name) return;
		
		if(!this.hasClass(name)) {
			var cl = this.className.split(" ");
			cl.push(name);
			this.className = cl.join(" ");
		}
	}
	
	e.removeClass = function(name) {
		if(!name) return;
		
		var cl = this.className.split(" ");
		
		for(var c in cl) {
			if(cl[c] == name) {
				cl.splice(c, 1);
				break;
			}
		}
		
		this.className = cl.join(" ");
	}
	
	e.isWhitespace = function() {
		return (this.nodeName != "#text") ? false : !/\S/.test(this.nodeValue);
	}

	return e;
}

mint.$C = function(type, id, className, style, attr, parent) {
	var c = (type == "#text") ? document.createTextNode(type) : document.createElement(type);
	c.id = id || "";
	c.className = className || "";
	
	if(style) for(var s in style) c.style[s] = style[s];
	if(attr) for(var a in attr) c[a] = attr[a];
	
	if(parent) parent.appendChild(c);
	return mint.$(c);
}

function AddEvent(obj, type, handler) {
	obj = mint.$D(obj);
	if(!obj.events) obj.events = [];
	
	if(!obj.events["on"+type]) {
		obj.events["on"+type] = [];
		if(obj["on"+type]) obj.events["on"+type].push(obj["on"+type]);
	}
	
	obj.events["on"+type].push(handler);

	obj["on"+type] = function(event) {
		event = event || window.event;
		
		var returnValue = true;
		var eventHandlers = this.events["on"+event.type];
		
		if(eventHandlers) {
			for(var i = 0; i < eventHandlers.length; ++i) {
				this.$eventHandler = eventHandlers[i];
				returnValue = this.$eventHandler.call(this, event);
			}
		}
		
		return returnValue;
	}
	
}

function RemoveEvent(obj, type, handler) {
	obj = mint.$D(obj);
	
	var eventHandlers = obj.events["on"+type];

	for(var i in eventHandlers) {
		if(String(eventHandlers[i]) === String(handler)) {
			eventHandlers.splice(i, 1);
			return true;
		}
	}
	
	return false;
}

function GetPos(obj, ignoreMargins) {
	obj = mint.$D(obj);

	var x = 0, y = 0;
	
	if(!ignoreMargins) {
		var marginLeft, marginTop;
		
		if(marginLeft = parseInt(GetStyleFast(obj, "marginLeft", "margin-left"))) x -= marginLeft;
		if(marginTop = parseInt(GetStyleFast(obj, "marginTop", "margin-top"))) y -= marginTop;
	}	
	
	do {
		x += obj.offsetLeft;
		y += obj.offsetTop;
		
		if(obj.parentNode) {
			x -= obj.parentNode.scrollLeft || 0;
			y -= obj.parentNode.scrollTop || 0;
		}
		
		if(obj.clientLeft) x += obj.clientLeft;
		if(obj.clientTop) y += obj.clientTop;
	} while(obj = obj.offsetParent)
	
	return {x:x, y:y};
}

function GetX(obj, ignoreMargins) {
	return GetPos(obj, ignoreMargins).x;
}

function GetY(obj, ignoreMargins) {
	return GetPos(obj, ignoreMargins).y;
}

function SetPos(obj, x, y) {
	SetX(obj, x);
	SetY(obj, y);
	return mint.$D(obj);
}

function SetX(obj, x) {
	mint.$D(obj).style.left = x+"px";
	return mint.$D(obj);
}

function SetY(obj, y) {
	mint.$D(obj).style.top = y+"px";
	return mint.$D(obj);
}

function GetSize(obj) {
	return {'width':GetWidth(obj), 'height':GetHeight(obj)};
}

function GetWidth(obj) {
	if(!mint.$D(obj).clientWidth) mint.$D(obj).style.zoom = "1.0";
	return mint.$D(obj).clientWidth;
}

function GetHeight(obj) {
	obj = mint.$D(obj);
	if(!mint.$D(obj).clientHeight) mint.$D(obj).style.zoom = "1.0";
	return mint.$D(obj).clientHeight;
}

function SetSize(obj, width, height) {
	this.SetWidth(obj, width);
	this.SetHeight(obj, height);
	return mint.$D(obj);
}

function SetWidth(obj, width) {
	mint.$D(obj).style.width = width+"px";
	return mint.$D(obj);
}

function SetHeight(obj, height) {
	mint.$D(obj).style.height = height+"px";
	return mint.$D(obj);
}

function GetOpacity(obj) {
	obj = mint.$D(obj);

	if(obj.style.opacity)
		return Math.round(obj.style.opacity*100);
	else if(obj.style.filter)
		return Math.round(/\d+/.exec(obj.style.filter)[0]);
	else
		return 100;
}

function SetOpacity(obj, opacity) {
	obj = mint.$D(obj);
	obj.style.opacity = opacity*0.01;
	obj.style.filter = "alpha(opacity="+opacity+")";
	obj.style.zoom = "1.0";
	return obj;
}

function GetStyle(obj, style) {
	obj = mint.$D(obj);
	
	if(style == "opacity")
		return GetOpacity(obj);
	
	if(obj.currentStyle) return obj.currentStyle[style].replace(/["]/g, "");
	else if(window.getComputedStyle) return getComputedStyle(obj, "").getPropertyValue(style.replace(/[A-Z]/g, function(obj, ch) {return "-"+style.charAt(ch).toLowerCase()}));
}

function GetStyleFast(obj, style, styleCSS) {
	obj = mint.$D(obj);
	
	if(obj.currentStyle) return obj.currentStyle[style];
	else if(window.getComputedStyle) return getComputedStyle(obj, "").getPropertyValue(styleCSS || style);
}

function GetScrollX() {
	return window.scrollX || document.scrollLeft || document.documentElement.scrollLeft;
}

function GetScrollY() {
	return window.scrollY || document.scrollTop || document.documentElement.scrollTop;
}

function IsInside(obj, x, y, ignoreMargins) {
	obj = mint.$D(obj);
	
	var pos = GetPos(obj, ignoreMargins), size = GetSize(obj);
	
	if(pos.x < x && pos.x+size.width > x && pos.y < y && pos.y+size.height > y)
		return true;

	return false;
}

function GetChildAtPos(obj, x, y, ignoreMargins) {
	var child = mint.$D(obj).childNodes;

	for(var i = child.length-1, ch = child[0]; i >= 0; i--) {
		if(child[i].nodeName != "#text" && IsInside(child[i], x, y, ignoreMargins))
			return child[i];
	}

	return null;
}

function EvalScripts(html) {
	var script;
	var reg = /(?:<script.*?>)((\n|\r|.)*?)(?:<\/script>)/gi;
	var reg2 = /(?:<script.*?src=['"]{1}([^>]*)['"]{1}[^>]*>)((\n|\r|.)*?)(?:<\/script>)/gi;
	
	while(script = reg.exec(html)) {
		if(script[1]) window.execScript ? window.execScript(script[1]) : setTimeout(script[1], 0);
	}
	
	while(script = reg2.exec(html)) {
		if(script[1].length > 0) {
			var s = document.createElement("script");
			s.type = "text/javascript";
			s.src = script[1];
			document.body.appendChild(s);
		}
	}	
}

function HexToRGB(hex) {
	hex = hex.replace(/#/, "");

	return {	r: parseInt(hex.substring(0, 2), 16),
				g: parseInt(hex.substring(2, 4), 16),
				b: parseInt(hex.substring(4, 6), 16)};
}

function RGBToHex(r, g, b) {
	return ToHex(r)+ToHex(g)+ToHex(b)
}

function ToHex(n) {
	if (!n) return "00";

	n = Math.round(Math.min(Math.max(0,parseInt(n)),255));

	return "0123456789ABCDEF".charAt((n-n%16)/16) + "0123456789ABCDEF".charAt(n%16);
}

function SetCookie(name, value, days, path, domain, secure) {
	if(days) {
		var date = new Date();
		date.setTime(date.getTime()+(days*24*60*60*1000));
		var expires = "; expires="+date.toGMTString();
	}
	else
		var expires = "";
		
	document.cookie = name+"="+escape(value)+expires+
		(path ? "; path="+path : "")+
		(domain ? "; domain="+domain : "")+
		(secure ? "; secure="+secure : "");
}

function GetCookie(name) {
	if(document.cookie.length > 0) {
		var start = document.cookie.indexOf(name+"=");
		if(start != -1) {
			start = start+name.length+1;
			var end = document.cookie.indexOf(";",start);
			if(end == -1) end = document.cookie.length;
			return unescape(document.cookie.substring(start, end));
		}
	}
	return "";
}

function DeleteCookie(name) {
	SetCookie(name, "", -1);
}

function InArray(array, value) {
	for(var i = 0; i < array.length; ++i) {
		if(array[i] === value) return true;
	}
	
	return false;
}

$ = mint.$;
$C = mint.$C;
$D = mint.$D;
$R = mint.$R;
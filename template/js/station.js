	Object.assign||Object.defineProperty(Object,"assign",{enumerable:!1,configurable:!0,writable:!0,value:function(t){"use strict";if(null==t)throw new TypeError("Cannot convert first argument to object");for(var e=Object(t),r=1;r<arguments.length;r++){var n=arguments[r];if(null!=n){n=Object(n);for(var i=Object.keys(Object(n)),o=0,s=i.length;o<s;o++){var c=i[o],b=Object.getOwnPropertyDescriptor(n,c);void 0!==b&&b.enumerable&&(e[c]=n[c])}}}return e}}),String.prototype.endsWith||(String.prototype.endsWith=function(t,e){return(void 0===e||e>this.length)&&(e=this.length),this.substring(e-t.length,e)===t});
	
	/**
	 * Minified by jsDelivr using Terser v3.14.1.
	 * Original file: /npm/leaflet.locatecontrol@0.68.0/src/L.Control.Locate.js
	 * 
	 * Do NOT use SRI with dynamically generated files! More information: https://www.jsdelivr.com/using-sri-with-dynamic-files
	 */
	!function(t,i){"function"==typeof define&&define.amd?define(["leaflet"],t):"object"==typeof exports&&(void 0!==i&&i.L?module.exports=t(L):module.exports=t(require("leaflet"))),void 0!==i&&i.L&&(i.L.Control.Locate=t(L))}(function(t){var i=function(i,o,s){(s=s.split(" ")).forEach(function(s){t.DomUtil[i].call(this,o,s)})},o=function(t,o){i("addClass",t,o)},s=function(t,o){i("removeClass",t,o)},e=t.Marker.extend({initialize:function(i,o){t.Util.setOptions(this,o),this._latlng=i,this.createIcon()},createIcon:function(){var i=this.options,o="";void 0!==i.color&&(o+="stroke:"+i.color+";"),void 0!==i.weight&&(o+="stroke-width:"+i.weight+";"),void 0!==i.fillColor&&(o+="fill:"+i.fillColor+";"),void 0!==i.fillOpacity&&(o+="fill-opacity:"+i.fillOpacity+";"),void 0!==i.opacity&&(o+="opacity:"+i.opacity+";");var s=this._getIconSVG(i,o);this._locationIcon=t.divIcon({className:s.className,html:s.svg,iconSize:[s.w,s.h]}),this.setIcon(this._locationIcon)},_getIconSVG:function(t,i){var o=t.radius,s=o+t.weight,e=2*s;return{className:"leaflet-control-locate-location",svg:'<svg xmlns="http://www.w3.org/2000/svg" width="'+e+'" height="'+e+'" version="1.1" viewBox="-'+s+" -"+s+" "+e+" "+e+'"><circle r="'+o+'" style="'+i+'" /></svg>',w:e,h:e}},setStyle:function(i){t.Util.setOptions(this,i),this.createIcon()}}),n=e.extend({initialize:function(i,o,s){t.Util.setOptions(this,s),this._latlng=i,this._heading=o,this.createIcon()},setHeading:function(t){this._heading=t},_getIconSVG:function(t,i){var o=t.radius,s=t.width+t.weight,e=2*(o+t.depth+t.weight),n="M0,0 l"+t.width/2+","+t.depth+" l-"+s+",0 z";return{className:"leaflet-control-locate-heading",svg:'<svg xmlns="http://www.w3.org/2000/svg" width="'+s+'" height="'+e+'" version="1.1" viewBox="-'+s/2+" 0 "+s+" "+e+'" style="'+("transform: rotate("+this._heading+"deg)")+'"><path d="'+n+'" style="'+i+'" /></svg>',w:s,h:e}}}),a=t.Control.extend({options:{position:"topleft",layer:void 0,setView:"untilPanOrZoom",keepCurrentZoomLevel:!1,getLocationBounds:function(t){return t.bounds},flyTo:!1,clickBehavior:{inView:"stop",outOfView:"setView",inViewNotFollowing:"inView"},returnToPrevBounds:!1,cacheLocation:!0,drawCircle:!0,drawMarker:!0,showCompass:!0,markerClass:e,compassClass:n,circleStyle:{className:"leaflet-control-locate-circle",color:"#136AEC",fillColor:"#136AEC",fillOpacity:.15,weight:0},markerStyle:{className:"leaflet-control-locate-marker",color:"#fff",fillColor:"#2A93EE",fillOpacity:1,weight:3,opacity:1,radius:9},compassStyle:{fillColor:"#2A93EE",fillOpacity:1,weight:0,color:"#fff",opacity:1,radius:9,width:9,depth:6},followCircleStyle:{},followMarkerStyle:{},followCompassStyle:{},icon:"fa fa-map-marker",iconLoading:"fa fa-spinner fa-spin",iconElementTag:"span",circlePadding:[0,0],metric:!0,createButtonCallback:function(i,o){var s=t.DomUtil.create("a","leaflet-bar-part leaflet-bar-part-single",i);return s.title=o.strings.title,{link:s,icon:t.DomUtil.create(o.iconElementTag,o.icon,s)}},onLocationError:function(t,i){alert(t.message)},onLocationOutsideMapBounds:function(t){t.stop(),alert(t.options.strings.outsideMapBoundsMsg)},showPopup:!0,strings:{title:"Show me where I am",metersUnit:"meters",feetUnit:"feet",popup:"You are within {distance} {unit} from this point",outsideMapBoundsMsg:"You seem located outside the boundaries of the map"},locateOptions:{maxZoom:1/0,watch:!0,setView:!1}},initialize:function(i){for(var o in i)"object"==typeof this.options[o]?t.extend(this.options[o],i[o]):this.options[o]=i[o];this.options.followMarkerStyle=t.extend({},this.options.markerStyle,this.options.followMarkerStyle),this.options.followCircleStyle=t.extend({},this.options.circleStyle,this.options.followCircleStyle),this.options.followCompassStyle=t.extend({},this.options.compassStyle,this.options.followCompassStyle)},onAdd:function(i){var o=t.DomUtil.create("div","leaflet-control-locate leaflet-bar leaflet-control");this._layer=this.options.layer||new t.LayerGroup,this._layer.addTo(i),this._event=void 0,this._compassHeading=null,this._prevBounds=null;var s=this.options.createButtonCallback(o,this.options);return this._link=s.link,this._icon=s.icon,t.DomEvent.on(this._link,"click",t.DomEvent.stopPropagation).on(this._link,"click",t.DomEvent.preventDefault).on(this._link,"click",this._onClick,this).on(this._link,"dblclick",t.DomEvent.stopPropagation),this._resetVariables(),this._map.on("unload",this._unload,this),o},_onClick:function(){this._justClicked=!0;var t=this._isFollowing();if(this._userPanned=!1,this._userZoomed=!1,this._active&&!this._event)this.stop();else if(this._active&&void 0!==this._event){var i=this.options.clickBehavior,o=i.outOfView;switch(this._map.getBounds().contains(this._event.latlng)&&(o=t?i.inView:i.inViewNotFollowing),i[o]&&(o=i[o]),o){case"setView":this.setView();break;case"stop":if(this.stop(),this.options.returnToPrevBounds)(this.options.flyTo?this._map.flyToBounds:this._map.fitBounds).bind(this._map)(this._prevBounds)}}else this.options.returnToPrevBounds&&(this._prevBounds=this._map.getBounds()),this.start();this._updateContainerStyle()},start:function(){this._activate(),this._event&&(this._drawMarker(this._map),this.options.setView&&this.setView()),this._updateContainerStyle()},stop:function(){this._deactivate(),this._cleanClasses(),this._resetVariables(),this._removeMarker()},stopFollowing:function(){this._userPanned=!0,this._updateContainerStyle(),this._drawMarker()},_activate:function(){if(!this._active&&(this._map.locate(this.options.locateOptions),this._active=!0,this._map.on("locationfound",this._onLocationFound,this),this._map.on("locationerror",this._onLocationError,this),this._map.on("dragstart",this._onDrag,this),this._map.on("zoomstart",this._onZoom,this),this._map.on("zoomend",this._onZoomEnd,this),this.options.showCompass)){var i="ondeviceorientationabsolute"in window;if(i||"ondeviceorientation"in window){var o=this,s=function(){t.DomEvent.on(window,i?"deviceorientationabsolute":"deviceorientation",o._onDeviceOrientation,o)};DeviceOrientationEvent&&"function"==typeof DeviceOrientationEvent.requestPermission?DeviceOrientationEvent.requestPermission().then(function(t){"granted"===t&&s()}):s()}}},_deactivate:function(){this._map.stopLocate(),this._active=!1,this.options.cacheLocation||(this._event=void 0),this._map.off("locationfound",this._onLocationFound,this),this._map.off("locationerror",this._onLocationError,this),this._map.off("dragstart",this._onDrag,this),this._map.off("zoomstart",this._onZoom,this),this._map.off("zoomend",this._onZoomEnd,this),this.options.showCompass&&(this._compassHeading=null,"ondeviceorientationabsolute"in window?t.DomEvent.off(window,"deviceorientationabsolute",this._onDeviceOrientation,this):"ondeviceorientation"in window&&t.DomEvent.off(window,"deviceorientation",this._onDeviceOrientation,this))},setView:function(){if(this._drawMarker(),this._isOutsideMapBounds())this._event=void 0,this.options.onLocationOutsideMapBounds(this);else if(this.options.keepCurrentZoomLevel){(i=this.options.flyTo?this._map.flyTo:this._map.panTo).bind(this._map)([this._event.latitude,this._event.longitude])}else{var i=this.options.flyTo?this._map.flyToBounds:this._map.fitBounds;this._ignoreEvent=!0,i.bind(this._map)(this.options.getLocationBounds(this._event),{padding:this.options.circlePadding,maxZoom:this.options.locateOptions.maxZoom}),t.Util.requestAnimFrame(function(){this._ignoreEvent=!1},this)}},_drawCompass:function(){if(this._event){var t=this._event.latlng;if(this.options.showCompass&&t&&null!==this._compassHeading){var i=this._isFollowing()?this.options.followCompassStyle:this.options.compassStyle;this._compass?(this._compass.setLatLng(t),this._compass.setHeading(this._compassHeading),this._compass.setStyle&&this._compass.setStyle(i)):this._compass=new this.options.compassClass(t,this._compassHeading,i).addTo(this._layer)}!this._compass||this.options.showCompass&&null!==this._compassHeading||(this._compass.removeFrom(this._layer),this._compass=null)}},_drawMarker:function(){void 0===this._event.accuracy&&(this._event.accuracy=0);var i,o,s=this._event.accuracy,e=this._event.latlng;if(this.options.drawCircle){var n=this._isFollowing()?this.options.followCircleStyle:this.options.circleStyle;this._circle?this._circle.setLatLng(e).setRadius(s).setStyle(n):this._circle=t.circle(e,s,n).addTo(this._layer)}if(this.options.metric?(i=s.toFixed(0),o=this.options.strings.metersUnit):(i=(3.2808399*s).toFixed(0),o=this.options.strings.feetUnit),this.options.drawMarker){var a=this._isFollowing()?this.options.followMarkerStyle:this.options.markerStyle;this._marker?(this._marker.setLatLng(e),this._marker.setStyle&&this._marker.setStyle(a)):this._marker=new this.options.markerClass(e,a).addTo(this._layer)}this._drawCompass();var h=this.options.strings.popup;this.options.showPopup&&h&&this._marker&&this._marker.bindPopup(t.Util.template(h,{distance:i,unit:o}))._popup.setLatLng(e),this.options.showPopup&&h&&this._compass&&this._compass.bindPopup(t.Util.template(h,{distance:i,unit:o}))._popup.setLatLng(e)},_removeMarker:function(){this._layer.clearLayers(),this._marker=void 0,this._circle=void 0},_unload:function(){this.stop(),this._map.off("unload",this._unload,this)},_setCompassHeading:function(i){!isNaN(parseFloat(i))&&isFinite(i)?(i=Math.round(i),this._compassHeading=i,t.Util.requestAnimFrame(this._drawCompass,this)):this._compassHeading=null},_onCompassNeedsCalibration:function(){this._setCompassHeading()},_onDeviceOrientation:function(t){this._active&&(t.webkitCompassHeading?this._setCompassHeading(t.webkitCompassHeading):t.absolute&&t.alpha&&this._setCompassHeading(360-t.alpha))},_onLocationError:function(t){3==t.code&&this.options.locateOptions.watch||(this.stop(),this.options.onLocationError(t,this))},_onLocationFound:function(t){if((!this._event||this._event.latlng.lat!==t.latlng.lat||this._event.latlng.lng!==t.latlng.lng||this._event.accuracy!==t.accuracy)&&this._active){switch(this._event=t,this._drawMarker(),this._updateContainerStyle(),this.options.setView){case"once":this._justClicked&&this.setView();break;case"untilPan":this._userPanned||this.setView();break;case"untilPanOrZoom":this._userPanned||this._userZoomed||this.setView();break;case"always":this.setView()}this._justClicked=!1}},_onDrag:function(){this._event&&!this._ignoreEvent&&(this._userPanned=!0,this._updateContainerStyle(),this._drawMarker())},_onZoom:function(){this._event&&!this._ignoreEvent&&(this._userZoomed=!0,this._updateContainerStyle(),this._drawMarker())},_onZoomEnd:function(){this._event&&this._drawCompass(),this._event&&!this._ignoreEvent&&this._marker&&!this._map.getBounds().pad(-.3).contains(this._marker.getLatLng())&&(this._userPanned=!0,this._updateContainerStyle(),this._drawMarker())},_isFollowing:function(){return!!this._active&&("always"===this.options.setView||("untilPan"===this.options.setView?!this._userPanned:"untilPanOrZoom"===this.options.setView?!this._userPanned&&!this._userZoomed:void 0))},_isOutsideMapBounds:function(){return void 0!==this._event&&(this._map.options.maxBounds&&!this._map.options.maxBounds.contains(this._event.latlng))},_updateContainerStyle:function(){this._container&&(this._active&&!this._event?this._setClasses("requesting"):this._isFollowing()?this._setClasses("following"):this._active?this._setClasses("active"):this._cleanClasses())},_setClasses:function(t){"requesting"==t?(s(this._container,"active following"),o(this._container,"requesting"),s(this._icon,this.options.icon),o(this._icon,this.options.iconLoading)):"active"==t?(s(this._container,"requesting following"),o(this._container,"active"),s(this._icon,this.options.iconLoading),o(this._icon,this.options.icon)):"following"==t&&(s(this._container,"requesting"),o(this._container,"active following"),s(this._icon,this.options.iconLoading),o(this._icon,this.options.icon))},_cleanClasses:function(){t.DomUtil.removeClass(this._container,"requesting"),t.DomUtil.removeClass(this._container,"active"),t.DomUtil.removeClass(this._container,"following"),s(this._icon,this.options.iconLoading),o(this._icon,this.options.icon)},_resetVariables:function(){this._active=!1,this._justClicked=!1,this._userPanned=!1,this._userZoomed=!1}});return t.control.locate=function(i){return new t.Control.Locate(i)},a},window);
	//# sourceMappingURL=/sm/769f402b2504f378e492868b050b86609a8c378aeefa0efe7a4920be1bdebd39.map
	/*leaflet-search.js*/
	!function(t){if("function"==typeof define&&define.amd)define(["leaflet"],t);else if("undefined"!=typeof module)module.exports=t(require("leaflet"));else{if(void 0===window.L)throw"Leaflet must be loaded first";t(window.L)}}(function(t){return t.Control.Search=t.Control.extend({includes:"1"===t.version[0]?t.Evented.prototype:t.Mixin.Events,options:{url:"",layer:null,sourceData:null,jsonpParam:null,propertyLoc:"loc",propertyName:"title",formatData:null,filterData:null,moveToLocation:null,buildTip:null,container:"",zoom:null,minLength:1,initial:!0,casesensitive:!1,autoType:!0,delayType:400,tooltipLimit:-1,tipAutoSubmit:!0,firstTipSubmit:!1,autoResize:!0,collapsed:!0,autoCollapse:!1,autoCollapseTime:1200,textErr:"Location not found",textCancel:"Cancel",textPlaceholder:"Search...",hideMarkerOnCollapse:!1,position:"topleft",marker:{icon:!1,animate:!0,circle:{radius:10,weight:3,color:"#e03",stroke:!0,fill:!1}}},_getPath:function(t,e){var i=e.split("."),o=i.pop(),s=i.length,n=i[0],r=1;if(s>0)for(;(t=t[n])&&r<s;)n=i[r++];if(t)return t[o]},_isObject:function(t){return"[object Object]"===Object.prototype.toString.call(t)},initialize:function(e){t.Util.setOptions(this,e||{}),this._inputMinSize=this.options.textPlaceholder?this.options.textPlaceholder.length:10,this._layer=this.options.layer||new t.LayerGroup,this._filterData=this.options.filterData||this._defaultFilterData,this._formatData=this.options.formatData||this._defaultFormatData,this._moveToLocation=this.options.moveToLocation||this._defaultMoveToLocation,this._autoTypeTmp=this.options.autoType,this._countertips=0,this._recordsCache={},this._curReq=null},onAdd:function(e){return this._map=e,this._container=t.DomUtil.create("div","leaflet-control-search"),this._input=this._createInput(this.options.textPlaceholder,"search-input"),this._tooltip=this._createTooltip("search-tooltip"),this._cancel=this._createCancel(this.options.textCancel,"search-cancel"),this._button=this._createButton(this.options.textPlaceholder,"search-button"),this._alert=this._createAlert("search-alert"),!1===this.options.collapsed&&this.expand(this.options.collapsed),this.options.marker&&(this.options.marker instanceof t.Marker||this.options.marker instanceof t.CircleMarker?this._markerSearch=this.options.marker:this._isObject(this.options.marker)&&(this._markerSearch=new t.Control.Search.Marker([0,0],this.options.marker)),this._markerSearch._isMarkerSearch=!0),this.setLayer(this._layer),e.on({resize:this._handleAutoresize},this),this._container},addTo:function(e){return this.options.container?(this._container=this.onAdd(e),this._wrapper=t.DomUtil.get(this.options.container),this._wrapper.style.position="relative",this._wrapper.appendChild(this._container)):t.Control.prototype.addTo.call(this,e),this},onRemove:function(t){this._recordsCache={},t.off({resize:this._handleAutoresize},this)},setLayer:function(t){return this._layer=t,this._layer.addTo(this._map),this},showAlert:function(t){var e=this;return t=t||this.options.textErr,this._alert.style.display="block",this._alert.innerHTML=t,clearTimeout(this.timerAlert),this.timerAlert=setTimeout(function(){e.hideAlert()},this.options.autoCollapseTime),this},hideAlert:function(){return this._alert.style.display="none",this},cancel:function(){return this._input.value="",this._handleKeypress({keyCode:8}),this._input.size=this._inputMinSize,this._input.focus(),this._cancel.style.display="none",this._hideTooltip(),this.fire("search:cancel"),this},expand:function(e){return e="boolean"!=typeof e||e,this._input.style.display="block",t.DomUtil.addClass(this._container,"search-exp"),!1!==e&&(this._input.focus(),this._map.on("dragstart click",this.collapse,this)),this.fire("search:expanded"),this},collapse:function(){return this._hideTooltip(),this.cancel(),this._alert.style.display="none",this._input.blur(),this.options.collapsed&&(this._input.style.display="none",this._cancel.style.display="none",t.DomUtil.removeClass(this._container,"search-exp"),this.options.hideMarkerOnCollapse&&this._map.removeLayer(this._markerSearch),this._map.off("dragstart click",this.collapse,this)),this.fire("search:collapsed"),this},collapseDelayed:function(){var t=this;return this.options.autoCollapse?(clearTimeout(this.timerCollapse),this.timerCollapse=setTimeout(function(){t.collapse()},this.options.autoCollapseTime),this):this},collapseDelayedStop:function(){return clearTimeout(this.timerCollapse),this},_createAlert:function(e){var i=t.DomUtil.create("div",e,this._container);return i.style.display="none",t.DomEvent.on(i,"click",t.DomEvent.stop,this).on(i,"click",this.hideAlert,this),i},_createInput:function(e,i){var o=this,s=t.DomUtil.create("label",i,this._container),n=t.DomUtil.create("input",i,this._container);return n.type="text",n.size=this._inputMinSize,n.value="",n.autocomplete="off",n.autocorrect="off",n.autocapitalize="off",n.placeholder=e,n.style.display="none",n.role="search",n.id=n.role+n.type+n.size,s.htmlFor=n.id,s.style.display="none",s.value=e,t.DomEvent.disableClickPropagation(n).on(n,"keyup",this._handleKeypress,this).on(n,"paste",function(t){setTimeout(function(t){o._handleKeypress(t)},10,t)},this).on(n,"blur",this.collapseDelayed,this).on(n,"focus",this.collapseDelayedStop,this),n},_createCancel:function(e,i){var o=t.DomUtil.create("a",i,this._container);return o.href="#",o.title=e,o.style.display="none",o.innerHTML="<span>&otimes;</span>",t.DomEvent.on(o,"click",t.DomEvent.stop,this).on(o,"click",this.cancel,this),o},_createButton:function(e,i){var o=t.DomUtil.create("a",i,this._container);return o.href="#",o.title=e,t.DomEvent.on(o,"click",t.DomEvent.stop,this).on(o,"click",this._handleSubmit,this).on(o,"focus",this.collapseDelayedStop,this).on(o,"blur",this.collapseDelayed,this),o},_createTooltip:function(e){var i=this,o=t.DomUtil.create("ul",e,this._container);return o.style.display="none",t.DomEvent.disableClickPropagation(o).on(o,"blur",this.collapseDelayed,this).on(o,"mousewheel",function(e){i.collapseDelayedStop(),t.DomEvent.stopPropagation(e)},this).on(o,"mouseover",function(t){i.collapseDelayedStop()},this),o},_createTip:function(e,i){var o;if(this.options.buildTip){if("string"==typeof(o=this.options.buildTip.call(this,e,i))){var s=t.DomUtil.create("div");s.innerHTML=o,o=s.firstChild}}else(o=t.DomUtil.create("li","")).innerHTML=e;return t.DomUtil.addClass(o,"search-tip"),o._text=e,this.options.tipAutoSubmit&&t.DomEvent.disableClickPropagation(o).on(o,"click",t.DomEvent.stop,this).on(o,"click",function(t){this._input.value=e,this._handleAutoresize(),this._input.focus(),this._hideTooltip(),this._handleSubmit()},this),o},_getUrl:function(t){return"function"==typeof this.options.url?this.options.url(t):this.options.url},_defaultFilterData:function(t,e){var i,o,s,n={};if(""===(t=t.replace(/[.*+?^${}()|[\]\\]/g,"")))return[];for(var r in i=this.options.initial?"^":"",o=this.options.casesensitive?void 0:"i",s=new RegExp(i+t,o),e)s.test(r)&&(n[r]=e[r]);return n},showTooltip:function(t){if(this._countertips=0,this._tooltip.innerHTML="",this._tooltip.currentSelection=-1,this.options.tooltipLimit)for(var e in t){if(this._countertips===this.options.tooltipLimit)break;this._countertips++,this._tooltip.appendChild(this._createTip(e,t[e]))}return this._countertips>0?(this._tooltip.style.display="block",this._autoTypeTmp&&this._autoType(),this._autoTypeTmp=this.options.autoType):this._hideTooltip(),this._tooltip.scrollTop=0,this._countertips},_hideTooltip:function(){return this._tooltip.style.display="none",this._tooltip.innerHTML="",0},_defaultFormatData:function(e){var i,o=this.options.propertyName,s=this.options.propertyLoc,n={};if(t.Util.isArray(s))for(i in e)n[this._getPath(e[i],o)]=t.latLng(e[i][s[0]],e[i][s[1]]);else for(i in e)n[this._getPath(e[i],o)]=t.latLng(this._getPath(e[i],s));return n},_recordsFromJsonp:function(e,i){t.Control.Search.callJsonp=i;var o=t.DomUtil.create("script","leaflet-search-jsonp",document.getElementsByTagName("body")[0]),s=t.Util.template(this._getUrl(e)+"&"+this.options.jsonpParam+"=L.Control.Search.callJsonp",{s:e});return o.type="text/javascript",o.src=s,{abort:function(){o.parentNode.removeChild(o)}}},_recordsFromAjax:function(e,i){void 0===window.XMLHttpRequest&&(window.XMLHttpRequest=function(){try{return new ActiveXObject("Microsoft.XMLHTTP.6.0")}catch(t){try{return new ActiveXObject("Microsoft.XMLHTTP.3.0")}catch(t){throw new Error("XMLHttpRequest is not supported")}}});var o=t.Browser.ie&&!window.atob&&document.querySelector?new XDomainRequest:new XMLHttpRequest,s=t.Util.template(this._getUrl(e),{s:e});return o.open("GET",s),o.onload=function(){i(JSON.parse(o.responseText))},o.onreadystatechange=function(){4===o.readyState&&200===o.status&&this.onload()},o.send(),o},_searchInLayer:function(e,i,o){var s,n=this;e instanceof t.Control.Search.Marker||(e instanceof t.Marker||e instanceof t.CircleMarker?n._getPath(e.options,o)?((s=e.getLatLng()).layer=e,i[n._getPath(e.options,o)]=s):n._getPath(e.feature.properties,o)?((s=e.getLatLng()).layer=e,i[n._getPath(e.feature.properties,o)]=s):console.warn("propertyName '"+o+"' not found in marker"):e instanceof t.Path||e instanceof t.Polyline||e instanceof t.Polygon?n._getPath(e.options,o)?((s=e.getBounds().getCenter()).layer=e,i[n._getPath(e.options,o)]=s):n._getPath(e.feature.properties,o)?((s=e.getBounds().getCenter()).layer=e,i[n._getPath(e.feature.properties,o)]=s):console.warn("propertyName '"+o+"' not found in shape"):e.hasOwnProperty("feature")?e.feature.properties.hasOwnProperty(o)?e.getLatLng&&"function"==typeof e.getLatLng?((s=e.getLatLng()).layer=e,i[e.feature.properties[o]]=s):e.getBounds&&"function"==typeof e.getBounds?((s=e.getBounds().getCenter()).layer=e,i[e.feature.properties[o]]=s):console.warn("Unknown type of Layer"):console.warn("propertyName '"+o+"' not found in feature"):e instanceof t.LayerGroup&&e.eachLayer(function(t){n._searchInLayer(t,i,o)}))},_recordsFromLayer:function(){var t=this,e={},i=this.options.propertyName;return this._layer.eachLayer(function(o){t._searchInLayer(o,e,i)}),e},_autoType:function(){var t=this._input.value.length,e=this._tooltip.firstChild?this._tooltip.firstChild._text:"",i=e.length;if(0===e.indexOf(this._input.value))if(this._input.value=e,this._handleAutoresize(),this._input.createTextRange){var o=this._input.createTextRange();o.collapse(!0),o.moveStart("character",t),o.moveEnd("character",i),o.select()}else this._input.setSelectionRange?this._input.setSelectionRange(t,i):this._input.selectionStart&&(this._input.selectionStart=t,this._input.selectionEnd=i)},_hideAutoType:function(){var t;if((t=this._input.selection)&&t.empty)t.empty();else if(this._input.createTextRange){(t=this._input.createTextRange()).collapse(!0);var e=this._input.value.length;t.moveStart("character",e),t.moveEnd("character",e),t.select()}else this._input.getSelection&&this._input.getSelection().removeAllRanges(),this._input.selectionStart=this._input.selectionEnd},_handleKeypress:function(t){var e=this;switch(t.keyCode){case 27:this.collapse();break;case 13:(1==this._countertips||this.options.firstTipSubmit&&this._countertips>0)&&-1==this._tooltip.currentSelection&&this._handleArrowSelect(1),this._handleSubmit();break;case 38:this._handleArrowSelect(-1);break;case 40:this._handleArrowSelect(1);break;case 8:case 45:case 46:this._autoTypeTmp=!1;break;case 37:case 39:case 16:case 17:case 35:case 36:break;default:this._input.value.length?this._cancel.style.display="block":this._cancel.style.display="none",this._input.value.length>=this.options.minLength?(clearTimeout(this.timerKeypress),this.timerKeypress=setTimeout(function(){e._fillRecordsCache()},this.options.delayType)):this._hideTooltip()}this._handleAutoresize()},searchText:function(e){var i=e.charCodeAt(e.length);this._input.value=e,this._input.style.display="block",t.DomUtil.addClass(this._container,"search-exp"),this._autoTypeTmp=!1,this._handleKeypress({keyCode:i})},_fillRecordsCache:function(){var e,i=this,o=this._input.value;this._curReq&&this._curReq.abort&&this._curReq.abort(),t.DomUtil.addClass(this._container,"search-load"),this.options.layer?(this._recordsCache=this._recordsFromLayer(),e=this._filterData(this._input.value,this._recordsCache),this.showTooltip(e),t.DomUtil.removeClass(this._container,"search-load")):(this.options.sourceData?this._retrieveData=this.options.sourceData:this.options.url&&(this._retrieveData=this.options.jsonpParam?this._recordsFromJsonp:this._recordsFromAjax),this._curReq=this._retrieveData.call(this,o,function(o){i._recordsCache=i._formatData.call(i,o),e=i.options.sourceData?i._filterData(i._input.value,i._recordsCache):i._recordsCache,i.showTooltip(e),t.DomUtil.removeClass(i._container,"search-load")}))},_handleAutoresize:function(){var t;this._input.style.maxWidth!==this._map._container.offsetWidth&&(t=this._map._container.clientWidth,t-=83,this._input.style.maxWidth=t.toString()+"px"),this.options.autoResize&&this._container.offsetWidth+20<this._map._container.offsetWidth&&(this._input.size=this._input.value.length<this._inputMinSize?this._inputMinSize:this._input.value.length)},_handleArrowSelect:function(e){var o=this._tooltip.hasChildNodes()?this._tooltip.childNodes:[];for(i=0;i<o.length;i++)t.DomUtil.removeClass(o[i],"search-tip-select");if(1==e&&this._tooltip.currentSelection>=o.length-1)t.DomUtil.addClass(o[this._tooltip.currentSelection],"search-tip-select");else if(-1==e&&this._tooltip.currentSelection<=0)this._tooltip.currentSelection=-1;else if("none"!=this._tooltip.style.display){this._tooltip.currentSelection+=e,t.DomUtil.addClass(o[this._tooltip.currentSelection],"search-tip-select"),this._input.value=o[this._tooltip.currentSelection]._text;var s=o[this._tooltip.currentSelection].offsetTop;s+o[this._tooltip.currentSelection].clientHeight>=this._tooltip.scrollTop+this._tooltip.clientHeight?this._tooltip.scrollTop=s-this._tooltip.clientHeight+o[this._tooltip.currentSelection].clientHeight:s<=this._tooltip.scrollTop&&(this._tooltip.scrollTop=s)}},_handleSubmit:function(){if(this._hideAutoType(),this.hideAlert(),this._hideTooltip(),"none"==this._input.style.display)this.expand();else if(""===this._input.value)this.collapse();else{var t=this._getLocation(this._input.value);!1===t?this.showAlert():(this.showLocation(t,this._input.value),this.fire("search:locationfound",{latlng:t,text:this._input.value,layer:t.layer?t.layer:null}))}},_getLocation:function(t){return!!this._recordsCache.hasOwnProperty(t)&&this._recordsCache[t]},_defaultMoveToLocation:function(t,e,i){this.options.zoom?this._map.setView(t,this.options.zoom):this._map.panTo(t)},showLocation:function(t,e){var i=this;return i._map.once("moveend zoomend",function(e){i._markerSearch&&i._markerSearch.addTo(i._map).setLatLng(t)}),i._moveToLocation(t,e,i._map),i.options.autoCollapse&&i.collapse(),i}}),t.Control.Search.Marker=t.Marker.extend({includes:"1"===t.version[0]?t.Evented.prototype:t.Mixin.Events,options:{icon:new t.Icon.Default,animate:!0,circle:{radius:10,weight:3,color:"#e03",stroke:!0,fill:!1}},initialize:function(e,i){t.setOptions(this,i),!0===i.icon&&(i.icon=new t.Icon.Default),t.Marker.prototype.initialize.call(this,e,i),t.Control.Search.prototype._isObject(this.options.circle)&&(this._circleLoc=new t.CircleMarker(e,this.options.circle))},onAdd:function(e){t.Marker.prototype.onAdd.call(this,e),this._circleLoc&&(e.addLayer(this._circleLoc),this.options.animate&&this.animate())},onRemove:function(e){t.Marker.prototype.onRemove.call(this,e),this._circleLoc&&e.removeLayer(this._circleLoc)},setLatLng:function(e){return t.Marker.prototype.setLatLng.call(this,e),this._circleLoc&&this._circleLoc.setLatLng(e),this},_initIcon:function(){this.options.icon&&t.Marker.prototype._initIcon.call(this)},_removeIcon:function(){this.options.icon&&t.Marker.prototype._removeIcon.call(this)},animate:function(){if(this._circleLoc){var t=this._circleLoc,e=parseInt(t._radius/5),i=this.options.circle.radius,o=2*t._radius,s=0;t._timerAnimLoc=setInterval(function(){o-=e+=s+=.5,t.setRadius(o),o<i&&(clearInterval(t._timerAnimLoc),t.setRadius(i))},200)}return this}}),t.Map.addInitHook(function(){this.options.searchControl&&(this.searchControl=t.control.search(this.options.searchControl),this.addControl(this.searchControl))}),t.control.search=function(e){return new t.Control.Search(e)},t.Control.Search});
	/*! js-cookie v3.0.0-beta.3 | MIT */
	!function(e,t){"object"==typeof exports&&"undefined"!=typeof module?module.exports=t():"function"==typeof define&&define.amd?define(t):(e=e||self,function(){var n=e.Cookies,r=e.Cookies=t();r.noConflict=function(){return e.Cookies=n,r}}())}(this,function(){"use strict";var e={read:function(e){return e.replace(/(%[\dA-F]{2})+/gi,decodeURIComponent)},write:function(e){return encodeURIComponent(e).replace(/%(2[346BF]|3[AC-F]|40|5[BDE]|60|7[BCD])/g,decodeURIComponent)}};function t(e){for(var t=1;t<arguments.length;t++){var n=arguments[t];for(var r in n)e[r]=n[r]}return e}return function n(r,o){function i(e,n,i){if("undefined"!=typeof document){"number"==typeof(i=t({},o,i)).expires&&(i.expires=new Date(Date.now()+864e5*i.expires)),i.expires&&(i.expires=i.expires.toUTCString()),n=r.write(n,e),e=encodeURIComponent(e).replace(/%(2[346B]|5E|60|7C)/g,decodeURIComponent).replace(/[()]/g,escape);var c="";for(var u in i)i[u]&&(c+="; "+u,!0!==i[u]&&(c+="="+i[u].split(";")[0]));return document.cookie=e+"="+n+c}}return Object.create({set:i,get:function(t){if("undefined"!=typeof document&&(!arguments.length||t)){for(var n=document.cookie?document.cookie.split("; "):[],o={},i=0;i<n.length;i++){var c=n[i].split("="),u=c.slice(1).join("=");'"'===u[0]&&(u=u.slice(1,-1));try{var f=e.read(c[0]);if(o[f]=r.read(u,f),t===f)break}catch(e){}}return t?o[t]:o}},remove:function(e,n){i(e,"",t({},n,{expires:-1}))},withAttributes:function(e){return n(this.converter,t({},this.attributes,e))},withConverter:function(e){return n(t({},this.converter,e),this.attributes)}},{attributes:{value:Object.freeze(o)},converter:{value:Object.freeze(r)}})}(e,{path:"/"})});
	
	var osmUrl="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",osmAttrib='Map data © <a href="https://openstreetmap.org">OpenStreetMap</a> contributors',opacity=1,OpenStreetMap=new L.tileLayer(osmUrl,{maxZoom:18,attribution:osmAttrib,opacity:opacity}),Topographic=new L.esri.basemapLayer("Topographic",{opacity:opacity}),Streets=new L.esri.basemapLayer("Streets",{opacity:opacity}),NationalGeographic=new L.esri.basemapLayer("NationalGeographic",{opacity:opacity}),Oceans=new L.esri.basemapLayer("Oceans",{opacity:opacity}),Gray=new L.esri.basemapLayer("Gray",{opacity:opacity}),DarkGray=new L.esri.basemapLayer("DarkGray"),Imagery=new L.esri.basemapLayer("Imagery"),ShadedRelief=new L.esri.basemapLayer("ShadedRelief",{opacity:opacity});

var config = {
	station : {},
	curent_value : {},
	curent_info : null,
	DataFormat: 'th',
	DataLang: 'th',
	rsForecast : null,
	stationDay : null,
	
	
}

$('#pills-tab2').hide();

var pathname = window.location.pathname
pathname = pathname.replace('/','');
pathname = pathname.split("/");

function convertDateFormatDay(dlog){
	var f_date = dlog.split(' ');
	var a_date = f_date[0].split('-');
	var d =a_date[2]+'/'+a_date[1]+'/'+a_date[0];
	var t =f_date[1].substring(0,5);
	return '<span class="px-1"><i class="far fa-calendar-alt"></i> '+d+'</span>';
}

function convertDateFormatHour(dlog){
	var f_date = dlog.split(' ');
	var a_date = f_date[0].split('-');
	var d =a_date[2]+'/'+a_date[1]+'/'+a_date[0];
	var t =f_date[1].substring(0,5);
	return '<span class="px-1"><i class="far fa-clock"></i> '+t+'</span>';
}

function getConverDate(text, type){
	var d = new Date(text);
	var f_date = text.split(' ');
	var a_date = f_date[0].split('-');
	if(type=='en'){
		var months = ["January","February","March","April","May","June","July","August","September","October","November","December"];
		return ' ('+(parseInt(a_date[2])*1)+' '+months[d.getMonth()]+' '+ a_date[0]+')';
	}else{
		var months = ["มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม"];
		return ' ('+(parseInt(a_date[2])*1)+' '+months[d.getMonth()]+' '+ (parseInt(a_date[0])+543)+')';
	}
	
}


$( document ).ready(function() {
    
	$('.btn-search').on('click',function(){
        var id = $('#select-search').val();
		if(id){
			config.province_sel=id;
		}else{
			config.province_sel=null;
		}
    });
	
	$('.btn-menu').on('click',function(){
        $('#sidebar').toggleClass('active');
        $('.overlay').toggleClass('active');
    });
    $('.overlay').on('click',function(){
        if($(this).hasClass('active')){
            $('.overlay').removeClass('active');
            $('#sidebar').removeClass('active');
        }
    }); 
    $('#pills-tab .nav-link').on('click',function(){
        $('#pills-tab .nav-link').removeClass('active');
        $(this).addClass('active');
		config.DataFormat =$(this).attr('dformat');
		setInfo();
		setForecast();
		updateData();
    });
    $('.choose-lang').on('click',function(){
        var lang = $(this).attr('data-lang');
        if(lang == 'th'){
			config.DataLang = 'th';
            $('.choose-lang[data-lang="en"]').removeClass('choose-lang-active');
            $('.choose-lang[data-lang="en"]').addClass('choose-lang-inactive');
            $('.choose-lang[data-lang="th"]').removeClass('choose-lang-inactive');
            $('.choose-lang[data-lang="th"]').addClass('choose-lang-active');
            $('.menu-title').each(function (index, element) {
                var menu_th = $(this).attr('menu-th');
                $(this).html(menu_th);                    
            });
        }else{
			config.DataLang = 'en';
            $('.choose-lang[data-lang="th"]').removeClass('choose-lang-active');
            $('.choose-lang[data-lang="th"]').addClass('choose-lang-inactive');
            $('.choose-lang[data-lang="en"]').removeClass('choose-lang-inactive');
            $('.choose-lang[data-lang="en"]').addClass('choose-lang-active');
            $('.menu-title').each(function (index, element) {
                var menu_en = $(this).attr('menu-en');
                $(this).html(menu_en);                    
            });
        }
		setInfo();
		setForecast();
    });
		
	
	function loadData(){
		var uri = '/api/station/id/'+pathname[1];
		
		$.getJSON(uri, function(db) {	
			if(db){
				config.station=db;
				config.curent_value=db.dustboy_value.pop();
				getInfo(config.curent_value.pm25);
				getForecast();
				getDayValue();
				createMap();
				updateData();
			}
		});
	}	
	
	function getDayValue(){
		if(config.stationDay==null){
			var uri = '/api/station/ids/'+pathname[1];
			$.getJSON(uri, function(db) {
				config.stationDay = db
			});
		}
	}	
	
	
	function getForecast(){
		if(config.rsForecast==null){
			$.getJSON("https://www-old.cmuccdc.org/api2/dustboy/forecast/"+pathname[1], function(data) {
				config.rsForecast=data;
				setForecast();
			});
		}else{
			setForecast();
		}
	}
	
	function getInfo(url){
		if(config.curent_info==null){
			$.getJSON('/api/station/info/'+url, function(db) {
				config.curent_info=db;
				setInfo();
			});
		}else{
			setInfo();
		}
	}
	
	function setForecast(){
		if(config.rsForecast.forecast_days.length){
			for (let index = 1;index < config.rsForecast.forecast_days.length;index++) {
				var forecast = config.rsForecast.forecast_days[index];
				if(config.DataLang=='th'){
				
					$('#forecast'+index+' .card-header').html(forecast.day_name_th + getConverDate(forecast.day_date,'th'));
					if(config.DataFormat=='th'){
						$('#forecast'+index).css("background-color", "rgba(" + forecast.day_th_color +", .7)");
						$('#forecast'+index+' .card-header').css("background-color", "rgba(" + forecast.day_th_color + ", 1)");
						$('#forecast'+index+' img').attr("src", '/template/image/' + forecast.day_th_icon + '.svg');
						$('#forecast'+index+' .forecast-notics').css("color", "rgba(" + forecast.day_th_color +", 1)");
						
					}else{
						$('#forecast'+index).css("background-color", "rgba(" + forecast.day_us_color + ", .7)");
						$('#forecast'+index+' .card-header').css("background-color", "rgba(" + forecast.day_us_color + ", 1)");
						$('#forecast'+index+' img').attr("src", '/template/image/' + forecast.day_us_icon + '.svg');
						$('#forecast'+index+' .forecast-notics').css("color", "rgba(" + forecast.day_us_color +", 1)");
					}
				}else{
					$('#forecast'+index+' .card-header').html(forecast.day_name_en + getConverDate(forecast.day_date,'en'));
					if(config.DataFormat=='th'){
						$('#forecast'+index).css("background-color", "rgba(" + forecast.day_th_color +", .7)");
						$('#forecast'+index+' .card-header').css("background-color", "rgba(" + forecast.day_th_color + ", 1)");
						$('#forecast'+index+' img').attr("src", '/template/image/' + forecast.day_th_icon + '.svg');
						$('#forecast'+index+' .forecast-notics').css("color", "rgba(" + forecast.day_th_color +", 1)");
						
					}else{
						$('#forecast'+index).css("background-color", "rgba(" + forecast.day_us_color + ", .7)");
						$('#forecast'+index+' .card-header').css("background-color", "rgba(" + forecast.day_us_color + ", 1)");
						$('#forecast'+index+' img').attr("src", '/template/image/' + forecast.day_us_icon + '.svg');
						$('#forecast'+index+' .forecast-notics').css("color", "rgba(" + forecast.day_us_color +", 1)");
					}
					
				}
				$('#forecast'+index).show();
			}
			$('#forecast_box').show();
		}
	}
	
	function setInfo(){		
		if(config.DataLang=='th'){
			$('.sensor-title').html(config.station.dustboy_name);
			$('.pm-index').html('คุณภาพอากาศ');
			$('.forecast-title').html('ค่าพยากรณ์ PM2.5 ล่วงหน้า');
			$('.text-hour').html('ค่าฝุ่นรายชั่วโมง (μg/m<sup>3</sup>)');
			$('.text-pmday').html('ค่าฝุ่นรายวัน (μg/m<sup>3</sup>)');
			$('.text-pmaqi').html('PM2.5 AQI รายวัน');
			
			
			$('#notics_number .number').html(config.curent_value.pm25);
			if(config.DataFormat=='th'){
				$('#notics_number').css("color", "rgba(" + config.curent_value.th_color + ", 1)");
				$('.notics-text').css("color", "rgba(" + config.curent_value.th_color + ", 1)");
				$('.notics-text').html(config.curent_info.THAQI.title)
				$('.notics-des').html(config.curent_info.THAQI.caption)
			}else{
				$('#notics_number').css("color", "rgba(" + config.curent_value.us_color + ", 1)");
				$('.notics-text').css("color", "rgba(" + config.curent_value.us_color + ", 1)");
				$('.notics-text').html(config.curent_info.USAQI.title)
				$('.notics-des').html(config.curent_info.USAQI.caption)
			}
			
		}else{
			$('.sensor-title').html(config.station.dustboy_name_en);
			$('.pm-index').html('Air Quality');
			$('.forecast-title').html('PM2.5 Forecast');
			$('.text-hour').html('Hourly average (μg/m<sup>3</sup>)');
			$('.text-pmday').html('Daily average (μg/m<sup>3</sup>)');
			$('.text-pmaqi').html('PM2.5 AQI Daily');
			
			if(config.DataFormat=='th'){
				$('#notics_number').css("color", "rgba(" + config.curent_value.th_color + ", 1)");
				$('.notics-text').css("color", "rgba(" + config.curent_value.th_color + ", 1)");
				$('.notics-text').html(config.curent_info.THAQI.title_en)
				$('.notics-des').html(config.curent_info.THAQI.caption_en)
			}else{
				$('#notics_number').css("color", "rgba(" + config.curent_value.us_color + ", 1)");
				$('.notics-text').css("color", "rgba(" + config.curent_value.us_color + ", 1)");
				$('.notics-text').html(config.curent_info.USAQI.title_en)
				$('.notics-des').html(config.curent_info.USAQI.caption_en)
			}
		}
				
		$('.sensor-source').html('['+config.station.source_name+']');
		$('.value-date').html(convertDateFormatDay(config.curent_value.log_datetime));
		$('.value-time').html(convertDateFormatHour(config.curent_value.log_datetime));
	}
	
	function createChart2(){
		if (config.stationDay.dustboy_value) {
			let day_labels = [];
			let day_bgColor = [];
			let day_bdColor = [];
			let day_data = [];
			let day_aqi_data = [];
			
			let day_data_pm10 = [];
			let day_bgColor_pm10 = [];
			let day_bdColor_pm10 = [];
			
			var img = new Image();
			img.src = 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSBxdN4Mk6bCSXH_JEv9RJLrk13qtG_c7pr7w&usqp=CAU';
			img.onload = function() {
				var ctx = document.getElementById('chartDay').getContext('2d');
				var fillPattern = ctx.createPattern(img, 'repeat');
				
				for (let index = 0;index < config.stationDay.dustboy_value.length;index++) {
					day_labels.push(converDayLabels(config.stationDay.dustboy_value[index].log_datetime));
					day_data.push(config.stationDay.dustboy_value[index].pm25);
					day_bgColor.push(
						config.DataFormat === "th"
							? "rgb(" + config.stationDay.dustboy_value[index].th_color + ")"
							: "rgb(" + config.stationDay.dustboy_value[index].us_color + ")"
						);
					day_bdColor.push(
						config.DataFormat === "th"
							? "rgb(" + config.stationDay.dustboy_value[index].th_color + ")"
							: "rgb(" + config.stationDay.dustboy_value[index].us_color + ")"
						);
						
					day_aqi_data.push(
						config.DataFormat === "th"
							? config.stationDay.dustboy_value[index].pm25_th_aqi
							: config.stationDay.dustboy_value[index].pm25_us_aqi
						);
					
					day_data_pm10.push(config.stationDay.dustboy_value[index].pm10);
					day_bgColor_pm10.push(fillPattern);
					day_bdColor_pm10.push(
						config.DataFormat === "th"
							? "rgb(" + config.stationDay.dustboy_value[index].pm10_th_color + ")"
							: "rgb(" + config.stationDay.dustboy_value[index].pm10_us_color + ")"
						);
				}
				
				
				
				var chartData = {
					labels: day_labels,
					datasets: [
						{
							type: 'bar',
							label: 'PM2.5 Daily' ,
							backgroundColor: day_bgColor,
							borderColor: day_bdColor,
							borderWidth: 2,
							fill: false,
							data:day_data
						},
						{
							type: 'bar',
							label: 'PM10 Daily' ,
							backgroundColor: day_bgColor_pm10,
							borderColor: day_bdColor_pm10,
							borderWidth: 2,
							fill: false,
							data:day_data_pm10
						}
					]
				};
				
				new Chart(ctx, {
					type: "bar",
					data:chartData,
					options: {
						legend: {
							 display: false,
						},
						responsive: true,
						maintainAspectRatio: false,
						scales: {
							yAxes: [
								{
									ticks: {
										min: 0,
										stepSize: 0.5,
											
									},
								},
							],
							xAxes: [{
								ticks: {
									display: true
								}
							}]
						},
						tooltips: {
							mode: 'index',
							intersect: true
						}
					},
				});
				
				
				var chartData2 = {
					labels: day_labels,
					datasets: [
						{
							type: 'bar',
							label: 'PM2.5 Daily' ,
							backgroundColor: day_bgColor,
							borderColor: day_bdColor,
							borderWidth: 2,
							fill: false,
							data:day_aqi_data
						},
					]
				};
				
				var ctx2 = document.getElementById('chartAQIDay').getContext('2d');
				new Chart(ctx2, {
					type: "bar",
					data:chartData2,
					options: {
						legend: {
							 display: false,
						},
						responsive: true,
						maintainAspectRatio: false,
						scales: {
							yAxes: [
								{
									ticks: {
										min: 0,
										stepSize: 0.5,
											
									},
								},
							],
							xAxes: [{
								ticks: {
									display: true
								}
							}]
						},
						tooltips: {
							mode: 'index',
							intersect: true
						}
					},
				});
			}
			
		}
	}
	
	function updateData(){
		if(config.station!=null){
			
			
			if(config.stationDay==null){
				var uri = '/api/station/ids/'+pathname[1];
				$.getJSON(uri, function(db) {
					config.stationDay = db;
					createChart2();
				});
			}else{
				createChart2();
			}
			
			//createChart PMHour

			if (config.station.dustboy_value) {
				config.station.dustboy_value.push(config.curent_value);
				//config.curent_value
				let labels = [];
				let backgroundColor = [];
				let borderColor = [];
				let data = [];

				let d_data = [];
				let d_backgroundColor = [];
				let d_borderColor = [];
				
				let data_pm10 = [];
				let pm10_backgroundColor = [];
				let pm10_borderColor = [];
				
				let data_pm10_daily = [];
				let pm10_backgroundColor_daily = [];
				let pm10_borderColor_daily = [];
				
				var img = new Image();
				img.src = 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSBxdN4Mk6bCSXH_JEv9RJLrk13qtG_c7pr7w&usqp=CAU';
				img.onload = function() {
					var ctx = document.getElementById('chartHour').getContext('2d');
					var fillPattern = ctx.createPattern(img, 'repeat');
					
					for (let index = 0;index < config.station.dustboy_value.length;index++) {
						labels.push(converDateLabels(config.station.dustboy_value[index].log_datetime));
						data.push(config.station.dustboy_value[index].pm25);
						backgroundColor.push(
							config.DataFormat === "th"
							  ? "rgb(" + config.station.dustboy_value[index].th_color + ")"
							  : "rgb(" + config.station.dustboy_value[index].us_color + ")"
						  );
						borderColor.push(
							config.DataFormat === "th"
							  ? "rgb(" + config.station.dustboy_value[index].th_color + ")"
							  : "rgb(" + config.station.dustboy_value[index].us_color + ")"
						  );
						d_data.push(config.station.dustboy_value[index].daily_pm25);
						d_backgroundColor.push(
							config.DataFormat === "th"
							  ? "rgb(" + config.station.dustboy_value[index].daily_th_color + ")"
							  : "rgb(" + config.station.dustboy_value[index].daily_us_color + ")"
						  );
						d_borderColor.push(
							config.DataFormat === "th"
							  ? "rgb(" + config.station.dustboy_value[index].daily_th_color + ")"
							  : "rgb(" + config.station.dustboy_value[index].daily_us_color + ")"
						  );
						  
						data_pm10.push(config.station.dustboy_value[index].pm10);
						pm10_backgroundColor.push(fillPattern);
						pm10_borderColor.push(
							config.DataFormat === "th"
							  ? "rgb(" + config.station.dustboy_value[index].pm10_th_color + ")"
							  : "rgb(" + config.station.dustboy_value[index].pm10_us_color + ")"
						  );
						  
						data_pm10_daily.push(config.station.dustboy_value[index].daily_pm10);
						pm10_backgroundColor_daily.push(
							config.DataFormat === "th"
							  ? "rgb(" + config.station.dustboy_value[index].daily_th_color + ")"
							  : "rgb(" + config.station.dustboy_value[index].daily_us_color + ")"
						  );
						pm10_borderColor_daily.push(
							config.DataFormat === "th"
							  ? "rgb(" + config.station.dustboy_value[index].pm10_daily_th_color + ")"
							  : "rgb(" + config.station.dustboy_value[index].pm10_daily_us_color + ")"
						  );
					}
					//createChartHour			
					var chartData = {
						labels: labels,
						datasets: [
							{
								type: 'line',
								label: 'PM2.5 ค่าเฉลี่ย 24 ชั่วโมง',
								backgroundColor: d_backgroundColor,
								borderColor: d_borderColor,
								borderWidth: 1,
								pointStyle: 'circle',
								fill: false,
								data: d_data
							},
							{
								type: 'line',
								label: 'PM10 ค่าเฉลี่ย 24 ชั่วโมง',
								backgroundColor: pm10_backgroundColor_daily,
								borderColor: pm10_borderColor_daily,
								borderWidth: 1,
								pointStyle: 'triangle',
								fill: false,
								data: data_pm10_daily
							},
							{
								type: 'bar',
								label: 'PM2.5 รายชั่วโมง' ,
								backgroundColor: backgroundColor,
								borderColor: borderColor,
								borderWidth: 2,
								fill: false,
								data:data
							},
							{
								type: 'bar',
								label: 'PM10 รายชั่วโมง' ,
								backgroundColor: pm10_backgroundColor,
								borderColor: pm10_borderColor,
								borderWidth: 1,
								fill: false,
								data:data_pm10
							},
						]
					};
					
					new Chart(ctx, {
						type: "bar",
						data:chartData,
						options: {
							legend: {
							  display: false,
							},
							responsive: true,
							maintainAspectRatio: false,
							scales: {
								yAxes: [
									{
										ticks: {
											min: 0,
											stepSize: 0.5,
											
										},
									},
								],
								xAxes: [{
									ticks: {
										display: true
									}
								}]
							},
							tooltips: {
								mode: 'index',
								intersect: true
							}
						},
					});
				}
			}			
			
		}
	}
	
	function converDayLabels(datetime){
		var a_date = datetime.split('-');
		var d =a_date[2]+'/'+a_date[1]+'/'+a_date[0];
		return d;
	}
	
	function converDateLabels(datetime){
	
		var f_date = datetime.split(' ');
		var a_date = f_date[0].split('-');
		var d =a_date[2]+'/'+a_date[1]+'/'+a_date[0];
		var t =f_date[1].substring(0,5);
		

		
		return d+' '+t;

	}
	
	function createMap(){
		
		var map = new L.map("mapid", {
			center: [config.station.dustboy_lat, config.station.dustboy_lon],
			zoom: 14,
			attributionControl: !1,
			maxZoom: 17,
			minZoom: 14,
			fullscreenControl: true,
			fullscreenControlOptions: {
				position: 'topleft'
			},
			layers: [OpenStreetMap]
		}),


		baseMaps = {
			OpenStreetMap: OpenStreetMap,
			Topographic: Topographic,
			Streets: Streets,
			NationalGeographic: NationalGeographic,
			"<span style='color: gray'>Gray</span>": Gray,
			DarkGray: DarkGray,
			Imagery: Imagery,
			ShadedRelief: ShadedRelief,
			Oceans: Oceans
		},
		layerControl = new L.control.layers(baseMaps);
		layerControl.addTo(map);
		var actualLayerGroup = new L.layerGroup([], {});
		
		var marker = L.marker([config.station.dustboy_lat,config.station.dustboy_lon]).addTo(map);
		marker.bindPopup("<b>"+config.station.dustboy_name+"</b>").openPopup();
	}	
	
	
	loadData();

});



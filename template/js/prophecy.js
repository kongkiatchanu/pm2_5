var osmUrl="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",osmAttrib='Map data © <a href="https://openstreetmap.org">OpenStreetMap</a> contributors',opacity=1,OpenStreetMap=new L.tileLayer(osmUrl,{maxZoom:18,attribution:osmAttrib,opacity:opacity}),Topographic=new L.esri.basemapLayer("Topographic",{opacity:opacity}),Streets=new L.esri.basemapLayer("Streets",{opacity:opacity}),NationalGeographic=new L.esri.basemapLayer("NationalGeographic",{opacity:opacity}),Oceans=new L.esri.basemapLayer("Oceans",{opacity:opacity}),Gray=new L.esri.basemapLayer("Gray",{opacity:opacity}),DarkGray=new L.esri.basemapLayer("DarkGray"),Imagery=new L.esri.basemapLayer("Imagery"),ShadedRelief=new L.esri.basemapLayer("ShadedRelief",{opacity:opacity});

$('#pills-tab').hide()
$('#pills-tab2').hide()

var config = {
	DataFormat : 'th',
	DataLang: 'th',
	DataHotspotType: 'MODIS',
	pm_region : '',
	pm_top : 'All',
	curentStation: {},
	station_point: null,
	location : {
		lat : null,
		lon : null,
		dis : 'All'
	},
	province_sel : null,
	province_all : [],
	pmLocations : {},
	rsForecast :{},
	rsProphecy :{},
	rsProphecy_region :''
}

$( document ).ready(function() {
	$('#pills-tab .nav-link').on('click',function(){
        $('#pills-tab .nav-link').removeClass('active');
        $(this).addClass('active');
		config.DataFormat =$(this).attr('dformat');
		if(pathname.substring(0,8)=="prophecy"){
			if(config.rsProphecy){
				createProphecy(config.rsProphecy_region)
			}
		}
	});
	var ck_region = '';
		if(getUrlParameter('region')){
			config.pm_region = getUrlParameter('region');
			var reg = [];
			reg['north']	= 1;
			reg['central']	= 2;
			reg['northeast']= 3;
			reg['western']	= 4;
			reg['eastern']	= 5;
			reg['south']	= 6;
			reg['other']	= 7;
			
			config.rsProphecy_region = reg[config.pm_region];
	
		}

		$.getJSON("https://www-old.cmuccdc.org/api2/dustboy/regionreport", function(data) {
			config.rsProphecy = data;
			if(config.rsProphecy){
				createProphecy(config.rsProphecy_region);
			}
		});
		
		
	$(".blurinator").click(function () {
		var mapid = $(this).attr("mapid");
		html2canvas(document.getElementById("mapForecast" + mapid), {
			useCORS: true,
			logging: true,
		}).then(function (canvas) {
			var myImage = canvas.toDataURL();
			//console.log(myImage)
			$.ajax({
				type: "POST",
				url: "/main/createMapImage",
				data: {
					mapid: mapid,
					photo: myImage,
				},
			}).done(function (o) {
				if(o){
					var url = '/prophecy_export/'+mapid;
					window.open(url, '_blank');
				}
			});
		});
	});

});


function getBG(n,f){
	var txt = '';
	//console.log(config.DataFormat);
	if(n){
		if(f=='th'){
			if(n<=25){
				txt ='style="background-color: rgb(0,191,243)"';
			}else if(n>25 && n<=37){
				txt ='style="background-color: rgb(0,166,81)"';
			}else if(n>37 && n<=50){
				txt ='style="background-color: rgb(253,192,78)"';
			}else if(n>20 && n<=90){
				txt ='style="background-color: rgb(242,101,34)"';
			}else if(n>90 && n<=999){
				txt ='style="background-color: rgb(205,0,0)"';
			}
		}else{
			if(n<=12){
				txt ='style="background-color: rgb(0, 153, 107)"';
			}else if(n>12 && n<=35){
				txt ='style="background-color: rgb(253,192,78)"';
			}else if(n>35 && n<=55){
				txt ='style="background-color: rgb(235, 132, 63)"';
			}else if(n>55 && n<=150){
				txt ='style="background-color: rgb(205,0,0)"';
			}else if(n>150 && n<=250){
				txt ='style="background-color: rgb(129, 21, 185)"';
			}else if(n>250){
				txt ='style="background-color: rgb(160, 7, 54)"';
			}
		}
		return txt;
	}
}

function getBG2(n){
	if(n<=25){
		txt ='background-color: rgb(0,191,243)';
	}else if(n>25 && n<=37){
		txt ='background-color: rgb(0,166,81)';
	}else if(n>37 && n<=50){
		txt ='background-color: rgb(253,192,78)';
	}else if(n>20 && n<=90){
		txt ='background-color: rgb(242,101,34)';
	}else if(n>90 && n<=999){
		txt ='background-color: rgb(205,0,0)';
	}
	return txt;
}

function createProphecy(region){
	
	
	for (let index = 0; index < config.rsProphecy.length; index++) {
		var zones_id = config.rsProphecy[index].zone_id;
		if(region){
			if(zones_id == region){
				$('.forecast-title'+ zones_id).html(config.rsProphecy[index].zone_name_th);
				
				//ck province
				var html = '';
				if(config.rsProphecy[index].provinces.length){
					for (let index_pv = 0; index_pv < config.rsProphecy[index].provinces.length; index_pv++) {
						
						//station
						if(config.rsProphecy[index].provinces[index_pv].stations.length){
							for (let index_st = 0; index_st < config.rsProphecy[index].provinces[index_pv].stations.length; index_st++) {
								var pm25 = config.rsProphecy[index].provinces[index_pv].stations[index_st].pm25.PM25;
								var weather = config.rsProphecy[index].provinces[index_pv].stations[index_st].weather;
								
								var forecast1 = null; 
								var forecast2 = null; 
								var forecast3 = null; 
								if(weather.length){
									for(index_forecast=0; index_forecast<weather.length; index_forecast++){
										var sp = weather[index_forecast].ForecastDate.split("T");		
										if($('#today_add').val()==sp[0]){
											forecast1 = weather[index_forecast].PM25;
										}
										if($('#today_add2').val()==sp[0]){
											forecast2 = weather[index_forecast].PM25;
										}
										if($('#today_add3').val()==sp[0]){
											forecast3 = weather[index_forecast].PM25;
										}
									}
								}
								
								html+='<tr>';
								html+='<td>'+config.rsProphecy[index].provinces[index_pv].stations[index_st].location_name+'</td>';
								html+='<td>'+config.rsProphecy[index].provinces[index_pv].province_name_th+'</td>';
								html+='<td class="text-center"><div class="pm-bage" '+getBG(pm25,config.DataFormat)+'>'+pm25+'</div></td>';
								html+='<td class="text-center"><div class="pm-bage" '+getBG(forecast1,config.DataFormat)+'>'+forecast1+'</div></td>';
								html+='<td class="text-center"><div class="pm-bage" '+getBG(forecast2,config.DataFormat)+'>'+forecast2+'</div></td>';
								html+='<td class="text-center"><div class="pm-bage" '+getBG(forecast3,config.DataFormat)+'>'+forecast3+'</div></td>';
								html+='</tr>';
							}		
						}
						
					}
				}
				$('#tblProphecy'+ zones_id+ ' tbody').html(html);
				
				$('#box_'+ zones_id).show();
			}
		}else{
			$('.forecast-title'+zones_id).html(config.rsProphecy[index].zone_name_th);
				var html = '';
				if(config.rsProphecy[index].provinces.length){
					for (let index_pv = 0; index_pv < config.rsProphecy[index].provinces.length; index_pv++) {
						
						//station
						if(config.rsProphecy[index].provinces[index_pv].stations.length){
							for (let index_st = 0; index_st < config.rsProphecy[index].provinces[index_pv].stations.length; index_st++) {
								var pm25 = config.rsProphecy[index].provinces[index_pv].stations[index_st].pm25.PM25;
								var weather = config.rsProphecy[index].provinces[index_pv].stations[index_st].weather;
								
								var forecast1 = null; 
								var forecast2 = null; 
								var forecast3 = null; 
								if(weather.length){
									for(index_forecast=0; index_forecast<weather.length; index_forecast++){
										var sp = weather[index_forecast].ForecastDate.split("T");
										if($('#today_add').val()==sp[0]){
											forecast1 = weather[index_forecast].PM25;
										}
										if($('#today_add2').val()==sp[0]){
											forecast2 = weather[index_forecast].PM25;
										}
										if($('#today_add3').val()==sp[0]){
											forecast3 = weather[index_forecast].PM25;
										}
									}
								}
								
								html+='<tr>';
								html+='<td>'+config.rsProphecy[index].provinces[index_pv].stations[index_st].location_name+'</td>';
								html+='<td>'+config.rsProphecy[index].provinces[index_pv].province_name_th+'</td>';
								html+='<td class="text-center"><div class="pm-bage" '+getBG(pm25,config.DataFormat)+'>'+pm25+'</div></td>';
								html+='<td class="text-center"><div class="pm-bage" '+getBG(forecast1,config.DataFormat)+'>'+forecast1+'</div></td>';
								html+='<td class="text-center"><div class="pm-bage" '+getBG(forecast2,config.DataFormat)+'>'+forecast2+'</div></td>';
								html+='<td class="text-center"><div class="pm-bage" '+getBG(forecast3,config.DataFormat)+'>'+forecast3+'</div></td>';
								html+='</tr>';
							}		
						}
						
					}
				}
				$('#tblProphecy'+ zones_id+ ' tbody').html(html);
				$('#box_'+ zones_id).show();
		}
		
	}
	$('.table').DataTable({"bDestroy": true});
	$('.loader').hide();
	
	createMap(region);
	
}


			
function createMap(region){
	var location = [];
	location[1]	= [18.7828996, 98.9933469];
	location[2]	= [15.7670029, 100.5126912];
	location[3] = [16.441610, 103.537464];
	location[4]	= [14.74601483, 98.62522061];
	location[5]	= [12.614961, 102.113984];
	location[6]	= [7.4046537, 99.51923];
	location[7]	= [19.0198515, 102.2896127];

	for (let index = 0; index < config.rsProphecy.length; index++) {
		var zones_id = config.rsProphecy[index].zone_id;
		if(region){
			if(zones_id == region){
			
				var map = new L.map("mapForecast"+region, {
					center: location[region],
					zoom: 6,
					attributionControl: !1,
					maxZoom: 7,
					minZoom: 5,
				});
				
				L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
					attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
				}).addTo(map);

				if(config.rsProphecy[index].provinces.length){
					for (let index_pv = 0; index_pv < config.rsProphecy[index].provinces.length; index_pv++) {
						
						//station
						if(config.rsProphecy[index].provinces[index_pv].stations.length){
							for (let index_st = 0; index_st < config.rsProphecy[index].provinces[index_pv].stations.length; index_st++) {
								let station = config.rsProphecy[index].provinces[index_pv].stations[index_st];
								
								let marker = L.marker(
									[station.location_lat, station.location_lon],
									{
									  icon: L.divIcon({
										className: "my-custom-icon",
										iconSize: [35 ,35],
										html: '<div class="signoutz-marker" style="'+getBG2(station.pm25.PM25)+'">'+ station.pm25.PM25+'</div>',
									  }),
									}
								  );
								if(station.pm25.PM25>0){
									marker.addTo(map);
								}
							}
						}
					}
				}

			}

		}else{
			//map1
			var map_1 = new L.map("mapForecast1", {
				center: location[1],
				zoom: 6,
				attributionControl: !1,
				maxZoom: 7,
				minZoom: 5,
			});
			L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
					attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
			}).addTo(map_1);
			
			//map2
			var map_2 = new L.map("mapForecast2", {
				center: location[2],
				zoom: 6,
				attributionControl: !1,
				maxZoom: 7,
				minZoom: 5,
			});
			L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
					attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
			}).addTo(map_2);
			
			//map3
			var map_3 = new L.map("mapForecast3", {
				center: location[3],
				zoom: 6,
				attributionControl: !1,
				maxZoom: 7,
				minZoom: 5,
			});
			L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
					attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
			}).addTo(map_3);
			
			//map4
			var map_4 = new L.map("mapForecast4", {
				center: location[4],
				zoom: 6,
				attributionControl: !1,
				maxZoom: 7,
				minZoom: 5,
			});
			L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
					attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
			}).addTo(map_4);
			
			//map5
			var map_5 = new L.map("mapForecast5", {
				center: location[5],
				zoom: 7,
				attributionControl: !1,
				maxZoom: 7,
				minZoom: 5,
			});
			L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
					attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
			}).addTo(map_5);
			
			//map6
			var map_6 = new L.map("mapForecast6", {
				center: location[6],
				zoom: 6,
				attributionControl: !1,
				maxZoom: 7,
				minZoom: 5,
			});
			L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
					attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
			}).addTo(map_6);
			
			//map7
			var map_7 = new L.map("mapForecast7", {
				center: location[7],
				zoom: 6,
				attributionControl: !1,
				maxZoom: 7,
				minZoom: 5,
				attributionControl: !1,
			});
			L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
					attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
			}).addTo(map_7);
			
			
			for (let index = 0; index < config.rsProphecy.length; index++) {
				var zones_id = config.rsProphecy[index].zone_id;
				
				if(config.rsProphecy[index].provinces.length){
					for (let index_pv = 0; index_pv < config.rsProphecy[index].provinces.length; index_pv++) {
						
						//station
						if(config.rsProphecy[index].provinces[index_pv].stations.length){
							for (let index_st = 0; index_st < config.rsProphecy[index].provinces[index_pv].stations.length; index_st++) {
								let station = config.rsProphecy[index].provinces[index_pv].stations[index_st];
								
								
								let marker = L.marker(
									[station.location_lat, station.location_lon],
									{
									  icon: L.divIcon({
										className: "my-custom-icon",
										iconSize: [35 ,35],
										html: '<div class="signoutz-marker" style="'+getBG2(station.pm25.PM25)+'">'+ station.pm25.PM25+'</div>',
									  }),
									}
								  );
								  
								if(station.pm25.PM25>0){
									if(zones_id==1){
										marker.addTo(map_1);
									}
									if(zones_id==2){
										marker.addTo(map_2);
									}
									if(zones_id==3){
										marker.addTo(map_3);
									}
									if(zones_id==4){
										marker.addTo(map_4);
									}
									if(zones_id==5){
										marker.addTo(map_5);
									}
									if(zones_id==6){
										marker.addTo(map_6);
									}
									if(zones_id==7){
										marker.addTo(map_7);
									}
									
								}
								
							}
						}
					}
				}
			}
			
			
			/*
			leafletImage(map_1, doImage);
			leafletImage(map_2, doImage);
			leafletImage(map_3, doImage);
			leafletImage(map_4, doImage);
			leafletImage(map_5, doImage);
			leafletImage(map_6, doImage);
			leafletImage(map_7, doImage);
			*/
		}
	}
	
	
}


var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = window.location.search.substring(1),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return typeof sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
        }
    }
    return false;
};
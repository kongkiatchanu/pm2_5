var osmUrl="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",osmAttrib='Map data © <a href="https://openstreetmap.org">OpenStreetMap</a> contributors',opacity=1,OpenStreetMap=new L.tileLayer(osmUrl,{maxZoom:18,attribution:osmAttrib,opacity:opacity}),Topographic=new L.esri.basemapLayer("Topographic",{opacity:opacity}),Streets=new L.esri.basemapLayer("Streets",{opacity:opacity}),NationalGeographic=new L.esri.basemapLayer("NationalGeographic",{opacity:opacity}),Oceans=new L.esri.basemapLayer("Oceans",{opacity:opacity}),Gray=new L.esri.basemapLayer("Gray",{opacity:opacity}),DarkGray=new L.esri.basemapLayer("DarkGray"),Imagery=new L.esri.basemapLayer("Imagery"),ShadedRelief=new L.esri.basemapLayer("ShadedRelief",{opacity:opacity});
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


		
var optionText_th = {
	title : 'ค่า PM2.5 รายชั่วโมง จากสถานีเครื่องวัดที่อยู่ในระยะ',
	rgtitle : 'อันดับค่าฝุ่นทุกสถานี',
	rgtime : '',
	station : 'สถานีเครื่องวัด',
	dis : 'ระยะห่าง (km)',
	pm : 'PM2.5 (μg/m<sup>3</sup>)',
	hour_no : 'ลำดับ',
	hour_name : 'สถานีเครื่องวัด',
	hour_value : 'PM2.5 (μg/m<sup>3</sup>)',
	hour_value10 : 'PM10 (μg/m<sup>3</sup>)',
}
var optionText_en = {
	title : 'Value of PM2.5 hourly from station in range',
	rgtitle : 'Average top ranking',
	rgtime : '',
	station : 'Stations',
	dis : 'Distance (km)',
	pm : 'PM2.5 (μg/m<sup>3</sup>)',
	hour_no : 'No.',
	hour_name : 'Stations',
	hour_value : 'PM2.5 (μg/m<sup>3</sup>)',
	hour_value10 : 'PM10 (μg/m<sup>3</sup>)',
}

function convertDateFormatDay(dlog, type){
	var f_date = dlog.split(' ');
	var a_date = f_date[0].split('-');
	var d =a_date[2]+'/'+a_date[1]+'/'+a_date[0];
	var t =f_date[1].substring(0,5);
	return '<span class="px-1"><i class="far fa-calendar-alt"></i> '+d+'</span>';
}

function convertDateFormatHour(dlog, type){
	var f_date = dlog.split(' ');
	var a_date = f_date[0].split('-');
	var d =a_date[2]+'/'+a_date[1]+'/'+a_date[0];
	var t =f_date[1].substring(0,5);
	return '<span class="px-1"><i class="far fa-clock"></i> '+t+'</span>';
}

var pathname = window.location.pathname
pathname = pathname.replace('/','');


if(pathname=="contactus"){
	$('#pills-tab').hide()
	$('#pills-tab2').hide()
}
if(pathname=="snapshot"){
	$('#pills-tab').hide()
	$('#pills-tab2').hide()
}
if(pathname=="news"){
	$('#pills-tab').hide()
	$('#pills-tab2').hide()
}	
if(pathname=="definition"){
	$('#pills-tab').hide()
	$('#pills-tab2').hide()
}	

if(pathname.substring(0,10)=="newsdetail"){
	$('#pills-tab').hide()
	$('#pills-tab2').hide()
}	
if(pathname=="rank-hours"){
	$('#pills-tab2').hide()
}	
if(pathname=="rank-dailys"){
	$('#pills-tab2').hide()
}
if(pathname.substring(0,8)=="forecast"){
	$('#pills-tab').show()
	$('#pills-tab2').hide()
}
if(pathname.substring(0,8)=="prophecy"){
	$('#pills-tab').hide()
	$('#pills-tab2').hide()
}
if(pathname.substring(0,7)=="station"){
	$('#pills-tab').show()
	$('#pills-tab2').hide()
}

if(pathname.substring(0,11)=="dailyreport"){
	$('#pills-tab').hide()
	$('#pills-tab2').hide()
}
		
$( document ).ready(function() {
	//loadData
	$('.btn-search').on('click',function(){
        var id = $('#select-search').val();
		if(id){
			config.province_sel=id;
		}else{
			config.province_sel=null;
		}
		if(pathname=="rank-hours"){
			getTblPMHourResult();
		}
		
		if(pathname=="rank-dailys"){
			getTblPMDayResult();
		}
		$("#searchModel").modal('hide');
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
		fn_setFormat();
		if(pathname=="pmhours"){
			if(config.pmLocations!=null){
				getTblResult();
				nearStation(config.station_point);
			}
		}
		if(pathname=="rank-hours"){
			if(config.pmLocations!=null){
				getTblPMHourResult()
				nearStation(config.station_point);
			}
		}
		if(pathname=="rank-dailys"){
			if(config.pmLocations!=null){
				getTblPMDayResult();
				nearStation2(config.station_point);
			}
		}
		if(pathname.substring(0,8)=="forecast"){
			if(config.rsForecast){
				createForecastChart();
			}
		}
		if(pathname.substring(0,8)=="prophecy"){
			if(config.rsProphecy){
				createProphecy(config.rsProphecy_region)
			}
		}
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
		
		if(pathname=="pmhours"){
			if(config.pmLocations!=null){
				getTblResult();
				nearStation(config.station_point);
			}
		}
		
		if(pathname=="rank-hours"){
			if(config.pmLocations!=null){
				getTblPMHourResult();
				nearStation(config.station_point);
			}
		}
		
		if(pathname=="rank-dailys"){
			if(config.pmLocations!=null){
				getTblPMDayResult();
				nearStation2(config.station_point);
			}
		}
		
		if(pathname.substring(0,8)=="forecast"){
			if(config.rsForecast){
				createForecastChart();
			}
		}

    });
	
	if(pathname=="pmhours"){
		$('#pills-tab2').hide()
		getLocation();
		function getLocation() {
			navigator.geolocation && navigator.geolocation.getCurrentPosition(showPosition)
		}
		function showPosition(t) {
			
			if(t.coords.latitude!=null && t.coords.longitude!=null){
				config.location.lat = t.coords.latitude;
				config.location.lon = t.coords.longitude;
				$.getJSON("https://www-old.cmuccdc.org/api2/dustboy/near/"+config.location.lat+"/"+config.location.lon, function(data) {
					config.pmLocations = data;
					getTblResult();
				});
			}
		}
		
		$('.btn-locations').on('click',function(){
			var dis = $.trim($(this).html());
			
			$('.btn-locations').removeClass("btn-success");
			$('.btn-locations').addClass("btn-secondary");
			
			$(this).removeClass("btn-secondary");
			$(this).addClass("btn-success");

			config.location.dis = dis;
			getTblResult();
		})
	}
	
	if(pathname=="rank-hours"){
		var ck_region = '';
		if(getUrlParameter('region')){
			config.pm_region = getUrlParameter('region');
			var reg = [];
			reg['north']	= 1;//
			reg['central']	= 2;//
			reg['northeast']= 3;
			reg['western']	= 4;//
			reg['south']	= 6;
			reg['eastern']	= 5;
			ck_region = reg[config.pm_region];
		}
		
		$.getJSON("https://www-old.cmuccdc.org/api2/dustboy/rankingnrct/hourly/"+ck_region, function(data) {
			config.pmLocations = data;
			if(config.pm_region){
				$('#rgname').html('อันดับค่าฝุ่น '+data.zone_name_th)
				$('.update-time').html('ข้อมูลเฉลี่ยรายชั่วโมง '+convertDateFormatDay(data.log_datetime)+' '+convertDateFormatHour(data.log_datetime), pathname);
				config.pmLocations = data.stations;
			}
			getTblPMHourResult()
		});
		
		$('.btn-top').on('click',function(){
			config.pm_top = $(this).attr("top");
			
			$('.btn-top').removeClass("btn-success");
			$('.btn-top').addClass("btn-secondary");
			$(this).addClass("btn-success");
			
			getTblPMHourResult()
		})
		
		loadSelectData(ck_region);
	}
	
	if(pathname=="rank-dailys"){
		var ck_region = '';
		if(getUrlParameter('region')){
			config.pm_region = getUrlParameter('region');
			var reg = [];
			reg['north']	= 1;//
			reg['central']	= 2;//
			reg['northeast']= 3;
			reg['western']	= 4;//
			reg['south']	= 6;
			reg['eastern']	= 5;
			ck_region = reg[config.pm_region];
		}
		
		$.getJSON("https://www-old.cmuccdc.org/api2/dustboy/rankingnrct/daily/"+ck_region, function(data) {
			config.pmLocations = data;
			if(config.pm_region){
				$('#rgname').html('อันดับค่าฝุ่น '+data.zone_name_th)
				$('.update-time').html('ข้อมูลเฉลี่ยรายชั่วโมง '+convertDateFormatDay(data.log_datetime)+' '+convertDateFormatHour(data.log_datetime), pathname);
				config.pmLocations = data.stations;
			}
			getTblPMDayResult()
		});
		
		$('.btn-top').on('click',function(){
			config.pm_top = $(this).attr("top");
			
			$('.btn-top').removeClass("btn-success");
			$('.btn-top').addClass("btn-secondary");
			$(this).addClass("btn-success");
			
			getTblPMDayResult()
		})
		
		loadSelectData(ck_region);
		
	}
	
	if(pathname.substring(0,8)=="forecast"){
		var id = pathname.split("/");
		if(id){
			$.getJSON("https://www-old.cmuccdc.org/api2/dustboy/forecast/"+id[1], function(data) {
				config.rsForecast = data;
				if(config.rsForecast){
					createForecastChart();
				}
			});
		}
	}
	
	if(pathname.substring(0,8)=="prophecy"){
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
		
	}

	function loadSelectData(ck_region){
		$.getJSON("/template/plugins/region_pwa.json", function(db) {
			config.province_all = db;
			if(db){
				var html = '';
				for (let index = 0; index < db.length; index++) {
					if(!ck_region){
						html+='<optgroup label="'+db[index].zone_name_th+'">';
						if(db[index].provinces.length>0){
							for (let index2 = 0; index2 < db[index].provinces.length; index2++) {
								html+='<option value="'+db[index].provinces[index2].province_code+'">'+db[index].provinces[index2].province_name_th+'</option>';
							}
						}
						html+='</optgroup>';
					}else if(ck_region==db[index].zone_id){
						html+='<optgroup label="'+db[index].zone_name_th+'">';
						if(db[index].provinces.length>0){
							for (let index2 = 0; index2 < db[index].provinces.length; index2++) {
								html+='<option value="'+db[index].provinces[index2].province_code+'">'+db[index].provinces[index2].province_name_th+'</option>';
							}
						}
						html+='</optgroup>';
					}
				}
				$('#select-search').html(html);
			}
		});
	}
	
	if(pathname=="contactus"){
		$.get("/googleanalytics/HelloAnalytics.php",function(data) {
			$("#analyticsstat").html(data);
		  }
		);
	}
	if(pathname=="snapshot"){
		$(".datetime").datepicker({ 
			format: 'yyyy-mm-dd'
		});
			
		function getSnapshot(source, action){
			var tmp='';
			$.getJSON("https://www-old.cmuccdc.org/api2/dustboy/snapshot/"+source+"/"+action, function(result){		
				tmp += '<div class="row">';
				if(result[0]){
					$.each(result[0].snapshots, function (key,value) {
						tmp +='<div class="col-sm-4" style="margin-bottom:15px;position: relative;">';
						tmp +='<span style="position: absolute;background-color: #9dc02d;padding: 2px;color: #fff;">'+value.lastupdated+'</span>';
						tmp +='<a target="_blank" href="'+value.image_url+'"><img src="'+value.image_url+'" class="img-fluid"/></a></div>';
					});
				}else{
					tmp +='<div class="col-md-12"><p class="text-center"> ไม่พบข้อมูล </p></div>';
				}
				tmp += '</div>';
				$('.loader').hide();
				$('#display_snapshot').html(tmp);
			});
		}
					
		getSnapshot($('#source').val(), $('#dateStart').val());
			
		$('#btn-filter').on( "click", function() {
			$('.loader').show();
			$('#display_snapshot').html('');
			getSnapshot($('#source').val(), $('#dateStart').val(), $('#stime').val());
		});
	}
	
	if(pathname=="news"){
		$("#news-page-news-feed .news-slice").slice(0, 6).show();
		$(".news-see-more-btn").on('click', function (e) {
			e.preventDefault();
			$("#news-page-news-feed .news-slice:hidden").slice(0, 6).slideDown();
			if ($("#news-page-news-feed .news-slice:hidden").length === 0) {
				$(".news-see-more-btn").addClass('disabled btn');
			}
		});
	}

});

function getProvinceName(id){
		for (let index = 0; index < config.province_all.length; index++) {
			for (let index2 = 0; index2 < config.province_all[index].provinces.length; index2++) {
				if(config.province_all[index].provinces[index2].province_code==id){
					return config.province_all[index].provinces[index2].province_name_th
				}
			}
		}
	}


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
										if($('#today').val()==sp[0]){
											forecast1 = weather[index_forecast].PM25;
										}
										if($('#today_add').val()==sp[0]){
											forecast2 = weather[index_forecast].PM25;
										}
										if($('#today_add2').val()==sp[0]){
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
			$('#box_'+zones_id).show();
		}
		
	}
	$('.table').DataTable({"bDestroy": true});
	$('.loader').hide();
}

function createForecastChart(){
	if(config.rsForecast){
		if(config.DataLang == 'th'){
			$('#rgname').html('คาดการณ์ค่าฝุ่น PM2.5')
			$('#rgname2').html(config.rsForecast.station_name_th);
		}else{
			$('#rgname').html('Forecast PM2.5')
			$('#rgname2').html(config.rsForecast.station_name_en);
		}
		
		if (config.rsForecast.is_display_forecast) {
		
			for (let index = 1;index < config.rsForecast.forecast_days.length;index++) {
				
				let forecast_hours_data = config.rsForecast.forecast_days[index].forecast_hours;
				let labels = [];
				let backgroundColor = [];
				let borderColor = [];
				let data = [];
				for (let index2 = 0; index2 < forecast_hours_data.length; index2++) {
				  labels.push(forecast_hours_data[index2].time);
				  data.push(forecast_hours_data[index2].hour_avg_pm25);
				  backgroundColor.push(
					config.DataFormat === "th"
					  ? "rgb(" + forecast_hours_data[index2].hour_th_color + ")"
					  : "rgb(" + forecast_hours_data[index2].hour_us_color + ")"
				  );
				  borderColor.push(
					config.DataFormat === "th"
					  ? "rgb(" + forecast_hours_data[index2].hour_th_color + ")"
					  : "rgb(" + forecast_hours_data[index2].hour_us_color + ")"
				  );
				}
				
				if(config.DataFormat == 'th'){
					$('#card_'+index+' .bg_icon').attr('src','/template/image/'+config.rsForecast.forecast_days[index].day_th_icon+'.svg');
					$('#card_'+index+' .bg_color').css("background-color", "rgba(" + config.rsForecast.forecast_days[index].day_th_color + ", 1)");
				}else{
					$('#card_'+index+' .bg_icon').attr('src','/template/image/'+config.rsForecast.forecast_days[index].day_us_icon+'.svg');
					$('#card_'+index+' .bg_color').css("background-color", "rgba(" + config.rsForecast.forecast_days[index].day_us_color + ", 1)");
				}
				if(config.DataLang == 'th'){
					$('#card_'+index+' .day_name').html(config.rsForecast.forecast_days[index].day_name_th);
					$('#card_'+index+' .avg_name').html('PM2.5 เฉลี่ย');
				}else{
					$('#card_'+index+' .day_name').html(config.rsForecast.forecast_days[index].day_name_en);
					$('#card_'+index+' .avg_name').html('PM2.5 Average');
				}
				
				new Chart(document.getElementById("my-chart-" + index), {
				  type: "bar",
				  data: {
					labels: labels,
					datasets: [
					  {
						label: "# of avg pm25",
						data: data,
						backgroundColor: backgroundColor,
						borderColor: borderColor,
					  },
					],
				  },
				  options: {
					legend: {
					  display: false,
					},
					responsive: true,
					scales: {
					  yAxes: [
						{
						  ticks: {
							min: 0,
							stepSize: 0.2,
						  },
						},
					  ],
					},
				  },
				});
				
			}
		}
		
		
		
		
		
		
		
		
	}
}
function getTblResult(){
	if(config.pmLocations){
		var data_header ;
		if(config.DataLang == 'th'){
			data_header=optionText_th
		}else{
			data_header=optionText_en
		}
		var ck_loop =0;
		var table_header ='<div class="row"><div class="col-12"><div class="table hourly"><div class="table-head"><div class="table-row"><div class="table-column">'+data_header.station+'</div><div class="table-column">'+data_header.dis+'</div><div class="table-column">'+data_header.pm+'</div></div></div><div class="table-body">';
		var table_body ='';
		var table_footer ='</div></div></div></div>';
		var station_point ;
		
		$.each(config.pmLocations, function(i, item) {
			if(config.location.dis == "All"){
				table_body+='<div><div class="table-row" id="row_'+item.id+'"><button class="btn btn-table" onclick="nearStation('+item.id+')">';
				if(config.DataLang=='th'){
					table_body+='<div class="table-column">'+item.dustboy_name+'</div>';
				}else{
					table_body+='<div class="table-column">'+item.dustboy_name_en+'</div>';
				}
				
				table_body+='<div class="table-column">'+parseFloat(item.distance).toFixed(2)+'</div>';
				if(config.DataFormat=='th'){
					table_body+='<div class="table-column"><div class="bg-blue" style="background-color: rgb('+item.th_color+');">'+item.pm25+'</div></div>';
				}else{
					table_body+='<div class="table-column"><div class="bg-blue" style="background-color: rgb('+item.us_color+');">'+item.pm25+'</div></div>';
				}
				table_body+='</button></div></div>';
				if(ck_loop==0){
					if(!config.station_point){
						config.station_point= item.id;
					}
				}
				ck_loop++;
			}else{
				
				var dt = config.location.dis.split(" ");
				if(parseFloat(item.distance) < parseFloat(dt[0])){
					table_body+='<div><div class="table-row"><button class="btn btn-table">';
					if(config.DataLang=='th'){
						table_body+='<div class="table-column">'+item.dustboy_name+'</div>';
					}else{
						table_body+='<div class="table-column">'+item.dustboy_name_en+'</div>';
					}
					
					table_body+='<div class="table-column">'+parseFloat(item.distance).toFixed(2)+'</div>';
					if(config.DataFormat=='th'){
						table_body+='<div class="table-column"><div class="bg-blue" style="background-color: rgb('+item.th_color+');">'+item.pm25+'</div></div>';
					}else{
						table_body+='<div class="table-column"><div class="bg-blue" style="background-color: rgb('+item.us_color+');">'+item.pm25+'</div></div>';
					}
					table_body+='</button></div></div>';
					if(ck_loop==0){
						if(!config.station_point){
							config.station_point= item.id;
						}
					}
					ck_loop++;
				}
				
			}
		});
		
		$('#pagename').html(data_header.title);
		$('#tblResult').html(table_header+table_body+table_footer);
		$('#tblResult').show();
		$('.standard_sqi_legend_footer').show();
		if(ck_loop>0){$(".loader").hide();}
	}
}

function getTblPMDayResult(){
	if(config.pmLocations){
		
		if(config.province_sel){
			$('#rgname').html('อันดับค่าฝุ่น จังหวัด'+getProvinceName(config.province_sel));
		}
		
		var data_header ;
		if(config.DataLang == 'th'){
			data_header=optionText_th
		}else{
			data_header=optionText_en
		}
		var ck_loop =0;
		var table_header ='<div class="row"><div class="col-12"><div class="table hourly"><div class="table-head"><div class="table-row"><div class="table-column">'+data_header.hour_no+'</div><div class="table-column" style="display: flex;">'+data_header.hour_name+'</div><div class="table-column">'+data_header.hour_value+'</div><div class="table-column">AQI</div></div></div><div class="table-body">';
		var table_body ='';
		var table_footer ='</div></div></div></div>';
		var station_point ;

			//all
			var rows = 0;
			$.each(config.pmLocations, function(i, item) {
				if(config.province_sel){
					//loop by province
					if(item.province_code==config.province_sel){
						//loop all
						rows++;
						if(config.pm_top=="All" && item.daily_pm25>0){
							if(!config.pm_region){
								$('.update-time').html('ข้อมูลเฉลี่ยรายวัน '+convertDateFormatDay(item.log_datetime)+' '+convertDateFormatHour(item.log_datetime), pathname);
							}
							table_body+='<div><div class="table-row" id="row_'+item.id+'"><button class="btn btn-table" onclick="nearStation2('+item.id+')">';
							
							table_body+='<div class="table-column">'+ rows +'</div>';
							if(config.DataLang=='th'){
								table_body+='<div class="table-column table-column-custom">'+item.dustboy_name+'</div>';
							}else{
								table_body+='<div class="table-column table-column-custom">'+item.dustboy_name_en+'</div>';
							}
								
							if(config.DataFormat=='th'){
								table_body+='<div class="table-column"><div class="bg-blue" style="background-color: rgb('+item.daily_th_color+');">'+item.daily_pm25+'</div></div>';
								table_body+='<div class="table-column"><div class="bg-blue" style="background-color: rgb('+item.daily_th_color+');">'+item.daily_pm25_th_aqi+'</div></div>';
							}else{
								table_body+='<div class="table-column"><div class="bg-blue" style="background-color: rgb('+item.daily_us_color+');">'+item.daily_pm25+'</div></div>';
								table_body+='<div class="table-column"><div class="bg-blue" style="background-color: rgb('+item.daily_us_color+');">'+item.daily_pm25_us_aqi+'</div></div>';
							}
							table_body+='</button></div></div>';
							if(ck_loop==0){
								if(!config.station_point){
									config.station_point= item.id;
								}
							}
							ck_loop++;
						}else if(rows<=config.pm_top && item.daily_pm25>0){
							if(!config.pm_region){
								$('.update-time').html('ข้อมูลเฉลี่ยรายชั่วโมง '+convertDateFormatDay(item.log_datetime)+' '+convertDateFormatHour(item.log_datetime), pathname);
							}
							table_body+='<div><div class="table-row" id="row_'+item.id+'"><button class="btn btn-table" onclick="nearStation2('+item.id+')">';
							
							table_body+='<div class="table-column">'+ rows +'</div>';
							if(config.DataLang=='th'){
								table_body+='<div class="table-column table-column-custom">'+item.dustboy_name+'</div>';
							}else{
								table_body+='<div class="table-column table-column-custom">'+item.dustboy_name_en+'</div>';
							}
							
							
							if(config.DataFormat=='th'){
								table_body+='<div class="table-column"><div class="bg-blue" style="background-color: rgb('+item.daily_th_color+');">'+item.daily_pm25+'</div></div>';
								table_body+='<div class="table-column"><div class="bg-blue" style="background-color: rgb('+item.daily_th_color+');">'+item.daily_pm25_th_aqi+'</div></div>';
							}else{
								table_body+='<div class="table-column"><div class="bg-blue" style="background-color: rgb('+item.daily_us_color+');">'+item.daily_pm25+'</div></div>';
								table_body+='<div class="table-column"><div class="bg-blue" style="background-color: rgb('+item.daily_us_color+');">'+item.daily_pm25_us_aqi+'</div></div>';
							}
							table_body+='</button></div></div>';
							if(ck_loop==0){
								if(!config.station_point){
									config.station_point= item.id;
								}
							}
							ck_loop++;
						}
					}
				}else{
					//loop all
					rows++;
					if(config.pm_top=="All" && item.daily_pm25>0){
						if(!config.pm_region){
							$('.update-time').html('ข้อมูลเฉลี่ยรายวัน '+convertDateFormatDay(item.log_datetime)+' '+convertDateFormatHour(item.log_datetime), pathname);
						}
						table_body+='<div><div class="table-row" id="row_'+item.id+'"><button class="btn btn-table" onclick="nearStation2('+item.id+')">';
						
						table_body+='<div class="table-column">'+ rows +'</div>';
						if(config.DataLang=='th'){
							table_body+='<div class="table-column table-column-custom">'+item.dustboy_name+'</div>';
						}else{
							table_body+='<div class="table-column table-column-custom">'+item.dustboy_name_en+'</div>';
						}
						
						
						if(config.DataFormat=='th'){
							table_body+='<div class="table-column"><div class="bg-blue" style="background-color: rgb('+item.daily_th_color+');">'+item.daily_pm25+'</div></div>';
							table_body+='<div class="table-column"><div class="bg-blue" style="background-color: rgb('+item.daily_th_color+');">'+item.daily_pm25_th_aqi+'</div></div>';
						}else{
							table_body+='<div class="table-column"><div class="bg-blue" style="background-color: rgb('+item.daily_us_color+');">'+item.daily_pm25+'</div></div>';
							table_body+='<div class="table-column"><div class="bg-blue" style="background-color: rgb('+item.daily_us_color+');">'+item.daily_pm25_us_aqi+'</div></div>';
						}
						table_body+='</button></div></div>';
						if(ck_loop==0){
							if(!config.station_point){
								config.station_point= item.id;
							}
						}
						ck_loop++;
					}else if(rows<=config.pm_top && item.daily_pm25>0){
						if(!config.pm_region){
							$('.update-time').html('ข้อมูลเฉลี่ยรายชั่วโมง '+convertDateFormatDay(item.log_datetime)+' '+convertDateFormatHour(item.log_datetime), pathname);
						}
						table_body+='<div><div class="table-row" id="row_'+item.id+'"><button class="btn btn-table" onclick="nearStation2('+item.id+')">';
						
						table_body+='<div class="table-column">'+ rows +'</div>';
						if(config.DataLang=='th'){
							table_body+='<div class="table-column table-column-custom">'+item.dustboy_name+'</div>';
						}else{
							table_body+='<div class="table-column table-column-custom">'+item.dustboy_name_en+'</div>';
						}
						
						
						if(config.DataFormat=='th'){
							table_body+='<div class="table-column"><div class="bg-blue" style="background-color: rgb('+item.daily_th_color+');">'+item.daily_pm25+'</div></div>';
							table_body+='<div class="table-column"><div class="bg-blue" style="background-color: rgb('+item.daily_th_color+');">'+item.daily_pm25_th_aqi+'</div></div>';
						}else{
							table_body+='<div class="table-column"><div class="bg-blue" style="background-color: rgb('+item.daily_us_color+');">'+item.daily_pm25+'</div></div>';
							table_body+='<div class="table-column"><div class="bg-blue" style="background-color: rgb('+item.daily_us_color+');">'+item.daily_pm25_us_aqi+'</div></div>';
						}
						table_body+='</button></div></div>';
						if(ck_loop==0){
							if(!config.station_point){
								config.station_point= item.id;
							}
						}
						ck_loop++;
					}
				}
			});
		
		
		$('#tblResult').html(table_header+table_body+table_footer);
		$('#tblResult').show();
		$('.standard_sqi_legend_footer').show();
		if(ck_loop>0){$(".loader").hide();}
	}
}

function filter() {
    var keyword = document.getElementById("txt_search").value;
    var select = document.getElementById("select-search");
    for (var i = 0; i < select.length; i++) {
        var txt = select.options[i].text;
        if (txt.substring(0, keyword.length).toLowerCase() !== keyword.toLowerCase() && keyword.trim() !== "") {
          $(select.options[i]).attr('disabled', 'disabled').hide();
        } else {
          $(select.options[i]).removeAttr('disabled').show();
        }
    }
}

function getTblPMHourResult(){
	if(config.pmLocations){
		if(config.province_sel){
			$('#rgname').html('อันดับค่าฝุ่น จังหวัด'+getProvinceName(config.province_sel));
		}
		
		var data_header ;
		if(config.DataLang == 'th'){
			data_header=optionText_th
		}else{
			data_header=optionText_en
		}
		var ck_loop =0;
		var table_header ='<div class="row"><div class="col-12"><div class="table hourly"><div class="table-head"><div class="table-row"><div class="table-column">'+data_header.hour_no+'</div><div class="table-column" style="display: flex;">'+data_header.hour_name+'</div><div class="table-column">'+data_header.hour_value+'</div><div class="table-column">'+data_header.hour_value10+'</div></div></div><div class="table-body">';
		var table_body ='';
		var table_footer ='</div></div></div></div>';
		var station_point ;
		
			
			
			
			//all
			var rows = 0;
			$.each(config.pmLocations, function(i, item) {
				if(config.province_sel){
					if(item.province_code==config.province_sel){
						
						rows++;
						if(config.pm_top=="All"){
							if(!config.pm_region){
								$('.update-time').html('ข้อมูลเฉลี่ยรายชั่วโมง '+convertDateFormatDay(item.log_datetime)+' '+convertDateFormatHour(item.log_datetime), pathname);
							}
							table_body+='<div><div class="table-row" id="row_'+item.id+'"><button class="btn btn-table" onclick="nearStation('+item.id+')">';
							
							table_body+='<div class="table-column">'+ rows +'</div>';
							if(config.DataLang=='th'){
								table_body+='<div class="table-column table-column-custom">'+item.dustboy_name+'</div>';
							}else{
								table_body+='<div class="table-column table-column-custom">'+item.dustboy_name_en+'</div>';
							}
							
							
							if(config.DataFormat=='th'){
								table_body+='<div class="table-column"><div class="bg-blue" style="background-color: rgb('+item.th_color+');">'+item.pm25+'</div></div>';
							}else{
								table_body+='<div class="table-column"><div class="bg-blue" style="background-color: rgb('+item.us_color+');">'+item.pm25+'</div></div>';
							}
							
							table_body+='<div class="table-column"><div class="bg-blue" style="background-color: rgb(165,165,165);">'+item.pm10+'</div></div>';
							
							table_body+='</button></div></div>';
							if(ck_loop==0){
								if(!config.station_point){
									config.station_point= item.id;
								}
							}
							ck_loop++;
						}else if(rows<=config.pm_top){
							if(!config.pm_region){
								$('.update-time').html('ข้อมูลเฉลี่ยรายชั่วโมง '+convertDateFormatDay(item.log_datetime)+' '+convertDateFormatHour(item.log_datetime), pathname);
							}
							table_body+='<div><div class="table-row" id="row_'+item.id+'"><button class="btn btn-table" onclick="nearStation('+item.id+')">';
							
							table_body+='<div class="table-column">'+ rows +'</div>';
							if(config.DataLang=='th'){
								table_body+='<div class="table-column table-column-custom">'+item.dustboy_name+'</div>';
							}else{
								table_body+='<div class="table-column table-column-custom">'+item.dustboy_name_en+'</div>';
							}
							
							
							if(config.DataFormat=='th'){
								table_body+='<div class="table-column"><div class="bg-blue" style="background-color: rgb('+item.th_color+');">'+item.pm25+'</div></div>';
							}else{
								table_body+='<div class="table-column"><div class="bg-blue" style="background-color: rgb('+item.us_color+');">'+item.pm25+'</div></div>';
							}
							
							table_body+='<div class="table-column"><div class="bg-blue" style="background-color: rgb(165,165,165);">'+item.pm10+'</div></div>';
							table_body+='</button></div></div>';
							if(ck_loop==0){
								if(!config.station_point){
									config.station_point= item.id;
								}
							}
							ck_loop++;	
						}
					}
				}else{
					rows++;
					if(config.pm_top=="All"){
						if(!config.pm_region){
							$('.update-time').html('ข้อมูลเฉลี่ยรายชั่วโมง '+convertDateFormatDay(item.log_datetime)+' '+convertDateFormatHour(item.log_datetime), pathname);
						}
						table_body+='<div><div class="table-row" id="row_'+item.id+'"><button class="btn btn-table" onclick="nearStation('+item.id+')">';
						
						table_body+='<div class="table-column">'+ rows +'</div>';
						if(config.DataLang=='th'){
							table_body+='<div class="table-column table-column-custom">'+item.dustboy_name+'</div>';
						}else{
							table_body+='<div class="table-column table-column-custom">'+item.dustboy_name_en+'</div>';
						}
						
						
						if(config.DataFormat=='th'){
							table_body+='<div class="table-column"><div class="bg-blue" style="background-color: rgb('+item.th_color+');">'+item.pm25+'</div></div>';
						}else{
							table_body+='<div class="table-column"><div class="bg-blue" style="background-color: rgb('+item.us_color+');">'+item.pm25+'</div></div>';
						}
						table_body+='<div class="table-column"><div class="bg-blue" style="background-color: rgb(165,165,165);">'+item.pm10+'</div></div>';
						table_body+='</button></div></div>';
						if(ck_loop==0){
							if(!config.station_point){
								config.station_point= item.id;
							}
						}
						ck_loop++;
					}else if(rows<=config.pm_top){
						if(!config.pm_region){
							$('.update-time').html('ข้อมูลเฉลี่ยรายชั่วโมง '+convertDateFormatDay(item.log_datetime)+' '+convertDateFormatHour(item.log_datetime), pathname);
						}
						table_body+='<div><div class="table-row" id="row_'+item.id+'"><button class="btn btn-table" onclick="nearStation('+item.id+')">';
						
						table_body+='<div class="table-column">'+ rows +'</div>';
						if(config.DataLang=='th'){
							table_body+='<div class="table-column table-column-custom">'+item.dustboy_name+'</div>';
						}else{
							table_body+='<div class="table-column table-column-custom">'+item.dustboy_name_en+'</div>';
						}
						
						
						if(config.DataFormat=='th'){
							table_body+='<div class="table-column"><div class="bg-blue" style="background-color: rgb('+item.th_color+');">'+item.pm25+'</div></div>';
						}else{
							table_body+='<div class="table-column"><div class="bg-blue" style="background-color: rgb('+item.us_color+');">'+item.pm25+'</div></div>';
						}
						table_body+='<div class="table-column"><div class="bg-blue" style="background-color: rgb(165,165,165);">'+item.pm10+'</div></div>';
						table_body+='</button></div></div>';
						if(ck_loop==0){
							if(!config.station_point){
								config.station_point= item.id;
							}
						}
						ck_loop++;	
					}
				}
			});
		
		
		$('#tblResult').html(table_header+table_body+table_footer);
		$('#tblResult').show();
		$('.standard_sqi_legend_footer').show();
		if(ck_loop>0){$(".loader").hide();}
	}
}

function nearStation2(id){
	
	config.station_point = id;
	var card_name ;
	var card_title ;
	if(pathname=="rank-dailys"){
		$.each(config.pmLocations, function(i, item) {
			if(item.id==config.station_point){
				config.curentStation = item;
				card_name = item.dustboy_name;
				card_title = item.th_title;
				if(config.DataLang == 'en'){
					card_name = item.dustboy_name_en
					card_title = item.th_title_en;
				}
			}
		});
	}
	
	$('.card-marker').remove();
				if(config.DataFormat=='th'){
					var html = '<div class="card card-marker" style="display: block; padding: 0px;">';
					html 	+= '	<div class="card-body" style="background-color: rgb('+config.curentStation.daily_th_color+');">';
					html 	+= '		<button type="button" class="btn btn-close" style="background-color: rgb('+config.curentStation.daily_th_color+');"><img alt="image" src="/template/image/icon-close.svg" width="14" height="14" /></button>';
					html 	+= '		<h5 class="card-title">'+card_name+'</h5>';
					html 	+= '		<div class="card-description"> <div class="card-cover"> <img alt="image" src="/template/image/'+config.curentStation.daily_th_dustboy_icon+'" width="59" height="85"/> </div><div class="card-quality"> <div class="card-value">'+config.curentStation.daily_pm25+'</div><div class="card-info"> PM2.5 (μg/m<sup>3</sup>) </div></div></div>';
					html 	+= '		<div class="card-description"> <div class="card-detail card-detail-custom"> <h4>'+card_title+'</h4> </div></div>';
					html 	+= '	</div>';
					html 	+= '	<div class="card-footer" style="background-color: rgb('+config.curentStation.daily_th_color+');"> <div class="card-items card-items-footer"> <div class="card-date"><span class="data-date">'+convertDateFormatDay(config.curentStation.log_datetime, pathname)+'</span><span class="data-time">'+convertDateFormatHour(config.curentStation.log_datetime, pathname)+'</span> </div></div><a target="_blank" href="/station/'+config.curentStation.id+'" class="btn-favorite"><img alt="image" src="/template/image/icon-info-w.svg" width="18" height="17"/></a> </div>';
					html 	+= '</div>';
				}else{
					var html = '<div class="card card-marker" style="display: block; padding: 0px;">';
					html 	+= '	<div class="card-body" style="background-color: rgb('+config.curentStation.daily_us_color+');">';
					html 	+= '		<button type="button" class="btn btn-close" style="background-color: rgb('+config.curentStation.daily_us_color+');"><img alt="image" src="/template/image/icon-close.svg" width="14" height="14" /></button>';
					html 	+= '		<h5 class="card-title">'+card_name+'</h5>';
					html 	+= '		<div class="card-description"> <div class="card-cover"> <img alt="image" src="/template/image/'+config.curentStation.daily_us_dustboy_icon+'" width="59" height="85"/> </div><div class="card-quality"> <div class="card-value">'+config.curentStation.daily_pm25+'</div><div class="card-info"> PM2.5 (μg/m<sup>3</sup>) </div></div></div>';
					html 	+= '		<div class="card-description"> <div class="card-detail card-detail-custom"> <h4>'+card_title+'</h4> </div></div>';
					html 	+= '	</div>';
					html 	+= '	<div class="card-footer" style="background-color: rgb('+config.curentStation.daily_us_color+');"> <div class="card-items card-items-footer"> <div class="card-date"><span class="data-date">'+convertDateFormatDay(config.curentStation.log_datetime, pathname)+'</span><span class="data-time">'+convertDateFormatHour(config.curentStation.log_datetime, pathname)+'</span> </div></div><a target="_blank" href="/station/'+config.curentStation.id+'" class="btn-favorite"><img alt="image" src="/template/image/icon-info-w.svg" width="18" height="17"/></a> </div>';
					html 	+= '</div>';
				}
				$( "#row_"+id ).before( html );
}
function nearStation(id){
	config.station_point = id;
	var card_name ;
	
	var card_title ;
	if(pathname=="rank-hours"){
		$.each(config.pmLocations, function(i, item) {
			if(item.id==config.station_point){
				config.curentStation = item;
				card_name = item.dustboy_name;
				card_title = item.th_title;
				if(config.DataLang == 'en'){
					card_name = item.dustboy_name_en
					card_title = item.th_title_en;
				}
			}
		});
	}
	if(pathname=="rank-dailys"){
		$.each(config.pmLocations, function(i, item) {
			if(item.id==config.station_point){
				config.curentStation = item;
				card_name = item.dustboy_name;
				card_title = item.th_title;
				if(config.DataLang == 'en'){
					card_name = item.dustboy_name_en
					card_title = item.th_title_en;
				}
			}
		});
	}
	if(pathname=="pmhours"){
		$.each(config.pmLocations, function(i, item) {
			if(item.id==id){
				config.curentStation = item;
				 card_name = item.dustboy_name;
				 card_title = item.th_title;
				if(config.DataLang == 'en'){
					card_name = item.dustboy_name_en
					card_title = item.th_title_en;
				}
			}
		});
	}
	


	$('.card-marker').remove();
				if(config.DataFormat=='th'){
					var html = '<div class="card card-marker" style="display: block; padding: 0px;">';
					html 	+= '	<div class="card-body" style="background-color: rgb('+config.curentStation.th_color+');">';
					html 	+= '		<button type="button" class="btn btn-close" style="background-color: rgb('+config.curentStation.th_color+');"><img alt="image" src="/template/image/icon-close.svg" width="14" height="14" /></button>';
					html 	+= '		<h5 class="card-title">'+card_name+'</h5>';
					html 	+= '		<div class="card-description"> <div class="card-cover"> <img alt="image" src="/template/image/'+config.curentStation.th_dustboy_icon+'" width="59" height="85"/> </div><div class="card-quality"> <div class="card-value">'+config.curentStation.pm25+'</div><div class="card-info"> PM2.5 (μg/m<sup>3</sup>) </div></div></div>';
					html 	+= '		<div class="card-description"> <div class="card-detail card-detail-custom"> <h4>'+card_title+'</h4> </div></div>';
					html 	+= '	</div>';
					html 	+= '	<div class="card-footer" style="background-color: rgb('+config.curentStation.th_color+');"> <div class="card-items card-items-footer"> <div class="card-date"><span class="data-date">'+convertDateFormatDay(config.curentStation.log_datetime, pathname)+'</span><span class="data-time">'+convertDateFormatHour(config.curentStation.log_datetime, pathname)+'</span><span class="data-pm10">| PM10 '+config.curentStation.pm10+' (μg/m<sup>3</sup>)</span></div></div><a target="_blank" href="/station/'+config.curentStation.id+'" class="btn-favorite"><img alt="image" src="/template/image/icon-info-w.svg" width="18" height="17"/></a> </div>';
					html 	+= '</div>';
				}else{
					var html = '<div class="card card-marker" style="display: block; padding: 0px;">';
					html 	+= '	<div class="card-body" style="background-color: rgb('+config.curentStation.us_color+');">';
					html 	+= '		<button type="button" class="btn btn-close" style="background-color: rgb('+config.curentStation.us_color+');"><img alt="image" src="/template/image/icon-close.svg" width="14" height="14" /></button>';
					html 	+= '		<h5 class="card-title">'+card_name+'</h5>';
					html 	+= '		<div class="card-description"> <div class="card-cover"> <img alt="image" src="/template/image/'+config.curentStation.us_dustboy_icon+'" width="59" height="85"/> </div><div class="card-quality"> <div class="card-value">'+config.curentStation.pm25+'</div><div class="card-info"> PM2.5 (μg/m<sup>3</sup>) </div></div></div>';
					html 	+= '		<div class="card-description"> <div class="card-detail card-detail-custom"> <h4>'+card_title+'</h4> </div></div>';
					html 	+= '	</div>';
					html 	+= '	<div class="card-footer" style="background-color: rgb('+config.curentStation.us_color+');"> <div class="card-items card-items-footer"> <div class="card-date"><span class="data-date">'+convertDateFormatDay(config.curentStation.log_datetime, pathname)+'</span><span class="data-time">'+convertDateFormatHour(config.curentStation.log_datetime, pathname)+'</span><span class="data-pm10">| PM10 '+config.curentStation.pm10+' (μg/m<sup>3</sup>)</span></div></div><a target="_blank" href="/station/'+config.curentStation.id+'" class="btn-favorite"><img alt="image" src="/template/image/icon-info-w.svg" width="18" height="17"/></a> </div>';
					html 	+= '</div>';
				}
				$( "#row_"+id ).before( html );
}

function fn_setFormat(){
	var aqi_obj = config.DataFormat=='th' ? config.setStandardAqi[0].th_aqi : config.setStandardAqi[0].us_aqi;
	
	var aqi_icon='';
	var aqi_pm='';
	for (var i = 0; i < aqi_obj['pm25'].length; ++i) {
		aqi_icon +='<td class="table-col" style="background-color: rgb('+aqi_obj['aqi'][i].color+');"><img width="20" src="/template/image/'+aqi_obj['aqi'][i].dustboy_icon+'"></td>'
			
		if(i==(aqi_obj['pm25'].length-1)){
			aqi_pm +='<td class="table-col" style="background-color: rgb('+aqi_obj['pm25'][i].color+');">>'+aqi_obj['pm25'][i-1].max+'</td>'
		}else{
			aqi_pm +='<td class="table-col" style="background-color: rgb('+aqi_obj['pm25'][i].color+');">'+aqi_obj['pm25'][i].min+'-'+aqi_obj['pm25'][i].max+'</td>'
		}
	}
	var us_data = '<table class="table">';
		us_data 	+='<tbody>';
		us_data 	+='<tr><td class="table-head">PM<sub>2.5</sub>(μg/m<sup>3</sup>)</td>';
		us_data 	+=aqi_pm;
		us_data 	+='</tr>';
		us_data 	+='<tr><td class="table-head"></td>';
		us_data 	+=aqi_icon;
		us_data 	+='</tr>';
		us_data 	+='</tbody>';
		us_data 	+='</table>';
		
	$('.standard_sqi_legend_footer').html(us_data);
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

	
//Hander
$( window ).on( "load", function() {
	$.getJSON("/template/plugins/standard_aqi.json", function(aqi) {
		config.setStandardAqi =	aqi;
		fn_setFormat();
	});

});
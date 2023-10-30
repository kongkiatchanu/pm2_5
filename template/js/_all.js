var config = {
	DataFormat : 'th',
	DataLang: 'th',
	DataHotspotType: 'MODIS',
	location : {
		lat : null,
		lon : null,
		dis : 'All'
	},
	pmLocations : {},
}


var optionText_th = {
	title : 'ค่า PM2.5 รายชั่วโมง จากสถานีเครื่องวัดที่อยู่ในระยะ',
	station : 'สถานีเครื่องวัด',
	dis : 'ระยะห่าง (km)',
	pm : 'PM2.5 (μg/m<sup>3</sup>)'
}
var optionText_en = {
	title : 'Value of PM2.5 hourly from station in range',
	station : 'Stations',
	dis : 'Distance (km)',
	pm : 'PM2.5 (μg/m<sup>3</sup>)'
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

		
$( document ).ready(function() {
	//loadData
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
			}
		}
    });

    $('.choose-lang').on('click',function(){
        var lang = $(this).attr('data-lang');
        if(lang == 'th'){
			config.DataFormat = 'th';
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
			config.DataFormat = 'en';
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
	
	if(pathname=="hotspot"){
		
	}
	
});

function getTblResult(){
	if(config.pmLocations){
		var data_header ;
		if(config.DataLang == 'th'){
			data_header=optionText_th
		}else{
			data_header=optionText_en
		}
		
		var ck_loop =0;


		var table_header ='<div class="container"><div class="row"><div class="col-12"><table class="table table-hover"><thead><tr><th >'+data_header.station+'</th><th class="text-center" width="20%">'+data_header.dis+'</th><th class="text-center" width="15%"><span>'+data_header.pm+'</span></th></tr></thead><tbody>';
		var table_body ='';
		var table_footer ='</tbody></table></div></div></div>';
		$.each(config.pmLocations, function(i, item) {
			if(config.location.dis == "All"){
				table_body+='<tr>';
				if(config.DataLang=='th'){
					table_body+='<td>'+item.dustboy_name+'</td>';
				}else{
					table_body+='<td>'+item.dustboy_name_en+'</td>';
				}
				
				table_body+='<td class="text-center">'+parseFloat(item.distance).toFixed(2)+'</td>';
				if(config.DataFormat=='th'){
					table_body+='<td class="text-center"><div class="pm_bg" style="background-color: rgb('+item.th_color+');">'+item.pm25+'</div></td>';
				}else{
					table_body+='<td class="text-center"><div class="pm_bg" style="background-color: rgb('+item.us_color+');">'+item.pm25+'</div></td>';
				}
				table_body+='</tr>';
				ck_loop++;
			}else{
				var dt = config.location.dis.split(" ");
				if(parseFloat(item.distance) < parseFloat(dt[0])){
					table_body+='<tr>';
					if(config.DataLang=='th'){
						table_body+='<td>'+item.dustboy_name+'</td>';
					}else{
						table_body+='<td>'+item.dustboy_name_en+'</td>';
					}
					
					table_body+='<td class="text-center">'+parseFloat(item.distance).toFixed(2)+'</td>';
					if(config.DataFormat=='th'){
						table_body+='<td class="text-center"><div class="pm_bg" style="background-color: rgb('+item.th_color+');">'+item.pm25+'</div></td>';
					}else{
						table_body+='<td class="text-center"><div class="pm_bg" style="background-color: rgb('+item.us_color+');">'+item.pm25+'</div></td>';
					}
					table_body+='</tr>';
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

	
//Hander
$( window ).on( "load", function() {
	$.getJSON("/template/plugins/standard_aqi.json", function(aqi) {
		config.setStandardAqi =	aqi;
		fn_setFormat();
	});

});
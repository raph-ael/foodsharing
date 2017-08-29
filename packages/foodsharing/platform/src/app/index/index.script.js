var fsIcon = null;
var bkIcon = null;
var botIcon = null;
var bIcon = null;
var fIcon = null;

var indexmap = {
	loaded:false,
	initload:false,
	$mapview:null,
	map: null,
	markers:null,
	
	init: function()
	{
		if(!this.initload && !this.loaded)
		{
			this.$mapview = $('#indexmap_mapview');
			
			this.$mapview.css({
				'height' : $(window).height() +'px'
			});
			
			this.initload = true;
			$("<link>").attr("rel","stylesheet").attr("type","text/css").attr("href","/js/leaflet/leaflet.css").appendTo("head");
			$("<link>").attr("rel","stylesheet").attr("type","text/css").attr("href",'/js/leaflet/leaflet.awesome-markers.css').appendTo("head");
			$("<link>").attr("rel","stylesheet").attr("type","text/css").attr("href",'/js/markercluster/dist/MarkerCluster.css').appendTo("head");
			$("<link>").attr("rel","stylesheet").attr("type","text/css").attr("href",'/js/markercluster/dist/MarkerCluster.Default.css').appendTo("head");
			
			$.getScript("/js/leaflet/leaflet.js",function(){

				indexmap.initMarker();
				
				indexmap.loaded = true;
				
				indexmap.drawMap();
				
				/*
				$(window).resize(function(){
					indexmap.mapsize();
				});*/
				
			});	
		}
	},
	
	initMarker: function()
	{
		fsIcon = L.AwesomeMarkers.icon({
		    icon: 'smile',
		    markerColor: 'orange',
		    prefix: 'img'
		});
		bkIcon = L.AwesomeMarkers.icon({
		    icon: 'basket',
		    markerColor: 'green',
		    prefix: 'img'
		});

		botIcon = L.AwesomeMarkers.icon({
		    icon: 'smile',
		    markerColor: 'red',
		    prefix: 'img'
		});

		bIcon = L.AwesomeMarkers.icon({
		    icon: 'store',
		    markerColor: 'brown',
		    prefix: 'img'
		});

		fIcon = L.AwesomeMarkers.icon({
		    icon: 'recycle',
		    markerColor: 'yellow',
		    prefix: 'img'
		});
	},
	
	mapsize: function()
	{
		this.$mapview.css({
			'height' : $(window).height() +'px'
		});
		this.map.invalidateSize();
	},
	
	drawMap: function()
	{
		indexmap.map = L.map('indexmap_mapview',{
			scrollWheelZoom:false
		}).setView([50.89, 10.13], 6);
		
		L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Street_Map/MapServer/tile/{z}/{y}/{x}', {
			attribution: 'OpenStreetMap'
		}).addTo(indexmap.map);
		/*
		user.getLocation(function(latLng){
			indexmap.map.setView(latLng, 16);
		});
		*/
		loadMarker(['baskets','fairteiler']);
	}
};


function loadMarker(types,loader)
{
	var options = [];
	
	if(loader == undefined)
	{
		loader = true;
	}
	
	if(loader)
	{
		showLoader();
	}
	
	$.ajax({
		url: 'xhr/?f=loadMarker',
		data:{types:types,options:options},
		dataType:'json',
		success:function(data){
			if(data.status==1)
			{
				if(indexmap.markers != null)
				{
					indexmap.map.removeLayer(indexmap.markers);
				}			
				
				indexmap.markers = null;
				
				indexmap.markers = L.markerClusterGroup({maxClusterRadius: 50});
				url = '';
				indexmap.markers.on('click', function(el){	
					
					fsid = (el.layer.options.id);
					var type = el.layer.options.type;
					
					if(type == 'fs')
					{
						url = 'xhr/?f=fsBubble&id=' + fsid;
						showLoader();
					}
					else if(type == 'bk')
					{
						ajreq('bubble',{app:'basket',id:fsid});
					}
					else if(type == 'b')
					{
						url = 'xhr/?f=bBubble&id=' + fsid;
						u_loadDialog();
					}
					else if(type == 'f')
					{
						goTo('/?page=fairteiler&sub=ft&id='+fsid);
					}
					if(url != '')
					{
						$.ajax({
							url:url,
							dataType:'json',
							success:function(data){
								if(data.status == 1)
								{
									if(type == 'fs')
									{
										var popup = new L.Popup({offset:new L.Point(1,-35)});
										popup.setLatLng(el.latlng);
										popup.setContent(data.html);
										indexmap.map.openPopup(popup);
									}
									else if(type == 'b')
									{
										u_setDialogData(data);
										sleepmode.init();
									}
								}
							},
							complete:function(){
								if(loader)
								{
									hideLoader();
								}
							}
						});
					}
				});

				check = false;
				
				if(data.baskets != undefined)
				{
					$('#map-control li a.baskets').addClass('active');
					check = true;
					for (var i = 0; i < data.baskets.length; i++) {
						var a = data.baskets[i];
						var title = a.id;
						var marker = L.marker(new L.LatLng(a.lat, a.lon), { id: a.id, icon: bkIcon,type:'bk' });
						indexmap.markers.addLayer(marker);
					}
				}
				
				if(data.foodsaver != undefined)
				{
					$('#map-control li a.foodsaver').addClass('active');
					check = true;
					for (var i = 0; i < data.foodsaver.length; i++) {
						var a = data.foodsaver[i];
						var title = a.id;
						var marker = L.marker(new L.LatLng(a.lat, a.lon), { id: a.id, icon: fsIcon,type:'fs' });
						indexmap.markers.addLayer(marker);
					}
				}
				
				if(data.betriebe != undefined)
				{
					$('#map-control li a.betriebe').addClass('active');
					check = true;
					for (var i = 0; i < data.betriebe.length; i++) {
						var a = data.betriebe[i];
						var title = a.id;
						var marker = L.marker(new L.LatLng(a.lat, a.lon), { id: a.id, icon: bIcon, type:'b' });

						indexmap.markers.addLayer(marker);
					}
				}
				
				if(data.fairteiler != undefined)
				{
					$('#map-control li a.fairteiler').addClass('active');
					check = true;
					for (var i = 0; i < data.fairteiler.length; i++) {
						var a = data.fairteiler[i];
						var title = a.id;
						var marker = L.marker(new L.LatLng(a.lat, a.lon), { id: a.id, bid: a.bid, icon: fIcon, type:'f' });

						indexmap.markers.addLayer(marker);
					}
				}
				
				if(data.botschafter != undefined)
				{
					$('#map-control li a.botschafter').addClass('active');
					check = true;
					for (var i = 0; i < data.botschafter.length; i++) {
						var a = data.botschafter[i];
						var title = a.id;
						var marker = L.marker(new L.LatLng(a.lat, a.lon), { id: a.id, icon: botIcon,type:'fs' });
						indexmap.markers.addLayer(marker);
					}
				}
				indexmap.map.addLayer(indexmap.markers);
				
			}
			else if(indexmap.markers != null)
			{
				indexmap.map.removeLayer(indexmap.markers);
			}
		},
		complete:function(){
			hideLoader();
		}
	});
}

var u_map = null;
var markers = null;

var fsIcon = L.AwesomeMarkers.icon({
    icon: 'smile',
    markerColor: 'orange',
    prefix: 'img'
});
var bkIcon = L.AwesomeMarkers.icon({
    icon: 'basket',
    markerColor: 'green',
    prefix: 'img'
});
var botIcon = L.AwesomeMarkers.icon({
    icon: 'smile',
    markerColor: 'red',
    prefix: 'img'
});
var bIcon = L.AwesomeMarkers.icon({
    icon: 'store',
    markerColor: 'brown',
    prefix: 'img'
});
var fIcon = L.AwesomeMarkers.icon({
    icon: 'recycle',
    markerColor: 'yellow',
    prefix: 'img'
});
var map = {
	initiated:false,
	init: function()
	{
		storage.setPrefix('map');
		
		if(storage.get('center') != undefined && storage.get('zoom') != undefined)
		{
			u_map = L.map('map').setView(storage.get('center'),storage.get('zoom'));
			
		}
		else
		{
			u_map = L.map('map').setView([50.89,10.13],6);
		}
		
		L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Street_Map/MapServer/tile/{z}/{y}/{x}', {
			attribution: 'Tiles &copy; Esri 2014'
		}).addTo(u_map);
		
		this.initiated = true;
		
		u_map.on('dragend',function(e){
			map.updateStorage();
		});
		
		u_map.on('zoomend',function(e){
			map.updateStorage();
		});
	},
	initMarker: function(items)
	{		
		$('#map-control .linklist a').removeClass('active');
		if(items == undefined)
		{
			if($('#map-control .foodsaver').length > 0)
			{
				items = new Array('betriebe');
			}
			else
			{
				items = new Array('baskets');
			}
			
			if(GET('load') == undefined)
			{
				items = (storage.get('activeItems'));
			}
		}
		
		if(items == undefined)
		{
			if($('#map-control .foodsaver').length > 0)
			{
				items = new Array('betriebe');
			}
			else
			{
				items = new Array('baskets');
			}	
		}
		
		for(var i=0;i<items.length;i++)
		{
			$('#map-control .linklist a.' + items[i]).addClass('active');
		}
		
		loadMarker(items);
	},
	updateStorage: function(){		
		var center = u_map.getCenter();
		var zoom = u_map.getZoom();
		
		var activeItems = new Array();
		$('#map-control .linklist a.active').each(function(){
			activeItems.push($(this).attr('name'));
		});
		
		storage.set('center',[center.lat,center.lng]);
		storage.set('zoom',zoom);
		storage.set('activeItems',activeItems);
	},
	setView: function(lat,lon,zoom)
	{
		if(!this.initiated)
		{
			this.init();
		}
		u_map.setView([lat,lon], zoom, {animation: true});
	}
};

function u_init_map(lat,lon,zoom)
{
	map.init();
	
	if(lat == undefined && storage.get('center') == undefined)
	{
		getBrowserLocation(function(pos){
			map.setView(pos.lat, pos.lon, 12);
		});
	}
}

function u_loadDialog(purl)
{
	$('#b_content').addClass('loading');
	$('#b_content').dialog('option','title','lade...');
	$('#b_content').dialog('open');
	var pos = $('#top .inner').offset();
	$('#b_content').parent().css({
		'left':pos.left+'px',
		'top':'80px'
	});
	
	if(purl != undefined)
	{
		$.ajax({
			url:purl,
			dataType:'json',
			success:function(data){
				if(data.status == 1)
				{
					u_setDialogData(data);
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
}

function u_setDialogData(data)
{
	$('#b_content .inner').html(data.html);
	$('#b_content').dialog('option','title',data.betrieb.name);
	$('#b_content').removeClass('loading');
	$('#b_content .lbutton').button();
}

function init_bDialog()
{
	$('#b_content').dialog({
		autoOpen:false,
		modal :false,
		draggable:false,
		resizable:false
	});
}

function loadMarker(types,loader)
{
	$('#map-options').hide();
	var options = [];
	for(i=0;i<types.length;i++)
	{
		if(types[i] == 'betriebe')
		{
			$('#map-options input:checked').each(function(){
				options[options.length] = $(this).val();
			});
			$('#map-options').show();
		}
	}
	
	if(loader == undefined)
	{
		loader = true;
	}
	
	if(loader)
	{
		showLoader();
	}
	
	$.ajax({
		url: '/xhr/?f=loadMarker',
		data:{types:types,options:options},
		dataType:'json',
		success:function(data){
			if(data.status==1)
			{
				if(markers != null)
				{
					u_map.removeLayer(markers);
				}			
				
				markers = null;
				
				markers = L.markerClusterGroup({maxClusterRadius: 50});
				url = '';
				markers.on('click', function(el){	
					
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
						bid = (el.layer.options.bid);
						goTo('/?page=fairteiler&sub=ft&bid='+bid+'&id='+fsid);
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
										u_map.openPopup(popup);
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
						markers.addLayer(marker);
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
						markers.addLayer(marker);
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

						markers.addLayer(marker);
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

						markers.addLayer(marker);
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
						markers.addLayer(marker);
					}
				}
				u_map.addLayer(markers);
				
			}
			else if(markers != null)
			{
				u_map.removeLayer(markers);
			}
		},
		complete:function(){
			hideLoader();
		}
	});
}

$(document).ready(function(){
	showLoader();
	$('#map-control li a').click(function(){
		$(this).toggleClass('active');
		
		types = [];
		i = 0;
		$('#map-control li a.active').each(function(el){
			types[i] = $(this).attr('name');
			i++;
		});
		loadMarker(types);
		map.updateStorage();
		return false;
	});
	
	$('#map-options input').change(function(){
		
		if($(this).val() == 'allebetriebe')
		{
			$('#map-options input').prop('checked', false);
			$('#map-options input[value=\'allebetriebe\']').prop('checked', true);
		}
		else
		{
			$('#map-options input[value=\'allebetriebe\']').prop('checked', false);
		}
		if($('#map-options input:checked').length == 0)
		{
			$('#map-options input[value=\'allebetriebe\']').prop('checked', true);
		}
		
		types = [];
		i = 0;
		$('#map-control li a.active').each(function(el){
			types[i] = $(this).attr('name');
			i++;
		});
		setTimeout(function(){
			loadMarker(types);
		},100);
	});
	
	init_bDialog();
});

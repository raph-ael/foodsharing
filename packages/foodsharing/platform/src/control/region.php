<?php
if(!S::may('orga'))
{
	go('/');
}
if(isOrgaTeam() && isset($_GET['delete']) && (int)$_GET['delete'] > 0)
{
	$db->deleteBezirk($_GET['delete']);
	goPage('region');
}

$id = id('tree');
addBread(s('bezirk_bread'),'/?page=region');
addTitle(s('bezirk_bread'));
$cnt = '
<div>
    <div style="float:left;width:150px;" id="'.'..'.'"></div>
    <div style="float:right;width:250px;"></div>
    <div style="clear:both;"></div>		
</div>';

addStyle('#bezirk-buttons {left: 50%; margin-left: 5px;position: absolute;top: 77px;}');

addJs('
$("#deletebezirk").button().click(function(){
    if(confirm($("#tree-hidden-name").val()+\' wirklich löschen?\'))
    {
        goTo(\'/?page=region&delete=\'+$("#tree-hidden").val());
    }
});');

$bezirke = $db->getBasics_bezirk();

array_unshift($bezirke,array('id'=>'0','name'=>'Ohne `Eltern` Bezirk'));

hiddenDialog('newbezirk', array(
    v_form_text('Name'),
    v_form_text('email'),
    v_form_select('parent_id',array('values'=>$bezirke))
),'Neuer Bezirk');

addContent(v_field('<div><div id="'.id('bezirk_form').'"></div></div>','Bezirk bearbeiten',array('class' => 'ui-padding')),CNT_LEFT);
addContent(v_field(v_bezirk_tree($id).'
        <div id="bezirk-buttons">
            <span id="deletebezirk" style="visibility:hidden;">Bezirk Löschen</span>	
            '.v_dialog_button('newbezirk', 'Neuer Bezirk').'	
        </div>', 'Bezirke'),CNT_RIGHT);

i_map($id);

function v_bezirk_tree($id)
{
	addScript('/js/dynatree/jquery.dynatree.js');
	addScript('/js/jquery.cookie.js');
	addCss('/js/dynatree/skin/ui.dynatree.css');

	addJs('
	$("#'.$id.'").dynatree({
		onDblClick: function(node, event) {
			alert(node.data.ident);
		},
	    initAjax: {
			url: "xhr/?f=bezirkTree",
			data: {p: "0" }
		},
		onActivate: function(node){
			$("#deletebezirk").css("visibility","visible");
			showLoader();
			$("#'.$id.'-hidden").val(node.data.ident);
			$("#'.$id.'-hidden-name").val(node.data.title);
			$.ajax({
				url: "xhr/?f=getBezirk",
				data: { "id": node.data.ident },
				dataType: "json",
				success: function(data) {
					$("#bezirk_form").html(data.html);
					if(data.script != undefined)
					{
						$.globalEval(data.script);
					}
					'.$id.'_clearMarkers();
					image = L.icon({iconUrl: "img/foodsaver.png",
						        iconSize: [32.0, 37.0],
						        iconAnchor: [16.0, 18.0],
										shadowIconUrl: "img/shadow-foodsaver.png",
						        shadowIconSize: [51.0, 37.0],
						        shadowIconAnchor: [16.0, 18.0]
					});
						
					if(data.foodsaver != undefined && data.foodsaver.length > 0)
					{
						
						
						for(i=0;i<data.foodsaver.length;i++)
						{
							loc = L.latLng(data.foodsaver[i].lat,data.foodsaver[i].lon);
    						'.$id.'_bounds.extend(loc);
							
							'.$id.'_markers[i] = L.marker(loc, {
						      title:data.foodsaver[i].name,
						      icon: image,
						  }).addTo('.$id.'_map);
						  '.$id.'_markers[i].content = \'<div style="height:80px;overflow:hidden;"><div style="margin-right:10px;float:left;"><a onclick="profile(\'+ data.foodsaver[i].id +\');return false;" href="#"><img src="\'+img(data.foodsaver[i].photo)+\'" /></a></div><h1 style="font-size:13px;font-weight:bold;margin-bottom:8px;"><a onclick="profile(\'+ data.foodsaver[i].id +\');return false;" href="#">\' + data.foodsaver[i].name + "</a></h1><p>" + data.foodsaver[i].anschrift + "</p><p>" + data.foodsaver[i].plz + " " + data.foodsaver[i].stadt + \'</p><div style="clear:both;"></div></div>\';
						      		
						  '.$id.'_markers[i].on( \'click\', function(e,ii) {
						    '.$id.'_infowindow.setContent(""+this.content);
						    '.$id.'_infowindow.setLatLng(this.getLatLng());
						    '.$id.'_infowindow.openOn('.$id.'_map);
						  });
						  '.$id.'_map.fitBounds('.$id.'_bounds);
						}
    				}
    				if(data.betriebe != undefined && data.betriebe.length > 0)
    				{		
    					for(i=0;i<data.betriebe.length;i++)
						{
    					  	if(data.foodsaver != undefined)
    					  	{
    					  		y = (i+data.foodsaver.length);
    					  	}
    					  	else
    					  	{
    					  		y = i;	
    					  	}
							loc = L.latLng(data.betriebe[i].lat,data.betriebe[i].lon);
    						'.$id.'_bounds.extend(loc);
							
							'.$id.'_markers[y] = L.marker(loc, {
						      title:data.betriebe[i].name,
						      icon:   L.icon( {
							  			iconUrl: "img/supermarkt.png",
						        	iconSize: [32.0, 37.0],
						        	iconAnchor: [16.0, 18.0],
										shadowIconUrl: "img/shadow-foodsaver.png",
						        shadowIconSize: [51.0, 37.0],
						        shadowIconAnchor: [16.0, 18.0]
							  } )
						  }).addTo('.$id.'_map);
						  '.$id.'_markers[y].content = data.betriebe[i].bubble;
						      		
						  '.$id.'_markers[y].on( \'click\', function(e,ii) {
						    '.$id.'_infowindow.setContent(""+this.content);
						    '.$id.'_infowindow.setLatLng(this.getLatLng());
						    '.$id.'_infowindow.openOn('.$id.'_map);
						  });
						  '.$id.'_map.fitBounds('.$id.'_bounds);
						}
					}
			
				},
				complete: function(){
					hideLoader();
				}
			});
		},
		onLazyRead: function(node){
			 node.appendAjax({url: "xhr/?f=bezirkTree",
				data: { "p": node.data.ident },
				dataType: "json",
				success: function(node) {
			
				},
				error: function(node, XMLHttpRequest, textStatus, errorThrown) {
			
				},
				cache: false
			});
		
		}
	});
	');

	return '<div><div id="'.$id.'"></div><input type="hidden" name="'.$id.'-hidden" id="'.$id.'-hidden" value="0" /><input type="hidden" name="'.$id.'-hidden-name" id="'.$id.'-hidden-name" value="0" /></div>';
}

function i_map($id)
{
	addJsFunc('
	var '.$id.'_markers = [];
	var '.$id.'_bounds = L.latLngBounds([]);
	var '.$id.'_infowindow = L.popup();
	'.$id.'_infowindow.setContent( \'Information!\' );
	function '.$id.'_clearMarkers()
	{
		'.$id.'_bounds = L.latLngBounds([]);
		'.$id.'_markers = [];
	}');
	
	addStyle('div.map{width:512px;}');
	addContent(v_field('<div class="map" id="'.$id.'_map"></div>','Karte'));
	
	$zoom = 6;
	$lat = '51.303145';
	$lon = '10.235595';
	
	addJs('
	 	var '.$id.'_center = L.latLng('.$lat.','.$lon.');
		var '.$id.'_options = {
		  \'zoom\': '.$zoom.',
		  \'center\': '.$id.'_center,
		};
		
		var '.$id.'_map = L.map(document.getElementById("'.$id.'_map"), '.$id.'_options);
    L.tileLayer("https://server.arcgisonline.com/ArcGIS/rest/services/World_Street_Map/MapServer/tile/{z}/{y}/{x}", {
      attribution: "Tiles &copy; Esri 2014"
    }).addTo('.$id.'_map);
	');
	
	
}
?>

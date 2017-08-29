var index = 0;
var ids = [];
function u_getGeo(id,conti)
{
	if($("#fs"+id+"plz").val() != "" && $("#fs"+id+"stadt").val() != "" && $("#fs"+id+"anschrift").val() != "")
	{
		u_loadCoords({
			plz: $("#fs"+id+"plz").val(),
			stadt: $("#fs"+id+"stadt").val(),
			anschrift: $("#fs"+id+"anschrift").val(),
			complete: function()
			{
				hideLoader();
			}
		},function(lat,lon){
			ajreq('updateGeo',{lat:lat,lon:lon,id:id});
		});
	}
}

function u_goAll()
{
	$('.hiddenid').each(function(){
		ids[ids.length] = this.value;
	});
	u_goNext();
}

function u_goNext()
{
	if(ids.length > index)
	{
		u_getGeo(ids[index]);
		setTimeout(function(){
			u_goNext();
		},800);
		index++;
	}
}
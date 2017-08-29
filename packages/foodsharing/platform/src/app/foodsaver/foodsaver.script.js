var fsapp = {
	init: function(){
		if($('#fslist').length > 0)
		{
			$('#fslist a').click(function(ev){
				ev.preventDefault();
				$this = $(this);
				fsida = $this.attr('href').split('#');
				fsid = parseInt(fsida[(fsida.length-1)]);
				fsapp.loadFoodsaver(fsid);
			});
		}	
	},
	loadFoodsaver: function(foodsaver_id){
		ajreq('loadFoodsaver',{
			app: 'foodsaver',
			id: foodsaver_id,
			bid: $('#appdata .bid').val()
		});
	},
	addFoodsaver: function(){
		var ids = [];
		$('#search_name input').each(function(){
			id = parseInt($(this).attr('name').replace(/[^0-9]/g,''));
			if(id > 0)
			{
				ids[ids.length] = id;
			}
		});
		ajreq('addfoodsaver',{
			app: 'foodsaver',
			ids: ids.join(','),
			bid: $('#appdata .bid').val()
		});
	},
	refreshfoodsaver: function(){
		ajreq('foodsaverrefresh',{
			app: 'foodsaver',
			bid: $('#appdata .bid').val()
		});
	},
	delfromBezirk: function(foodsaver_id){
		if(confirm('Wirklich aus Bezirk löschen?'))
		{
			ajreq('delfrombezirk',{
				app:'foodsaver',
				bid: $('#appdata .bid').val(),
				id: foodsaver_id
			});
		}
	}
};
$(function(){
	fsapp.init();
})
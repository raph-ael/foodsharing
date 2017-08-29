var timeformat = {
	nice: function(dbtime)
	{
		// has time?
		if(dbtime.indexOf(':') > 0)
		{
			return timeformat.niceDateTime(dbtime);
		}
		else
		{
			return timeformat.niceDate(dbtime);
		}
	},
	niceDateTime: function(dbtime){
		parts = dbtime.split(' ');
		time = parts[1];
		date = parts[0];
		
		parts = date.split('-');
		out = parts[2]+'.'+parts[1]+'.'+parts[0]+' ';
		
		parts = time.split(':');
		return out + parts[0]+'.'+parts[1]+' Uhr';
		
	},
	niceDate: function(dbtime){
		parts = dbtime.split('-');
		
		return parts[2]+'.'+parts[1]+'.'+parts[0];
	}
};
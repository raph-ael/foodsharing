var storage = {
		
	prefix: '',
		
	setPrefix: function(prefix)
	{
		this.prefix = prefix+':';
	},
	set: function(key,val)
	{
		val = JSON.stringify({v:val});
		window.localStorage.setItem(storage.prefix+key, val);
	},
	get: function(key)
	{
		val = window.localStorage.getItem(storage.prefix+key);
		if(val != undefined)
		{
			val = JSON.parse(val);
			return val.v;
		}
		return val;
	},
	del: function(key)
	{
		window.localStorage.removeItem(storage.prefix+key);
	},
	reset: function()
	{
		this.del('badge');
		this.del('msg-chats');
	}
};
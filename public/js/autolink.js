String.prototype.autoLink = function() {
	var pattern = /(^|\s)((?:https?|ftp):\/\/([\-A-Z0-9+\u0026@#\/%?=()~_|!:,.;]*[\-A-Z0-9+\u0026@#\/%=~()_|]))/gi;
	var currentHost = document.location.host;

	return this.replace(pattern, function(match, space, url, urlWithoutProto) {
		return space + '<a' +
			' href="' + url + '"' +
			(urlWithoutProto.split('/', 2)[0] !== currentHost ? ' target="_blank"' : '') +
		'>' + urlWithoutProto + '</a>';
	});
};

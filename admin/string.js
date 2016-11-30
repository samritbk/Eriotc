text2url=function(str){
            
    //URLs starting with http://, https://, or ftp://
    var replacedText = str.replace(/(\b(https?|ftp):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/gim, '<a href="$1" target="_blank">$1</a>');

    //URLs starting with www. (without // before it, or it'd re-link the ones done above)
    var replacedText = replacedText.replace(/(^|[^\/])(www\.[\S]+(\b|$))/gim, '$1<a href="http://$2" target="_blank">$2</a>');
    
    return replacedText;
}
timestamp=function(){
	var ts = Math.round(new Date().getTime() / 1000);
	return ts;
}
addslashes=function(string) {
	return string.replace(/\\/g, '\\\\').
				replace(/\u0008/g, '\\b').
				replace(/\t/g, '\\t').
				replace(/\n/g, '\\n').
				replace(/\f/g, '\\f').
				replace(/\r/g, '\\r').
				replace(/'/g, '\\\'').
				replace(/"/g, '\\"');
}
mysql_real_escape_string=function(str) {
	return str.replace(/[\0\x08\x09\x1a\n\r"'\\\%]/g, function (char) {
	switch (char) {
		case "\0":
		return "\\0";
		case "\x08":
		return "\\b";
		case "\x09":
		return "\\t";
		case "\x1a":
		return "\\z";
		case "\n":
		return "\\n";
		case "\r":
		return "\\r";
		case "\"":
		case "'":
		case "\\":
		case "%":
		return "\\"+char; // prepends a backslash to backslash, percent,
		// and double/single quotes
	}
	});
}
htmlEntities=function(str) {
    return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
}
text2url=function(str){
            
    //URLs starting with http://, https://, or ftp://
    var replacedText = str.replace(/(\b(https?|ftp):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/gim, '<a href="$1" target="_blank">$1</a>');

    //URLs starting with www. (without // before it, or it'd re-link the ones done above)
    var replacedText = replacedText.replace(/(^|[^\/])(www\.[\S]+(\b|$))/gim, '$1<a href="http://$2" target="_blank">$2</a>');
    
    return replacedText;
}

checkEmail=function(email){
    var re = /\S+@\S+\.\S+/;
    return re.test(email);
}
trim = function(str) {
  return str.replace(/^\s+|\s+$/g,'');
}
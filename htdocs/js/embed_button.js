(function(){
	var u = yigg_url ? yigg_url : document.URL;
        if (yigg_url.substring(0, 1) == "/" || yigg_url.substring(0,3) == "%2F") {
            u = window.location.protocol + "//" + window.location.host + yigg_url;
        }
	document.write("<iframe src='http://yigg.de/nachrichten/button?url=" + escape(u) + "' height='65' width='65' frameborder='0' scrolling='no'></iframe>");
})()
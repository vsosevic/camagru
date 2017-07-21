(function (global) {
	//Set up a namespace for our utility
	var ajaxUtils = {};

	//Returns an HTTP request object
	function getRequestObject() {
		if (window.getRequestObject) {
			return (new XMLHTTPRequest());
		}
		else {
			global.alert("Ajax is not supported!");
			return(null);
		}
	}
	

})(window);
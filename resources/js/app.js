require('./bootstrap');

window.integerCheck = function(obj) {
	var value = obj.value;
	var regex = /[^0-9]/gi;
	obj.value = value.replace(regex, "");
};

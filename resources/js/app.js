require('./bootstrap');

window.integerCheck = function(obj) {
	var value = obj.value;
	var regex = /[^0-9]/gi;
	obj.value = value.replace(regex, "");
};

window.showNoty = function(text, type, layout, timeout) {
	return new Noty({
		type: type,
		layout: layout,
		text: text,
		timeout: timeout,
	}).show();
}
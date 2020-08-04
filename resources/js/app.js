require('./bootstrap');

window.integerCheck = function(obj) {
	var value = obj.value;
	var regex = /[^0-9]/gi;
	obj.value = value.replace(regex, "");
};

toastr.options.closeMethod = 'fadeOut';
toastr.options.closeDuration = 300;
toastr.options.closeEasing = 'swing';
toastr.options.positionClass = 'toast-bottom-right';
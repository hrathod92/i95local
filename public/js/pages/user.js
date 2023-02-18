$( function() {
/**
 * Country / State dropdown
 **/
var state_label = $('label[for="state"]');
var state_select = $('#state');

state_label.hide();
state_select.hide();

$('#country').on('change', function() {
	if( $(this).prop("selectedIndex") == 0 ) {
		state_label.show();
		state_select.show();
	}
	else {
		state_label.hide();
		state_select.hide();
	}
}).trigger('change');

});
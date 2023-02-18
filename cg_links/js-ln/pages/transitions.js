$( function() {

/**
 *  For templates.show page
 */

$('#title').addClass($('#title_transition_name').html() + ' animated')
$('#body').addClass($('#body_transition_name').html() + ' animated')
$('#list ul li').each(function(i){
    $(this).hide();
});
$('#list ul li').each(function(i){
    var t = $(this);
    setTimeout(function(){ 
    	t.show();
    	t.addClass($('#list_transition_name').html() + ' animated'); 
    }, (i+1) * 500);
});

});
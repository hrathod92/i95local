$( function() {

// loop through table and assign input values
function update_order(){
	$("#slide_table tr").each( function(i, row){
		order_input = $(this).find("input");
		if(order_input) {
			order_input.val(i)
		}
	});
};
update_order();

// listener for arrow clicks in table
$("#slide_table .up,.down").on('click', function(){
    var row = $(this).parents("tr:first");
    if ($(this).is(".up")) {
        row.insertBefore(row.prev("tr:has(td)"));
    } else {
        row.insertAfter(row.next());
    }

    update_order();
});


var slide_headers = $('div.slide-body :header');
var slide_body = $('div.slide-body p');
var slide_image = $('div.slide-image img');
var slide_lists = $('div.slide-body ul li');
var audio_player = $('#audio_player')[0];

var iframe = document.getElementById('slide-video');
var player = $f(iframe);

var items = [slide_headers, slide_body, slide_image, slide_lists];


$('#slide-controls div.slide-btn.pause-button a').on('click', function(e) {
    
    if( $(this).hasClass('paused') ) {
        // continue?
    }
    else {
        if( audio_player ) audio_player.pause();
        if( player ) player.api("pause");

        items.forEach( function(item) {
            item.css( "-webkit-animation-play-state", "paused");
            item.css( "-moz-animation-play-state", "paused");
            item.css( "-o-animation-play-state", "paused");
            item.css( "animation-play-state", "paused");
        })

        $(this).addClass('paused');
        $(this).attr('href', window.location);
        $(this).html('<i class="fa fa-refresh"></i> Restart');

        return false;
    }
    
});

/**
 * Video Controls
 */
 
// $f == Froogaloop
/*var iframe = document.getElementById('slide-video');
var player = $f(iframe);
var playButton = document.getElementById("slide-video-play");
playButton.addEventListener("click", function() {
  player.api("play");
});
var pauseButton = document.getElementById("slide-video-pause");
pauseButton.addEventListener("click", function() {
  player.api("pause");
});*/


})
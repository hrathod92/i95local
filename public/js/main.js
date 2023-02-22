$(window).load(function () {
  $('.flexslider').flexslider({
    animation: "slide"
  });
});



$(document).ready(function() {
	
	// Detect objectFit support
	if('objectFit' in document.documentElement.style === false) {
	  
	  // assign HTMLCollection with parents of images with objectFit to variable
	  var container = document.getElementsByClassName('company-details');
	  
	  // Loop through HTMLCollection
	  for(var i = 0; i < container.length; i++) {
	    
	    // Asign image source to variable
	    var imageSource = container[i].querySelector('img').src;
	    
	    // Hide image
	    container[i].querySelector('img').style.display = 'none';
	    
	    // Add background-size: cover
	    container[i].style.backgroundSize = 'contain';
	    
	    // Add background-image: and put image source here
	    container[i].style.backgroundImage = 'url(' + imageSource + ')';
	    
	    // Add background-position: center center
	    container[i].style.backgroundPosition = 'center center';
	    container[i].style.backgroundRepeat = 'no-repeat';
	  }
	}
	else {
	  // You don't have to worry
	  console.log('No worries, your browser supports objectFit')
	}


	$(".has-children").on('click', function() {
	  $(this).find('.sub').stop().slideToggle();
	});

  var categoryDialog = $( "#category-dialog" ).dialog({
      autoOpen: false,
      height: 750,
      width: 700,
      modal: true,
      buttons: {
        Cancel: function() {
          categoryDialog.dialog( "close" );
        }
      }
    });

  $('[name="show_inactive"]').on('change',function(){
    $('#form').submit();
  });

  $(".datepicker").datepicker({
    dateFormat: 'mm/dd/yy',
  });

  $( "#first_level" ).change(function() {
    $("#second_level").val('');
    $("#third_level").val('');
    $("#fourth_level").val('');
  });

  $( "#second_level" ).change(function() {
    $("#third_level").val('');
    $("#fourth_level").val('');
  });

  $( "#third_level" ).change(function() {
    $("#fourth_level").val('');
  });

  $("#anchor-down").click(function (){
      $('html, body').animate({
          scrollTop: $("#feature-casestudy").offset().top
      }, 1000);
  });


  // $('#responsive-menu-button').sidr({
  //   name: 'sidr-main',
  //   source: '#navigation',
  //   side: 'right'
  // });
  
  //$("a.sidr-class-parent").attr("href", "#");
  
 $('#sidr-id-navigation-inner li').each(function(index) {
      var item = $(this);
      if (item.find('ul, .sidr-class-mega-menu').length > 0) {
          // Has submenus
          item.find('a').first().append('<span class="sub-toggle">+</span>');
      }
  });
  
  $('#sidr-id-navigation-inner .sub-toggle').click(function(e) {
      e.preventDefault();
      var item = $(this),
          txt;
      item.toggleClass('is-open');
      txt = item.hasClass('is-open') ? '–' : '+';
      item.text(txt);
      $(this).closest('li').find('a').first().next().slideToggle();
  });
  
  
  

  var $UtilNav = $('.utility-nav li'),
        $MainNav = $('.sidr');
    function navResize(){
      var mob = window.innerWidth<1200;
      $UtilNav.appendTo((mob?".sidr":".utility-nav")+' ul.sidr-class-menu');
      $MainNav[mob?"addClass":"removeClass"]('mobile-nav');
    }
    navResize();
    $(window).resize(navResize);



  $(window).on("orientationchange",function(){
    window.location.reload();
  });


  /*=======	Accordion (Fill out a Quote)	========*/
	$(function() {
		$('.accordion').accordion({active: 0, collapsible: false, heightStyle: content});
	});

	/*==========	Tabs (Fill out a Quote) w/ Animation and Next/Previous buttons	=========*/
	$(".tabs").tabs({active: false, collapsible: true, hide: {effect: "slide", duration: 500}, show: {effect: "slide", duration: 500}});
	$('.tabs').tabs("option", "active", 0).tabs("option", "collapsible", false).fadeIn('fast');
	$(".nexttab").click(function(e) {
		e.preventDefault();
		curTab = $(".tabs").tabs('option', 'active');
		numTabs = $(".tabs li").length;
		nextTab = curTab + 1;
		if (nextTab < numTabs) {
			$(".tabs").tabs("option", "active", nextTab);
		}
	});
	$(".previoustab").click(function(e) {
		e.preventDefault();
		curTab = $(".tabs").tabs('option', 'active');
		nextTab = curTab - 1;
		if (nextTab >= 0) {
			$(".tabs").tabs("option", "active", nextTab);
		}
	});
	$("table.filter-table tr:has(td)").each(function() {
		var t = $(this).text().toLowerCase();
		$("<td class='indexColumn'></td>").hide().text(t).appendTo(this);
	});
	$("#filter-select").change(function() {
		var str = "";
		$("#filter-status option:selected").each(function() {
			str += $(this).text() + " ";
		});
		var search_term = $(this).val().toLowerCase().split(" ");
		filterTable(search_term, ".filter-table");
	});

	// calculate height of mega menu
	var minHeight = 150;
	$.each($('.mega-dropdown-menu'), function(i, v) {
		if (minHeight < $(v).innerHeight()) {
		  minHeight = $(v).innerHeight();
		}
	});
	$.each($('.mega-dropdown-menu .split-content-20'), function(i, v) {
		if (minHeight < $(v).height()) {
		  minHeight = $(v).height();
		}
	});
	$('.mega-dropdown-menu').height(minHeight);


    if ( $( ".side-bar-info" ).length && slug) {
      $.each(  $( ".side-bar-info li" ), function( key, value ) {
        if($(value).attr('id') === slug) {
          $(value).addClass('active');
        }
      });

    }


    if ($('.content p').length > 0) {
      $('.content').each(function(){ $(this).find('p:not(:first)').hide()});
      $('.content p:first').append( "<a class='more' href='#'>more...</a>" );

     $('a.more').click(function(e) {
        e.preventDefault();
        $('.content').each(function(){ $(this).find('p').show()});
        $(this).hide();
        return false;
     });

    }

    if($('#dashboard-my-account').length > 0){
        var showNo = 4, index = 0;
        $("#dashboard-my-account li").each(function(){
          if (showNo <= index) {
            $(this).hide();
          }
          index++;
        });

        $('#dashboard-my-account li:eq(3)').append('<a class="show-more" href="#" title="Show more"><i class="material-icons">&#xE313;</i></a>');

        $('.show-more').click(function (e) {
          e.preventDefault();
          $("#dashboard-my-account li").each(function(){ $(this).show()});
          $(this).hide();
        });
    }

	//BEGIN: Video thumbnail in Article content.
	$(".article-video-id").hide();

	$(".article-thumb").click(function () {
		$(".article-video-id").toggle();
		if(!$(".article-video-id").is(':visible')) {
			$("#video_id").val('');
		}
	});
  $(".thumb-label").click(function () {
		$(".article-video-id").toggle();
  });
	//END: Video thumbnail in Article content.


  //ad banner click tracking
  $('a.ad-click-tracking').click(function(){
    var pageID = $(this).attr('data-ad-id');
    if(typeof pageID !== 'undefined'){
      $.post("/clicks/ad/" + pageID);
    }
  });

  //click tracking
  $('a.click-tracking').click(function(){
    var pageID = $('body').attr('data-item-id');
    var clickType = $(this).attr('data-click-type');
    if(typeof pageID !== 'undefined' && typeof clickType !== 'undefined'){
      $.post('/clicks/'+ clickType +'/' + pageID );
    }
  });

});

/*$(function( $, window, document, undefined )
{
    'use strict';

    var $list       = $( '.home-cta-blocks' ),
        $items      = $list.find( '.block' ),
        setHeights  = function()
        {
            $items.css( 'height', 'auto' );

            var perRow = Math.floor( $list.width() / $items.width() );
            if( perRow == null || perRow < 2 ) return true;

            for( var i = 0, j = $items.length; i < j; i += perRow )
            {
                var maxHeight   = 0,
                    $row        = $items.slice( i, i + perRow );

                $row.each( function()
                {
                    var itemHeight = parseInt( $( this ).outerHeight() );
                    if ( itemHeight > maxHeight ) maxHeight = itemHeight;
                });
                $row.css( 'height', maxHeight );
            }
        };

    setHeights();
    $( window ).on( 'resize', setHeights );
    $list.find( 'img' ).on( 'load', setHeights );

})( jQuery, window, document );*/
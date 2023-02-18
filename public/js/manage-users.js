function filterTable(search, table) {
    $(table+" tr:hidden").show();
	
    $.each(search, function() {
		if ( search != 'all' ) {
			$(table+" tr:visible .indexColumn:not(:contains('" + this + "'))").parent().hide();
		} else {
			$(table).show();
		}
    });
}
 
$(document).ready( function() {
    $("table tr:has(td)").each(function() {
        var t = $(this).text().toLowerCase();
        $("<td class='indexColumn'></td>").hide().text(t).appendTo(this);
    });
 
    $("#filter-input").keyup(function() {
		var search_term = $(this).val().toLowerCase().split(" ");
		filterTable(search_term, ".default-table");
    });
	
	$( "#filter-last" ).change(function() {
		var str = "";
		$( "#filter-last option:selected" ).each( function() {
			str += $( this ).text() + " ";
		}); 
		var search_term = $(this).val().toLowerCase().split(" ");
		filterTable( search_term, ".default-table" );
	})
});

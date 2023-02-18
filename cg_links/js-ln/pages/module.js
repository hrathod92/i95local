$( function() {

	// loop through table and assign input values
    function update_order(){
    	$("#module_table tr").each( function(i, row){
			order_input = $(this).find("input");
			if(order_input) {
				order_input.val(i)
			}
    	});
    };
    update_order();

    // listener for arrow clicks in table
	$("#module_table .up,.down").on('click', function(){
        var row = $(this).parents("tr:first");
        if ($(this).is(".up")) {
            row.insertBefore(row.prev("tr:has(td)"));
        } else {
            row.insertAfter(row.next());
        }

        update_order();
    });
})
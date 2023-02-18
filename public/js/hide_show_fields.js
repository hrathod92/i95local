$( document ).ready(function() {
//alert('hi');
var grade;
$('.dream').hide();
$( "#grade" ).change(function() {
grade = $("#grade option:selected").val();
//alert(grade);
if(grade>=8){
$('.dream').show();
}
else{
$('.dream').hide();
}
});
});

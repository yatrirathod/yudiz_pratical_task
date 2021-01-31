$(document).ready(function(){
	//to check the dashboard table 

// toastr.error('Are you the 6 fingered man?');
// toastr.success('Are you the 6 fingered man?');
// toastr.info('Are you the 6 fingered man?');


	if($("#demo_dataTable").length>0){
	console.log("dsc");
	var demoTable = $("#demo_dataTable").dataTable({
	"bPaginate": true,
	"bSort":true,
	"bInfo": true,
	"bFilter": true,
	"sPaginationType":"full_numbers",
	"bLengthChange": false,
	"iDisplayLength": 10
	});
	}
	
});

//slider
$(document).ready(function(){
			
		$("#form2").hide();
		$("#btn-submit1").click(function(){
			$("#form1").hide("slide", { direction: "right" });
			setTimeout(function() {
			$("#form2").show("slide","left");
			},500);
		});
		
		$("#back").click(function(){
			$("#form2").hide("slide", { direction: "left" });
			setTimeout(function() {
			$("#form1").show("slide", { direction: "right" });
			},500);
		});

});

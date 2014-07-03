
$(function() {
  // Handler for .ready() called.
 $(".rating-line-per").each(function() {
	  var p = $(this).attr('data-id');
	  p = p * 10;
	  
	  if(p>=80)
		color = '#32CD32';
	  else if(p<80 && p>=60)
		color = '#FF7F50';
	  else if(p>60 && p>=45)
		color = '#FFA07A';
	  else if(p>45 && p>25)
		color = '#FFD700';
	  else
		color = '#FFDEAD';
	  
	  $(this).css('width',p+'%');
	  $(this).css('background-color',color);
	  
  }); 
});
  
$(document).ready(function(){
	
	/*$('#apply').click(function(){
		
		alert('testing..');
		return false;
	});

	*/
	
	
	$(".channelbox input[type=checkbox]").each(function(i){
		
    $(this).click(function () {
		var j = $(this).val()
		
		var numberOfChecked = $('.channelbox input:checkbox:checked').length;
		var numberNotChecked = $('.channelbox input:checkbox:not(":checked")').length;

		$('#txtSumQnt').val(numberOfChecked);
		$('.txtSumQnt').html(numberOfChecked);
		
		if($("#Q"+j).attr("readonly")) {
             $("#Q"+j).removeAttr('readonly');
			 $("#Q"+j).focus();
        } else {
			calculate(j);
			$("#Q"+j).val('');
			$("#T"+j).val('');
			$('#Q'+j).attr('readonly', 'readonly'); 
        }
     }); 
   });
   
   
    $(".txt").each(function() {
       $(this).keyup(function(){
		var h = $(this).attr('rel');
		var sec = $('#S'+h).val();
		var rate = $('#R'+h).val();
		
		var i = this.value;
		var n =1;
		
		if(parseFloat(this.value)>parseFloat(sec)){
			alert("Sorry! you can't enter more than "+sec+" seconds.");
			m = (i.slice(0, -1));
			$(this).val(m);
			return false;
		}
				
		if(!isNaN(this.value)) {  //this.value.length!=0
			
			while(i>10){
				i = i-10;
				n++;
			}
			
			mul = rate * n;
			$('#T'+h).val(mul.toFixed(0));
			calculateSum();
         }
		 else{
		 	alert('Please Enter Number Only.');
			$(this).val('');
			$('#T'+h).val('');
			return false;
		 } 
       }); 
      });

	
	function calculateSum() {
        var sum = 0;
		var charge = 0;
        $(".txt").each(function() {
			var h = $(this).attr('rel');
			var c = $('#T'+h).val();
            if(!isNaN(this.value) && this.value.length!=0) {
                sum += parseFloat(this.value);
				charge += parseFloat(c);
            }
        });
		$("#txtSumTot").val(sum.toFixed(0));
		$("#txtSumChr").val(charge.toFixed(0));
		
		$(".txtSumTot").html(sum.toFixed(0));
		$(".txtSumChr").html(charge.toFixed(0));
    }
	
	function calculate(nm) {
		var q = $('#Q'+nm).val();
		var s = $('#txtSumTot').val();
		
		var t = $('#T'+nm).val();
		var c = $('#txtSumChr').val();
		
		if(!isNaN(q) && !isNaN(t) && q!='' && t!=''){
		
			var sec = parseFloat(s) - parseFloat(q);
			var total = parseFloat(c) - parseFloat(t);
			$("#txtSumTot").val(sec);
			$("#txtSumChr").val(total);
			
			$(".txtSumTot").html(sec);
			$(".txtSumChr").html(total);
		}
    }
})

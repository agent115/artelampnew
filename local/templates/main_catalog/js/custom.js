$(document).ready(function () {
    $('.shopHeader__btn').on('click',function(){
        $.ajax({
        	url: '/ajax/feedback_popup.php',
        	type:"POST",
        	success: function(res){
                $(".shopHeader").before(res);
        	}
        });
    });
});
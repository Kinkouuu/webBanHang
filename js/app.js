$(document).ready(function(){
    $('.eye').click(function(){
        $(this).toggleClass('open');
        $(this).children('i').toggleClass('fa-eye-slash fa-eye');
        if($(this).hasClass('open')){
            $(this).prev().attr('type','text');
        }else{
            $(this).prev().attr('type','password'); 
        }
        });
    });

$(document).ready(function() {
    $("#phone").change(function(){
        let phoneNumber = /^[0-9]{10}$/;
        if(phoneNumber.test($(this).val())==false){
            $("#phoneHelp").text("Phone number not valid.");}
            $("#phoneHelp").css("color","red")
})
});

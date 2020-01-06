$(function(){
    $('#p').click(function(){
        console.log($("#subjects option[value='" + $('#subject_name').val() + "']").attr('data-id'));
    });
});
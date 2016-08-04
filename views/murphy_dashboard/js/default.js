$(function () {

    var unitId = $('[title=unitId]').attr('id');
    
    
    $('#add_desc').click(function () {

        //alert($('#desc_content').val());
        var content = $('#desc_content').val();
        
        $.post('../../murphy/descriptionSave/' + unitId,  {content : content}, function (obj) {
            
            $(".message").html(obj);
        });
    });
});

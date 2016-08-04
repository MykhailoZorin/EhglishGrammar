$(function () {
    
    var answers = [];
    var actualAnswers = [];
    var userAnswer = "";
    var inputs = getInputs();
    $('.input_question').attr("disabled", false);
    var unitId = $('[title=unitId]').attr('id');

    inputs.eq( 0 ).trigger('focus');
    //inputs.eq( 0 ).trigger('keyup');
    
    $('.input_question').val("");
    
    // get the answers array: [content, textBoxId]
    $.get('../../murphy/getAnswers/' + unitId, function (obj) {

        for(var i = 0; i < obj.length; ++i) {
            
            answers[i] = [ obj[i].content, obj[i].textBoxId ];
        };
        
    }, "json");
    
    $('.input_question').keyup(function (event) {
        
        
        inputs = getInputs();
        actualAnswers = getActualAnswers($(this).attr("id"));
        userAnswer = $.trim( $(this).val().toLowerCase().replace(/[ ]{2,}/, ' ') );

        /* F1 help key pressed */
        if(event.keyCode == 113) {
            
            $(this).attr("disabled", true);
            $(this).attr("title", "done");
            $(this).val(actualAnswers[0]);
            inputs.eq( inputs.index(this) + 1 ).focus();
        }
        
        if($.inArray(userAnswer, actualAnswers) > -1) {
            
            $(this).css("background-color", "#efe");
            $(this).attr("disabled", true);
            $(this).attr("title", "done");

            if(inputs.length > 0) {
                inputs.eq( inputs.index(this) + 1 ).focus();

                if($('.input_question[title=done]').length == $('.input_question').length) {

                    $('.input_question').attr("disabled", true);
                    $('.input_question').attr("title", 'xxx');
                    alert("Well done! You've finished unit #" + unitId);
                    window.location = "../../murphy/unit/" + (parseInt(unitId) + 1) ;
                }
            }
        }
        else {
            
            $(this).css("background-color", "#FFCCCC");
        }
    });
    
    $('.input_question').focus(function () {
        
        $(this).trigger('keyup');
    });

    function getInputs() {
        
        return $('body').find('.input_question[title!=done]');
    }
 
    function getActualAnswers(textBoxId) {
        
        /* improve by using array functions */
        var res = [];
        
        for(var i = 0; i < answers.length; ++i) {
            
            if(answers[i][1] == textBoxId) {
                
                res.push(answers[i][0]); 
            }
        };
        
        return res;
    }
});


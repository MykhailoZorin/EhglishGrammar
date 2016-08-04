$(function () {
    
    
    $.get('murphy/getSections', function (obj) {
        
        for(var i = 0; i < obj.length; ++i) {
            
            $('#div-sections').append('<div><a href="#' + obj[i].id +
                                     '" id="a_section_'+ obj[i].id +'" name="'+ obj[i].id +'">'+ obj[i].name +'</a></div>' +
                                     '<div id="div_units_'+obj[i].id+'"><div>');
            
            $.get('murphy/getUnits/' + obj[i].id, function(obj) {

                for(var i = 0; i < obj.length; ++i) {
                    
                    // add proper links to each unit
                    $('#div_units_' + obj[i].sectionId).append('<div class="div_unit' + obj[i].sectionId + '"><a href="murphy/unit/' + obj[i].id + '">' + obj[i].name + '</a></div>');
                }
                
                $('div[class^=div_unit]').css('display', 'none');  
            }, "json");
        }
        
        $('a[id^=a_section_]').click(function () {

            $('div[class^=div_unit]').css('display', 'none');  
            
            var id = $(this).attr('name');
            $('div.div_unit' + id).css('display', 'block'); 

            return false;
        });

    }, "json");
    
});


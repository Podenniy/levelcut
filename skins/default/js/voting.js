function doAction(id,type){
            $.post('show.php', {id:id, type:type}, function(data){
                if(isNaN(parseFloat(data))){
                   alert(data);
                }else{
                    $('#'+id+'_'+type+'s').text(data);
                }
            });
        }
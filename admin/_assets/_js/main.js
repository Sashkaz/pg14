<script>
    $(document).on("click", "[id^='add_new_']", function(){
        var type = $(this).attr('id').split('_');
        var rows = $('#ammount_insert').val();
        var columns = $('.important').length;
        $("#dialog").load("_include/_pop-input/_add.php", { type: type[2], ammount: rows, columns: columns}, function() {}).fadeIn();
    });

    $(document).on("click", "[id^='request_add_']", function(){
        var type = $(this).attr('id').split('_');
        var columns = $('.important').length;
        var rows = ($("[id$='_new_"+type[2]+"']").length-1)/columns;
        var input = new Array();
        if(columns != 1){
            for(var i = 0; i < rows; i++){
                input[i] = new Array();
                for(var col = 0; col < columns; col++){
                    input[i][col] = $("[id$='"+i+"_"+col+"_new_"+type[2]+"']").val();
                }
            }
        }else{
            for(var i = 0; i < rows; i++){
                input[i] = $("[id$='"+i+"_new_"+type[2]+"']").val();
            }
        }
        console.log("Rows: " + rows);
        console.log("Columns: " + columns);
        $.post( "_ajax/add-new.php",
                {input: input,
                inputType: type[2],
                rows: rows,
                columns: columns}, 
                function(data){
                    /*if(!isNaN(data)){
                        $("#dialog").val("").fadeOut();
                        $(".container").load("_include/show-"+type[2]+".php").fadeIn();
                    }else{
                        alert(data);
                    }*/
                    alert(data);
                }
        );
    });
    $(document).on("click", '#cancel', function(){
        $("#dialog").val("").fadeOut();
    });
</script>
<script>
    $(document).on("click", "[id^='add_new_']", function(){
        var type = $(this).attr('id').split('_');
        var inputAmmount = $('#ammount_insert').val();
        $("#dialog").load("_include/_pop-input/_add.php", { type: type[2], ammount: inputAmmount}, function() {}).fadeIn();
    });

    $(document).on("click", "[id^='request_add_']", function(){
        var type = $(this).attr('id').split('_');
        var inputAmmount = $("[id$='_new_"+type[2]+"']").length-1;
        var input = new Array();
        for(var i = 0; i <= inputAmmount; i++){
            input[i] = $("[id$='"+i+"_new_"+type[2]+"']").val();
        }
        $.post( "_ajax/add-new.php",
                {input: input,
                inputType: type[2],
                inputAmmount: inputAmmount}, 
                function(data){
                    if(!isNaN(data)){
                        $("#dialog").val("").fadeOut();
                        $(".container").load("_include/show-"+type[2]+".php").fadeIn();
                    }else{
                        alert(data);
                    }
                }
        );
    });
    $(document).on("click", '#cancel', function(){
        $("#dialog").val("").fadeOut();
    });
</script>
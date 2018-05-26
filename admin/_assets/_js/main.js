<script>
    $(document).on("click", '[id^="add-new-"]', function(){
       
        var a = $(this).attr('id').split('-');
        console.log(a);

        if(a[2] == "city")
            $("#dialog").load("_include/_pop-input/_add-city.php").fadeIn();
        /*$.post("_ajax/logout-process.php",{
            uid: $('[name="uid"]').val()},
            function(data){
                location.reload();
            }
        )*/
    });
    $(document).on("click", '#cancel', function(){
        $("#dialog").val("").fadeOut();
    });

    function addNewInput(){

    }
</script>
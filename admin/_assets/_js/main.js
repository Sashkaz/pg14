<script>
    $(document).on("click", '[id^="add-new-"]', function(){
       
        var a = $(this).attr('id').split('-');
        console.log(a);
        /*$.post("_ajax/logout-process.php",{
            uid: $('[name="uid"]').val()},
            function(data){
                location.reload();
            }
        )*/
    });

    function addNewInput(){

    }
</script>
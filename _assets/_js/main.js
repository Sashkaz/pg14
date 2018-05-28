<script>
$(document).on("click", "[name^='nav_']", function(){
    //var input = $(this).attr('name').split('_');
    var checkValues = $("[name^='nav_']:checkbox:checked");
    /*$.post("_ajax/filter-users.php",
                {'input[]': checkValues}, 
                function(data){
                    alert(data);
                }
        );*/
});

</script>
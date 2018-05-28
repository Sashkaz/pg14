<script>
$(document).on("click", "[name^='nav_']", function(){
    var checkedValues = new Array();
    $("[name^='nav_']:checked").each(function() {
        var input = $(this).attr('name').split('_');
        checkedValues.push([input[1], $(this).val()]);
    });
    $.post("_ajax/filter-users.php",
                {input: checkedValues}, 
                function(data){
                    console.log(data);
                }
        );
    // console.log(checkedValues);
});

</script>
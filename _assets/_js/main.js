<script>
$(document).on("click", "[id='main_checkbox']", function(){
    var checkedValues = new Array();
    $("[name='city']:checked").each(function() {
        var input = $(this).attr('name').split('_');
        checkedValues.push([input[1], $(this).val()]);
    });
    if(checkedValues.length > 0){
        $.post("_include/location-filter.php",
                {city: checkedValues}, 
                function(data){
                    $("#rest-search").html(data);
                }
        );
    }
});
$(document).on("click", "[name^='nav_']", function(){
    var checkedValues = new Array();
    $("[name^='nav_']:checked").each(function() {
        var input = $(this).attr('name').split('_');
        checkedValues.push([input[1], $(this).val()]);
    });
    $.post("_ajax/filter-users.php",
                {input: checkedValues}, 
                function(data){
                    $("#center-content").load("_include/show-users.php", {req: data}, function() {}).fadeIn();
                }
    );
});
</script>
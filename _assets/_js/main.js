<script>
    $(document).on("click", "[id='main_checkbox']", function(){
        var checkedValues = new Array();
        var lang = $("input[id='lang']").val();
        $("[name='city']:checked").each(function() {
            var input = $(this).attr('name').split('_');
            checkedValues.push([input[1], $(this).val()]);
        });
        if(checkedValues.length > 0){
            $.post("_include/_async/location-filter.php",
                    {city: checkedValues, lang: lang}, 
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
                    {input: checkedValues,
                    userID: $("[id='uid']").val()}, 
                    function(data){
                        $("#center-content").load("_include/_async/show-users-filtered.php", {req: data}, function() {}).fadeIn();
                    }
        );
    });
    $(document).on("keyup", "[id='search-buddy']", function(){
        var input = $(this).val();
        $.post("_ajax/filter-users.php",
                    {buddySearch: input}, 
                    function(data){
                        $(".friend-container").load("_include/buddy-list.php", {search: data}, function() {}).fadeIn();
                    }
        );
    });
</script>
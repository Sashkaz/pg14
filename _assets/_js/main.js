<script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
<script>
    $(document).on("click", "[name='city']", function(){
        var checkedValues = new Array();
        var lang = $("input[id='lang']").val();
        $("[name='city']:checked").each(function() {
            var input = $(this).attr('name').split('_');
            checkedValues.push([input[1], $(this).val()]);
        });
        console.log(checkedValues);
        if(checkedValues.length > 0){
            $.post("_include/_async/location-filter-backup.php",
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
                    uid: $("[id='uid']").val()}, 
                    function(data){
                        $("#center-content").load("_include/_async/show-users-filtered.php", {req: data}, function() {}).fadeIn();
                    }
        );
    });
    $(document).on("keyup", "[id='search-buddy']", function(){
        var input = $(this).val();
        $.post("_ajax/filter-users.php",
                    {buddySearch: input, 
                    uid: $("[id='uid']").val()}, 
                    function(data){
                        $(".friend-container").load("_include/_async/show-own-buddy-list-filtered.php", {search: data}, function() {}).fadeIn();
                    }
        );
    });
    /* City Start */
    $(".city-drop dt a").on('click', function() {
        $(".city-drop dd ul").slideToggle('fast');
    });

    $(".city-drop dd ul li a").on('click', function() {
        $(".city-drop dd ul").hide();
    });

    function getSelectedValue(id) {
        return $("#" + id).find("dt a span.value").html();
    }

    $(document).bind('click', function(e) {
        var $clicked = $(e.target);
        if (!$clicked.parents().hasClass("city-drop")) $(".city-drop dd ul").hide();
    });

    $('.city-select input[name="city"]').on('click', function() {
        var title = $(this).closest('.city-select').find('input[type="checkbox"]').val(),
            title = $(this).val() + ",";

        if ($(this).is(':checked')) {
            var html = '<span title="' + title + '">' + title + '</span>';
            $('.multiSel').append(html);
            $(".hida").hide();
        } else {
            $('span[title="' + title + '"]').remove();
            var ret = $(".hida");
            $('.city-drop dt a').append(ret);
        }
    });
</script>
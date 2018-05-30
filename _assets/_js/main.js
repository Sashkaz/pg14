<script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
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
      
/*
    Dropdown with Multiple checkbox select with jQuery - May 27, 2013
    (c) 2013 @ElmahdiMahmoud
    license: https://www.opensource.org/licenses/mit-license.php
*/

$(".dropdown dt a").on('click', function() {
  $(".dropdown dd ul").slideToggle('fast');
});

$(".dropdown dd ul li a").on('click', function() {
  $(".dropdown dd ul").hide();
});

function getSelectedValue(id) {
  return $("#" + id).find("dt a span.value").html();
}

$(document).bind('click', function(e) {
  var $clicked = $(e.target);
  if (!$clicked.parents().hasClass("dropdown")) $(".dropdown dd ul").hide();
});

$('.mutliSelect input[type="checkbox"]').on('click', function() {

  var title = $(this).closest('.mutliSelect').find('input[type="checkbox"]').val(),
    title = $(this).val() + ",";

  if ($(this).is(':checked')) {
    var html = '<span title="' + title + '">' + title + '</span>';
    $('.multiSel').append(html);
    $(".hida").hide();
  } else {
    $('span[title="' + title + '"]').remove();
    var ret = $(".hida");
    $('.dropdown dt a').append(ret);

  }
});
</script>
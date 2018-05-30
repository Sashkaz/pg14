<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>TrainingBuddies</title>
<link rel="stylesheet" type="text/css" href="_assets/_css/main.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
<script src="_assets/_js/jquery-3.3.1.min.js"></script>
<script>
    $(document).on("change", "[name='lang_selector']", function(){
            var langPref = $(this).val();
            $.post("_process/set-lang.php",
                        {lang: langPref}, 
                        function(data){
                            document.location.reload(true);
                        }
            );
    });
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.0/jquery.min.js"></script>
<script>
$(document).ready(function() {
    var response = '';
    $.ajax({
        type: "GET",
        url: "LoadQuestions.php",
        async: true,
        success: function(text)
        {
            response = text;
            $("#Data").html(response);
        }
    });
});
</script>
<h7 id="Data" >

</h7>

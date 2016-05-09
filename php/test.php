<?php
echo'
<button type="button">Click Me</button>
<p></p>
<script type="text/javascript">
    $(document).ready(function(){
        $("button").click(function(){

            $.ajax({
                type: "POST",
                url: "company_assets.php",
                success: function(data) {
                    alert(data);
                    $("p").text(data);

                }
            });
   });
});
</script>';
?>
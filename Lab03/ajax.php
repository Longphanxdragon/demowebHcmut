<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>AJAX Examples</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>AJAX Examples</h1>

    <h2>Basic AJAX</h2>
    <div id="basicAjaxDiv">Click button to load content</div>
    <button onclick="loadBasicAjax()">Load Basic AJAX</button>

    <h2>jQuery AJAX</h2>
    <div id="jqueryAjaxDiv">Click button to load content</div>
    <button onclick="loadJqueryAjax()">Load jQuery AJAX</button>

    <script>
        function loadBasicAjax() {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("basicAjaxDiv").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "ajax_content.php", true);
            xmlhttp.send();
        }

        function loadJqueryAjax() {
            $.ajax({
                url: "ajax_content.php",
                type: "GET",
                dataType: "html",
                success: function(data) {
                    $("#jqueryAjaxDiv").html(data);
                }
            });
        }
    </script>
</body>
</html>
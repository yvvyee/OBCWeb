<?php require_once 'footer.php';
HELLO();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <script src="../lib/jquery/jquery.min.js"></script>
</head>
<body>
<h1>Welcome to my home page!</h1>
<p>Some text.</p>
<p>Some more text.</p>
<div class="container">
    <header>
        <div id="header">

        </div>
    </header>
</div>
</body>
</html>

<script>
    $(function () {

       $('#header').load('test.html#title');
    });
</script>
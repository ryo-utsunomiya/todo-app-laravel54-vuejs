<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Hello Vue</title>
    <link rel="stylesheet" href="css/app.css"/>
    <script type="text/javascript">
        window.Laravel = window.Laravel || {};
        window.Laravel.csrfToken = "{{csrf_token()}}";
    </script>
</head>
<body>
<div id="app">
    <hello></hello>
    <hello name="Laravel"></hello>
    <hello name="Vue.js"></hello>
</div>
<script src="js/app.js"></script>
</body>
</html>
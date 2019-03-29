<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
<link rel="stylesheet" href="{{elixir('css/app.css')}}">
</head>
<body>
   
    <div id="app">
        <example></example>
    </div>
    <script type="text/javascript">      
        var csrf_token  = window.csrf_token = "{{ csrf_token() }}"
       localStorage.setItem('CSRF_TOKEN',csrf_token);
   </script>
<script src="{{elixir('js/app.js')}}"></script>
    
</body>

</html>
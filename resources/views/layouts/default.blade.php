<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Upload Images - Lumen</title>
    <!-- Bootstrap -->
    <link href="{{ url('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<nav class="navbar navbar-default">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <a class="navbar-brand" href="{{ url('/') }}">Lumen - Upload Images</a>
        </div>
    </div><!-- /.container -->
</nav>

@yield('contents')

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="{{ url('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ url('assets/js/vendor/jquery.ui.widget.js') }}"></script>
<script src="{{ url('assets/js/jquery.iframe-transport.js') }}"></script>
<script src="{{ url('assets/js/jquery.fileupload.js') }}"></script>
<script src="{{ url('assets/js/jquery.fileupload-process.js') }}"></script>
<script src="{{ url('assets/js/jquery.fileupload-validate.js') }}"></script>
<script src="{{ url('assets/js/jquery.loadTemplate.min.js') }}"></script>
<script src="{{ url('assets/js/uploadHandler.js') }}"></script>
<script src="{{ url('assets/js/app.js') }}"></script>
</body>
</html>
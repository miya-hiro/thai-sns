<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>
    @yield('title')
  </title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  <link href="https://fonts.googleapis.com/css2?family=DM+Mono:ital,wght@1,300&display=swap" rel="stylesheet">
  <!-- Bootstrap core CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.11/css/mdb.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
  <link rel="stylesheet" href="{{ mix('css/app.css') }}">
  <style>
    th:nth-of-type(7),
    td:nth-of-type(7) {
      color: red;
    }

    th:nth-of-type(6),
    td:nth-of-type(6) {
      color: blue;
    }
  </style>
</head>

<body>

  <div id="app"> {{--この行を追加--}}
    @yield('content')
  </div> {{--この行を追加--}}


  <!-- JQuery -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.11/js/mdb.min.js"></script>
  <script src="{{ mix('js/app.js') }}"></script> {{--この行を追加--}}

  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

  <?php $path = $_SERVER['REQUEST_URI']; ?>
  <?php if ((preg_match("/\/articles\/[a-zA-Z]/", $path)) || (preg_match("/\/articles\/.*\/[a-zA-Z]/", $path))) {; ?>

    <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script>
      CKEDITOR.replace('body');
    </script>
  <?php }; ?>
</body>

</html>
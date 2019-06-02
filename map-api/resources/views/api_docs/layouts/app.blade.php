<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="chrome=1">
  <title>API Documentation</title>
  <link rel="stylesheet" href="{{ asset('static/css/normalize.css') }}">
  <link rel="stylesheet" href="{{ asset('static/css/style.css') }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--[if lt IE 9]>
  <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->

  <!--[if IE]>
  <link rel="stylesheet" href="../static/css/for-ie-only.css">
  <![endif]-->

  @yield('pre-script')

</head>
<body>


    <header class="header cf" role="banner">
        <div class="wrap">
            <a href="" target="_blank"><h1><span>Map</span> Assignment</h1></a>
        </div>
    </header>

    <div class="wrap">
        <div class="content">
            <aside>
                <h1 class="page-title"><a href="index.html">Map API docs</a></h1>
                <p class="intro"></p>
                <nav>
                    <ul>
                    <li><a href="{{ route('overview') }}" class="overview">Overview</a></li>
                    <li><a href="{{ route('getting_started') }}" class="getting_started">Getting Started</a></li>
                    <li><a href="{{ route('api_calls') }}" class="console">API calls</a></li>
                    <li><a href="{{ route('field_reference') }}" class="fields">Field reference</a></li>
                    <li><a href="{{ route('faq') }}" class="faq">Frequently Asked Questions</a></li>
                    <li><a href="{{ route('contact') }}" class="contact_us">Contact Us</a></li>
                    </ul>
                </nav>
            </aside>
            @yield('content')
        </div>
    </div> <!--wrap-->

    <footer class="footer cf" role="contentinfo">
        <div class="wrap">
            <section class="footer-oss">
                <h4></h4>
                <p></p>
            </section>
            <section class="footer-links">
                <ul>
                    <li></li>
                </ul>
            </section>
        </div>
    </footer>
    <script src="{{ asset('static/js/docs.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('static/js/expandables.js') }}"></script>
    @yield('after-script')
</body>

</html>

@extends('api_docs.layouts.app')

@section('pre-script')
<script src="{{ asset('static/console/lib/object-assign-pollyfill.js') }}" type='text/javascript'></script>
  <script src="{{ asset('static/console/lib/jquery-1.8.0.min.js') }}" type='text/javascript'></script>
  <script src="{{ asset('static/console/lib/jquery.slideto.min.js') }}" type='text/javascript'></script>
  <script src="{{ asset('static/console/lib/jquery.wiggle.min.js') }}" type='text/javascript'></script>
  <script src="{{ asset('static/console/lib/jquery.ba-bbq.min.js') }}" type='text/javascript'></script>
  <script src="{{ asset('static/console/lib/handlebars-4.0.5.js') }}" type='text/javascript'></script>
  <script src="{{ asset('static/console/lib/lodash.min.js') }}" type='text/javascript'></script>
  <script src="{{ asset('static/console/lib/backbone-min.js') }}" type='text/javascript'></script>
  <script src="{{ asset('static/console/swagger-ui.js') }}" type='text/javascript'></script>
  <script src="{{ asset('static/console/lib/highlight.9.1.0.pack.js') }}" type='text/javascript'></script>
  <script src="{{ asset('static/console/lib/highlight.9.1.0.pack_extended.js') }}" type='text/javascript'></script>
  <script src="{{ asset('static/console/lib/jsoneditor.min.js') }}" type='text/javascript'></script>
  <script src="{{ asset('static/console/lib/marked.js') }}" type='text/javascript'></script>
  <script src="{{ asset('static/console/lib/swagger-oauth.js') }}" type='text/javascript'></script>
  <script type="text/javascript">
    $(function () {
      var url = window.location.search.match(/url=([^&]+)/);
      if (url && url.length > 1) {
        url = decodeURIComponent(url[1]);
      } else {
        url = "{{ asset('static/console/citypairs.json') }}";
      }

      hljs.configure({
        highlightSizeThreshold: 5000
      });

      // Pre load translate...
      if(window.SwaggerTranslator) {
        window.SwaggerTranslator.translate();
      }
      window.swaggerUi = new SwaggerUi({
        url: url,
        dom_id: "swagger-ui-container",
        supportedSubmitMethods: ['get', 'post', 'put', 'delete', 'patch'],
        onComplete: function(swaggerApi, swaggerUi){
          if(typeof initOAuth == "function") {
            initOAuth({
              clientId: "your-client-id",
              clientSecret: "your-client-secret-if-required",
              realm: "your-realms",
              appName: "your-app-name",
              scopeSeparator: " ",
              additionalQueryStringParams: {}
            });
          }

          if(window.SwaggerTranslator) {
            window.SwaggerTranslator.translate();
          }
        },
        onFailure: function(data) {
          log("Unable to Load SwaggerUI");
        },
        docExpansion: "full",
        jsonEditor: false,
        defaultModelRendering: 'schema',
        showRequestHeaders: false,
        showOperationIds: false
      });

      window.swaggerUi.load();

      function log() {
        if ('console' in window) {
          console.log.apply(console, arguments);
        }
      }
  });
  </script>
@endsection

@section('content')
<section class="main-content" role="main">
    <h3 id='api_calls'>API calls</h3>
    <p>Explore the API here hands-on. </p>
    <p>Need a little help? Read our <a href="{{ route('getting_started') }}">Getting Started</a> to learn about using the API.</p>

    <div id="message-bar" class="swagger-ui-wrap">
    </div>

    <span class="anchor" id="swagger-ui-offset-fix"> </span>

    <div id="swagger-ui-container" class="swagger-ui-wrap"></div>
</section>
@endsection

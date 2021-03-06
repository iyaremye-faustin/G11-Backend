<html>
<head>
    <title>{{ config('app.name') }} | APIs Documentation</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swagger-ui-dist@3.20.3/swagger-ui.css">
    {{-- <link href="{{asset('swagger/style.css')}}" rel="stylesheet"> --}}
</head>
<body>
<div id="swagger-ui"></div>
{{-- <script src="{{asset('swagger/swagger-bundle.js')}}"></script> --}}
<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
</head>
<body>
<div id="swagger-ui"></div>
{{-- <script src="{{asset('swagger/jquery-2.1.4.min.js')}}"></script> --}}
{{-- <script src="{{asset('swagger/swagger-bundle.js')}}"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swagger-ui-dist@3.20.3/swagger-ui-bundle.js"></script>
<script type="application/javascript">
    const ui = SwaggerUIBundle({
        url: "{{ asset('swagger/swagger.yaml') }}",
        dom_id: '#swagger-ui',
    });
</script>
</body>
</html>

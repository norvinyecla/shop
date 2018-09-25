<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Edit {{ $product['name'] }}</title>

        <!-- CSRF Stuff -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script>window.Laravel = { csrfToken: '{{ csrf_token() }}' }</script>
   </head>
   <body>
        <a href='/'>Go Back Home</a>
        <h2>Editing {{ $product['name'] }} </h2>
        <div class="container" id='app'>
            <product-edit-form v-bind:product=product></product-edit-form>
        </div>
        
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
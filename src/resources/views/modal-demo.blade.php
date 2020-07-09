<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <div id="app">
        <demo-image-picker
            {{-- value="http://localhost/xxx.png" --}}
            {{-- v-model="image" --}}
        ></demo-image-picker>
        @include('MediaManager::modal')
    </div>

    {{-- styles --}}
    @stack('styles')

    {{-- scripts --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.11/vue.js"></script>
    @stack('scripts')
    <script>
        new Vue({
            el: '#app'
        })
    </script>
</body>
</html>

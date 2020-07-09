<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ trans('MediaManager::messages.title') }}</title>
    {{-- <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/bulma@0.8.0/css/bulma.min.css"> --}}
    {{-- <link rel="stylesheet" href="https://cdn.rawgit.com/jgthms/minireset.css/master/minireset.min.css" /> --}}
</head>
<body>
    <section id="app" v-cloak>
        {{-- notifications --}}
        <div class="notif-container">
            <my-notification></my-notification>
        </div>

        <div class="media-manager-container">
            <html><body>
            @include('MediaManager::_manager')
            </body></html>
        </div>
    </section>

    {{-- footer --}}
    @stack('styles')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.11/vue.js" integrity="sha512-PyKhbAWS+VlTWXjk/36s5hJmUJBxcGY/1hlxg6woHD/EONP2fawZRKmvHdTGOWPKTqk3CPSUPh7+2boIBklbvw==" crossorigin="anonymous"></script>
    @stack('scripts')
    <script src="{{ asset("assets/vendor/MediaManager/app.js") }}"></script>
    <script>
        new Vue({
            el: '#app'
        })
    </script>
</body>
</html>

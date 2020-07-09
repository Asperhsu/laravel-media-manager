<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ trans('MediaManager::messages.title') }}</title>
</head>
<body>
    <section id="app" v-cloak>
        {{-- notifications --}}
        <div class="notif-container">
            <my-notification></my-notification>
        </div>

        <div class="media-manager-container">
            @include('MediaManager::_manager')
        </div>
    </section>

    {{-- styles --}}
    @stack('styles')

    {{-- scripts --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.11/vue.js"></script>
    @stack('scripts')
    <script src="{{ asset("assets/vendor/MediaManager/app.js") }}"></script>
    <script>
        new Vue({
            el: '#app'
        })
    </script>
</body>
</html>

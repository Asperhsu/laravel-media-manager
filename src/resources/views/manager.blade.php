<div class="media-manager-container">
    @include('MediaManager::_manager')
</div>

@push('scripts')
    <script src="{{ asset("assets/vendor/MediaManager/app.js") }}"></script>
@endpush

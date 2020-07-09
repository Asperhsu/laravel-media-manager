<media-manager-modal inline-template class="media-manager-container">
    <div v-cloak>
        {{-- notifications --}}
        <div class="notif-container">
            <my-notification></my-notification>
        </div>

        <div v-if="inputName">@include('MediaManager::extras.modal')</div>
        <media-modal item="image" :name="inputName"></media-modal>
    </div>
</media-manager-modal>

@push('scripts')
    <script src="{{ asset("assets/vendor/MediaManager/app.js") }}"></script>
@endpush

<script>
    import MediaModal from '../../MediaManager/js/mixins/modal'
    export default {
        name: 'media-manager-modal',
        mixins: [MediaModal],

        data () {
            return {
                image: '',
                callback: null,
            };
        },

        mounted () {
            window.EventHub && window.EventHub.listen('MediaManager::open', ({old, callback}) => {
                this.toggleModalFor('image');
                this.image = old || '';
                this.callback = callback || null;
            });

            window.EventHub && window.EventHub.listen('MediaManager::close', () => {
                this.inputName && this.hideInputModal();
            });
        },

        beforeDestroy () {
            window.EventHub.removeListenersFrom('MediaManager::open');
            window.EventHub.removeListenersFrom('MediaManager::close');
        },

        watch: {
            inputName (value) {
                // clean callback when modal closed
                if (!value && this.callback) {
                    this.callback = null;
                }
            },
            image (value) {
                if (value && this.callback) {
                    this.callback(value);
                }
            },
        },
    }
</script>

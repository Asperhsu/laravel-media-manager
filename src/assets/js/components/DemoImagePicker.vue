<template>
    <div>
        <img v-if="path" :src="path" style="max-height: 30vh;">
        <button @click="emitManager">select cover</button>
        <p>selected: {{  this.path }}</p>
    </div>
</template>

<script>
    export default {
        props: ['value'],
        data () {
            return {
                path: null,
            };
        },
        watch: {
            path () {
                this.$emit('input', this.path);
            },
        },
        methods: {
            emitManager () {
                window.EventHub && window.EventHub.fire('MediaManager::open', {
                    old: this.value,
                    callback: (path) => this.path = path,
                });
            },
        },
    }
</script>

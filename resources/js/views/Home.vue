<template>
    <div>
        <button v-on:click="reverseMessage">Reverse Message</button>
    </div>
</template>
<script>
    import {message} from 'ant-design-vue';

    export default {
        methods: {
            reverseMessage: function () {
                message.info('This is a normal message');
            }
        }
    }
    

</script>
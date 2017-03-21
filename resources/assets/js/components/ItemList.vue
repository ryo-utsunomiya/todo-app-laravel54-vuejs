<template>
    <div class="row">
        <ul class="list-group">
            <item v-for="item in items" v-bind:item="item"></item>
        </ul>
    </div>
</template>

<script>
    const Item = require('./Item.vue');
    const store = require('../store/').default;
    const {GET_ITEMS} = require('../store/action-types');

    export default {
        components: {Item},
        computed: {
            items: () => store.getters.uncheckedItems
        },
        created() {
            store.dispatch(GET_ITEMS);
        }
    }
</script>
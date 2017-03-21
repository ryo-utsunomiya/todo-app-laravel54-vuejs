<template>
    <div class="container">
        <new-item></new-item>
        <item-list></item-list>
    </div>
</template>

<script>
    const NewItem = require('./NewItem.vue');
    const ItemList = require('./ItemList.vue');

    export default {
        components: {NewItem, ItemList}
    }
</script>
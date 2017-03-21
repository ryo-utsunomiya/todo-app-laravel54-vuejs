<template>
    <li class="list-group-item">
        <input type="checkbox" name="checked" @click="checkItem" v-model="item.checked">
        <span class="content">{{item.content}}</span>
        <button class="btn btn-sm remove-button" @click="deleteItem">
            <i class="glyphicon glyphicon-remove"></i>
        </button>
    </li>
</template>

<script>
    const store = require('../store/').default;
    const {CHECK_ITEM, DELETE_ITEM} = require('../store/action-types');

    export default {
        props: ['item'],
        methods: {
            checkItem() {
                store.dispatch(CHECK_ITEM, this.item.id);
            },
            deleteItem() {
                if (!confirm("削除しますか？")) return;
                store.dispatch(DELETE_ITEM, this.item.id);
            }
        }
    }
</script>

<style scoped>
    li {
        display: flex;
    }

    input[name=checked] {
        cursor: pointer;
        margin-right: 10px;
    }

    .content {
        flex-grow: 1;
    }

    .remove-button {
        align-items: flex-end;
        width: 34px;
        height: 30px;
    }
</style>
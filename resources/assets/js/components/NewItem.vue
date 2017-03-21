<template>
    <div class="row new-item">
        <label>
            新しいタスク
            <input type="text" name="content" v-model="content" @keydown.enter="addItem"
                   @compositionstart="composing=true" @compositionend="composing=false">
        </label>
        <input type="submit" value="追加" class="btn btn-sm btn-primary"
               @click="addItem">
    </div>
</template>

<script>
    const store = require('../store/').default;
    const {CREATE_ITEM} = require('../store/action-types');

    export default {
        data() {
            return {
                content: '',
                composing: false // IMEによる入力中か否かのフラグ
            }
        },
        methods: {
            addItem(event) {
                if (!this.content) return;
                store.dispatch(CREATE_ITEM, this.content);
                this.content = '';
            }
        }
    }
</script>

<style scoped>
    .new-item {
        margin: 10px 0;
        width: 100%;
        display: flex;
    }

    label {
        justify-content: flex-start;
        flex-grow: 1;
    }

    input[name=content] {
        width: 80%;
    }

    button {
        justify-content: flex-end;
    }
</style>
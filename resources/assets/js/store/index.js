const Vuex = require('vuex');
const {MUTATION} = require('./mutation-types');
const {ACTION} = require('./action-types');
const {ItemsAPI} = require('../api/items');

const state = {
    items: []
};

const getters = {
    uncheckedItems: (state) => state.items.filter(item => !item.checked)
};

const actions = {
    [ACTION.GET_ITEMS] ({commit}) {
        ItemsAPI.getAllUnchecked(items => {
            commit(MUTATION.SET_ITEMS, items);
        });
    },
    [ACTION.CREATE_ITEM] ({commit}, content) {
        ItemsAPI.create(content, (item) => {
            commit(MUTATION.ADD_ITEM, item);
        });
    },
    [ACTION.CHECK_ITEM] ({commit}, id) {
        ItemsAPI.check(id, () => {
            // チェックされたアイテムをリストから削除
            commit(MUTATION.REMOVE_ITEM_BY_ID, id);
        });
    },
    [ACTION.DELETE_ITEM] ({commit}, id) {
        ItemsAPI.delete(id, () => {
            commit(MUTATION.REMOVE_ITEM_BY_ID, id);
        });
    }
};

const mutations = {
    [MUTATION.SET_ITEMS] (state, items) {
        state.items = items;
    },
    [MUTATION.ADD_ITEM] (state, item) {
        state.items.push(item);
    },
    [MUTATION.REMOVE_ITEM_BY_ID] (state, id) {
        state.items = state.items.filter(item => item.id !== id);
    }
};

export default new Vuex.Store({
    state,
    getters,
    actions,
    mutations
});

const axios = require('axios');
const API_URI = '/api/items';

export const ItemsAPI = {
    getAllUnchecked(callback) {
        axios.get(API_URI)
            .then((response) => {
                callback(response.data);
            })
            .catch((error) => {
                console.log(error);
            });
    },
    create(content, callback) {
        axios.post(API_URI, {content: content})
            .then((response) => {
                callback(response.data);
            })
            .catch((error) => {
                console.error(error);
            });
    },
    check(id, callback) {
        axios.patch(API_URI + '/' + id, {checked: true})
            .then((response) => {
                callback(response.data);
            })
            .catch((error) => {
                console.error(error);
            });
    },
    delete(id, callback) {
        axios.delete(API_URI + '/' + id)
            .then((response) => {
                callback(response.data);
            })
            .catch((error) => {
                console.error(error);
            });
    }
};
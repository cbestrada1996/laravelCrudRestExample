
import Client from './client/MainClient';
const path = '/api/item';

export default {
    get() {
        return Client.get(`${path}/all`);
    },
    getItem(id) {
        return Client.get(`${path}/${id}`);
    },
    create(data) { 
        return Client.post(`${path}/create`, data);
    },
    update(data, id) {
        data.append('_method', "PUT");
        return Client.post(`${path}/${id}`, data);
    },
    delete(id) {
        return Client.delete(`${path}/${id}`)
    },

    // MANY OTHER ENDPOINT RELATED STUFFS
};
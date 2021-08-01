import Client from '../Client';
const resource = '/codes';

export default {
    filter(data) {
        return Client.get(`${resource}`, { params: data }); // get truyen tham so phai them param
    },
    get() {
        return Client.get(`${resource}`);
    },
    getPost(id) {
        return Client.get(`${resource}/${id}`);
    },
    create() {
        return Client.post(`${resource}`);
    },
    update(payload, id) {
        return Client.put(`${resource}/${id}`, payload);
    },
    delete(id) {
        return Client.delete(`${resource}/${id}`)
    },


    // MANY OTHER ENDPOINT RELATED STUFFS
};
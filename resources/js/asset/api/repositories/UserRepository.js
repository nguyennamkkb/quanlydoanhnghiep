import Client from '../Client';
const resource = '/';

export default {
    login(payload) {
        return Client.post(`/login`, payload);
    },
    register(payload) {
        return Client.post(`/register`, payload);
    },
    logout() {
        return Client.post(`/logout`);
    },
    getlistUser() {
        return Client.get(`/users`);
    },
    updateUser(id, payload) {
        return Client.put(`/users/${id}`, payload);
    },
    create(payload) {
        return Client.post(`/users`, payload);
    },
    delete(id) {
        return Client.delete(`/users/${id}`);
    },
    filter(data) {
        return Client.get(`/users`, { params: data }); // get truyen tham so phai them param
    },


};
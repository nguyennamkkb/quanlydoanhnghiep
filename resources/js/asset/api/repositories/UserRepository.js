import Client from '../Client';
const resource = '';

export default {
    login(payload) {
        return Client.post(`${resource}/login`, payload);
    },
    register(payload) {
        return Client.post(`${resource}/register`, payload);
    },
    logout() {
        return Client.post(`${resource}/logout`);
    },
    getlistUser() {
        return Client.get(`${resource}/users`);
    }


};
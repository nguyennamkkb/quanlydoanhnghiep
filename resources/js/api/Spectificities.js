import Client from '../plugins/axios'
const resource = '/api';


export function getSpectificities(data) {
    return Client({
        url: resource + '/spectificities',
        method: 'get',
        params: data
    })
}
export function createSpectificities() {
    return Client({
        url: resource + '/spectificities',
        method: 'post',
    })
}
export function updateSpectificities(id, data) {
    return Client({
        url: resource + '/spectificities/' + id,
        method: 'put',
        params: data
    })
}
export function deleteSpectificities(id) {
    return Client({
        url: resource + '/spectificities/' + id,
        method: 'delete',
    })
}
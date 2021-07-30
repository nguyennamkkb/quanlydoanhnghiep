import CodeRepository from './CodeRepository';
import UserRepository from './UserRepository';


const repositories = {
    'codes': CodeRepository,
    'users': UserRepository,

}
export default {
    get: name => repositories[name]
};
import {HTTP} from '../../core/plugins/http'
import CONSTANTS from '../../core/utils/constants';

export const listBillTour = ({commit}, opt) => {
    return new Promise((resolve, reject) => {
        HTTP.post('/api/bill_tour/list', opt).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
};

export const detailBillTour = ({commit}, id) => {
    return new Promise((resolve, reject) => {
        HTTP.get('/api/bill_tour/detail/' + id).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
};

export const deleteBillTour = ({commit}, id) => {
    return new Promise((resolve, reject) => {
        HTTP.get('/api/bill_tour/delete/' + id).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
};


import ApiService from '../../common/api.service'
import axios from 'axios'
// state
export const state = {

}

// getters
export const getters = {

}

// mutations
export const mutations = {

}

// actions
export const actions = {
    addComment (context, payload) {
        return new Promise((resolve, reject) => {
            let baseUrl = ApiService.getBaseUrl();
            axios
            .post(baseUrl + '/comment/', payload)
            .then(response => {
                if(response.data.success){
                    resolve(response.data.success);
                } else {
                    // console.log(response.data.error);
                    reject(response.data.error);
                }
            }).catch(err => {
                // console.log(err.error);
                reject(err.error);
            })
        });    
    },
    pullComments(context, payload) {
        // console.log(payload);
        return new Promise((resolve, reject) => {
            let baseUrl = ApiService.getBaseUrl();
            axios
            .get(baseUrl + '/comment/pullComments/' + payload.parent_id)
            .then(response => {
                // console.log(response);
                resolve(response);
            }).catch(err => {
                // console.log(err);
                reject(err);
            })
        });    
    }
}
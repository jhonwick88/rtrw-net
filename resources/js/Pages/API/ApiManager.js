import axios from 'axios';

axios.interceptors.request.use(
  config => {
    const token = localStorage.getItem('access_token');
      if (token) {
          config.headers['Authorization'] = 'Bearer ' + token;
      }
      config.headers['Accept'] = 'application/json';
      return config;
  },
  error => {
      Promise.reject(error)
  });
axios.interceptors.response.use(function (response) {
  return response;
}, function (error) {
  const originalRequest = error.config;
   if (error.response.status === 401 && !originalRequest._retry) {
       originalRequest._retry = true;
       console.log('no token');
   }
  return Promise.reject(error);
});
export const baseUrl = process.env.MIX_API_PATH;

export default{
    getPromoted(filter = 'today'){
        return axios.get(`${baseUrl}/coin/index`,{
          params: {
            status: filter,
            pr: 1
          }
        });
    },
    getFiltersCoins(page = 1, filter ='today'){
      return axios.get(`${baseUrl}/coin/index`, {
          params:{
            page: page,
            limit: 10,
            status: filter
          }
        });
    },
    getSearchResult(query){
      return axios.get(`${baseUrl}/coin/index`, {
          params:{
            all: 1,
            q: query
          }
        });
    },
    getUsers(page = 1){
      return axios.get(`${baseUrl}/user/index`, {
          params:{
            page: page,
            limit: 10,
          }
        });
    },
    getCustomers(page = 1){
        return axios.get(`${baseUrl}/customer/index`, {
            params:{
              page: page,
              limit: 10,
            }
          });
    },
    getSearchCustomers(query){
        return axios.get(`${baseUrl}/customer/index`, {
            params:{
                all: 1,
                q: query
              }
          });
    },
    postSubmitCustomer(data){
        return axios.post(`${baseUrl}/customer/store`,data)
    },
    postUpdateCustomer(data){
        return axios.put(`${baseUrl}/customer/update/${data.id}`,data);
    },
    postRemoveCustomer(data){
        return axios.delete(`${baseUrl}/customer/destroy/${data.id}`);
    },
    getCustomerMembers(page = 1){
        return axios.get(`${baseUrl}/customer-member/index`, {
            params:{
                page: page,
                limit: 10,
            }
            });
        },
    postRemoveMemberCustomer(data){
        return axios.delete(`${baseUrl}/customer-member/destroy/${data.id}`);
    },
    postUpdateMemberCustomer(data){
        return axios.put(`${baseUrl}/customer-member/update/${data.id}`,data);
    },
    postAddMemberCustomer(data){
        return axios.post(`${baseUrl}/customer-member/store`,data)
    },
    getServers(page = 1){
    return axios.get(`${baseUrl}/server/index`, {
        params:{
            page: page,
            limit: 10,
        }
        });
    },
    getSearchServers(query){
        return axios.get(`${baseUrl}/server/index`, {
            params:{
                all: 1,
                q: query
              }
          });
    },
    postRemoveServer(data){
        return axios.delete(`${baseUrl}/server/destroy/${data.id}`);
    },
    postUpdateServer(data){
        return axios.put(`${baseUrl}/server/update/${data.id}`,data);
    },
    postAddServer(data){
        return axios.post(`${baseUrl}/server/store`,data)
    },
    getNetworks(page = 1){
        return axios.get(`${baseUrl}/network/index`, {
            params:{
                page: page,
                limit: 10,
            }
            });
    },
    getSearchNetworks(query){
        return axios.get(`${baseUrl}/network/index`, {
            params:{
                all: 1,
                q: query
              }
          });
    },
    postRemoveNetwork(data){
        return axios.delete(`${baseUrl}/network/destroy/${data.id}`);
    },
    postUpdateNetwork(data){
        return axios.put(`${baseUrl}/network/update/${data.id}`,data);
    },
    postAddNetwork(data){
        return axios.post(`${baseUrl}/network/store`,data)
    },
    getPaymentMethods(page = 1){
        return axios.get(`${baseUrl}/payment-method/index`, {
            params:{
                page: page,
                limit: 10,
            }
            });
    },
    getSearchPaymentMethods(query){
        return axios.get(`${baseUrl}/payment-method/index`, {
            params:{
                all: 1,
                q: query
                }
            });
    },
    postRemovePaymentMethod(data){
        return axios.delete(`${baseUrl}/payment-method/destroy/${data.id}`);
    },
    postUpdatePaymentMethod(data){
        return axios.put(`${baseUrl}/payment-method/update/${data.id}`,data);
    },
    postAddPaymentMethod(data){
        return axios.post(`${baseUrl}/payment-method/store`,data)
    },
    getPayments(page = 1){
    return axios.get(`${baseUrl}/payment/index`, {
        params:{
            page: page,
            limit: 10,
        }
        });
    },
    getSearchPayments(query){
        return axios.get(`${baseUrl}/payment/index`, {
            params:{
                all: 1,
                q: query
                }
            });
    },
    postRemovePayment(data){
        return axios.delete(`${baseUrl}/payment/destroy/${data.id}`);
    },
    postUpdatePayment(data){
        return axios.put(`${baseUrl}/payment/update/${data.id}`,data);
    },
    postAddPayment(data){
        return axios.post(`${baseUrl}/payment/store`,data)
    },
    getWatchlist(page = 1){
      return axios.get(`${baseUrl}/watchlist/index`, {
          params:{
            page: page,
            limit: 10,
          }
        });
    },
    getAds(page = 1){
      return axios.get(`${baseUrl}/ads/index`, {
          params:{
            page: page,
            limit: 10,
          }
        });
    },
    postSaveAds(data){
      return axios.post(`${baseUrl}/ads/store`,data,{
        headers: {
          'Content-Type': 'multipart/form-data',
        },
      })
    },
    updateAds(id,data){
      return axios.post(`${baseUrl}/ads/update/${id}`,data,{
        headers: {
          'Content-Type': 'multipart/form-data',
        },
      })
    },
    updateActiveAds(data){
      return axios.put(`${baseUrl}/ads/update-active/${data.id}`,data);
    },
    deleteAds(data){
      return axios.delete(`${baseUrl}/ads/destroy/${data.id}`);
    },
    getSearchAds(query){
      return axios.get(`${baseUrl}/ads/index`, {
          params:{
            all: 1,
            q: query
          }
        });
    },
    getSearchWatchlist(query){
      return axios.get(`${baseUrl}/watchlist/index`, {
          params:{
            all: 1,
            q: query
          }
        });
    },
    getSearchUsers(query){
      return axios.get(`${baseUrl}/user/index`, {
          params:{
            all: 1,
            q: query
          }
        });
    },
    postSubmitUser(data){
        return axios.post(`${baseUrl}/user/store`,data)
      },
    getSettings(){
      return axios.get(`${baseUrl}/setting/index`, {
          params:{
            all: 1
          }
        });
    },
    saveSetting(setting){
      return axios.put(`${baseUrl}/setting/update/${setting.id}`, {
            'value' : setting.value
        });
    },
    saveImageSetting(id,data){
      return axios.post(`${baseUrl}/setting/update/${id}`,data,{
        headers: {
          'Content-Type': 'multipart/form-data',
        },
      })
    },
    postSubmitCoin(formData){
      return axios.post(`${baseUrl}/coin/store`,formData,{
        headers: {
          'Content-Type': 'multipart/form-data',
        },
      })
    },
    updateCoin(coin){
      return axios.put(`${baseUrl}/coin/update/${coin.id}`, coin);
    },
    deleteCoin(coin){
      return axios.delete(`${baseUrl}/coin/destroy/${coin.id}`);
    },
    updateUser(data){
      return axios.put(`${baseUrl}/user/update/${data.id}`, data);
    },
    postRemoveUser(data){
        return axios.delete(`${baseUrl}/user/destroy/${data.id}`);
    },
    deleteWatchlist(id){
      return axios.delete(`${baseUrl}/watchlist/delete/${id}`);
    },
    postAddToWatch(coinId){
      return axios.post(`${baseUrl}/watchlist/store`,{
        coin_id: coinId
      })
    },
    postAddToVote(coinId){
      return axios.post(`${baseUrl}/coin/vote`,{
        coin_id: coinId
      })
    },
    postRemoveFromWatch(coinId){
      return axios.delete(`${baseUrl}/watchlist/destroy/${coinId}`)
    }
}

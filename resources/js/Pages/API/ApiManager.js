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
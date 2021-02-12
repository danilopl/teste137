import  {createApp}  from 'vue'
import VueSimpleAlert from "vue-simple-alert";

import App from './App.vue'
import axios from 'axios'
import router from './router'
import auth from '@/auth'
import 'bulma/css/bulma.css';


axios.defaults.baseURL = 'http://backend.local'

axios.interceptors.request.use(config => {
    config.headers.get['Accept'] = 'application/json';
    config.headers.post['Accept'] = 'application/json';

    if(auth.has()) {
      config.headers.Authorization = auth.getToken();
    }
    return config
  })
  
axios.interceptors.response.use(res => {
      return res
    }, error => {
      if(error.response && 422 === error.response.status){
        let err = error.response.data;
        var result = "";
        //result += err.message
        for(var k in err.errors) {
          let input = err.errors[k];
          for(var i in input) {
            result += "\n"+input[i]
          }
        }
        alert(result);
      }else if(error.response && 401 === error.response.status){
        let err = error.response.data;
        var result = "";
        result += err.message
        alert(result);
      }else if(error.response && 403 === error.response.status){
        let err = error.response.data;
        var result = "";
        result += err.error
        alert(result);          
      }else{
        throw error
      }
  })
createApp(App).use(router).mount('#app')
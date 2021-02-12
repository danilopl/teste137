import axios from 'axios'

export const auth = {
  login(data) {
    localStorage.setItem('authorization',
      JSON.stringify({ token: 'Bearer ' + data.access_token, user: data.user })
    );
  },
  has(){
    return localStorage.getItem('authorization') ? true : false;
  },
  getToken(){
    if(this.has()){
      let authorization = JSON.parse(localStorage.getItem('authorization'));
      return authorization.token;
    }
  },
  getUser(){
    if(this.has()){
      let authorization = JSON.parse(localStorage.getItem('authorization'));
      return authorization.user;
    }
  },
  updateUser(){
    if(this.has()){
      axios
        .get('http://backend.local/api/user')
        .then(function (response) {
          let authorization = JSON.parse(localStorage.getItem('authorization'));
          authorization.user = response.data;
          localStorage.setItem('authorization',JSON.stringify(authorization));
        });
    }
  },
  isAdmin(){
    return this.has() && auth.getUser().administrador == 1 ? true : false
  },
  logout() {
    if(this.has()){
      axios
      .get('http://backend.local/api/auth/logout')
      .then((response) => {
          localStorage.removeItem('authorization')
      });
    }
  },
};

export default auth
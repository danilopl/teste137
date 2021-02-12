import moment from 'moment'

export const search = {
  originData: {},
  data: [],
  params: [],
  load(data) {
    this.originData = data;

    this.data = data;
    const user = this.getParamUserName()[0];
    const paramSearch = {user_name:user};
  },
  getParamUserName(){
    const all = []
    this.data.forEach((item,i) => {
      if(all.indexOf(item.user_name) == -1)
        all.push(item.user_name);
    });
    return all;
  },
  createParamCreatedAt(){
    const all = {
      min: moment(this.filterByIndice(0).created_at).format('YYYY-MM-DD'),
      max: moment(this.filterByIndice((this.data.length-1)).created_at).format('YYYY-MM-DD')
    }
    return all;
  },
  filterByIndice(indx){
    return this.data.find( (element, indice)=> {return indice == indx ? element : false});
  },
  filter(key, value) {
    if(key && value){
      this.data = this.data.filter( item => {return item[key] == value})
    }
    return this.data;
  },
  filterByCreatedAt(value) {
    if(value){
      this.data = this.data.filter( item => {return moment(item.created_at).format('YYYY-MM-DD') == value})
    }
    return this.data;
  },
  reset(){
    this.data = this.originData;
  },
  list() {
    return this.data;
  }
};

export default search
import {reactive} from 'vue';
export const store = reactive ({


  apiHostUrl : 'http://127.0.0.1:8000/api',
  getTpartments : '/apartment',
  apartmentsGetted: [{app: 1}],

  ttKey:  import.meta.env.VUE_APP_API_TT_KEY,



})

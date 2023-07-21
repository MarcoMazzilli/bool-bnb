import {reactive} from 'vue';
import config from './config';

export const store = reactive ({
  apiKey : config.apiKey,

  apiHostUrl : 'http://127.0.0.1:8000/api',
  getTpartments : '/apartment',
  apartmentsGetted: [],
  apartmentsfiltred: [],
  apartmentDetails : null,

  // ttKey:  import.meta.env.VUE_APP_API_TT_KEY,

  cord: [],



})

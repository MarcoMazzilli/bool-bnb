import {reactive} from 'vue';
import config from './config';

export const store = reactive ({
  apiKey : config.apiKey,

<<<<<<< HEAD
=======
  apiKey: 'jueyGuBdZC5ZfKAoBli2qlOzAl3jDFdS',
>>>>>>> 3e68236045dcb724408ea9f66a22d87bc2a0e94a
  apiHostUrl : 'http://127.0.0.1:8000/api',
  getTpartments : '/apartment',
  apartmentsGetted: [],
  apartmentsfiltred: [],

  // ttKey:  import.meta.env.VUE_APP_API_TT_KEY,

  cord: [],



})

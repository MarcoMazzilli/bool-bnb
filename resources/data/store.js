import {reactive} from 'vue';
import config from './config';

export const store = reactive ({
  apiKey : config.apiKey,

  apiHostUrl : 'http://127.0.0.1:8000/api',
  getTpartments : '/apartment',







  // home page------------
  apartmentsGetted: [],
  homeStored: false,

  // search page
  apartmentsfiltred: [],
  services:['Piscina', 'Piscina', 'Piscina','Piscina','Piscina','Piscina','Piscina','Piscina',
            'Piscina', 'Piscina','Piscina','Piscina','Piscina','Piscina','Piscina','Piscina',
            'Piscina', 'Piscina','Piscina','Piscina','Piscina','Piscina','Piscina'
          ],

  // ttKey:  import.meta.env.VUE_APP_API_TT_KEY,

  cord: [],



})

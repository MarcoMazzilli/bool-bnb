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
  services:[
            'Piscina','Parcheggio gratuito nella proprietà','Cucina','Wi-Fi',
            'Lavatrice','Aria condizionata','Rilevatore di   monossido di carbonio',
            'Animali domestici ammessi','Asciugatrice','Telecamere di sicurezza presenti nella proprietà',
            'Riscaldamento','Griglia per barbecue','TV','Sauna','Lavastoviglie','Palestra','Spazio di lavoro dedicato'
          ],

  // ttKey:  import.meta.env.VUE_APP_API_TT_KEY,

  cord: [],



})

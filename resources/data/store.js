import {reactive} from 'vue';
import config from './config';

export const store = reactive ({
  apiKey : config.apiKey,

  apiHostUrl : 'http://127.0.0.1:8000/api',
  getTpartments : '/apartment',

  TomtomBaseUrl:'https://api.tomtom.com/',
  apiUrlSearchAddress: 'search/2/geocode/',
  queryType: '.json?typeahead=false&limit=1&view=Unified&key=',






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

  cord: false,
  newCenter: [],
  fakePoints: [
    [12.46341, 41.90575 ],
    [12.52818, 41.87445],
    [12.52818, 41.87445 ],
    [12.60374, 41.83681  ],
    [12.61035, 41.84173 ],
    [12.44107, 41.77731 ],
    [12.50371, 41.8923  ],
    [12.46314, 41.86185 ],
    [12.49568, 41.86708 ],
    [12.51686, 41.9107 ],
  ]



})

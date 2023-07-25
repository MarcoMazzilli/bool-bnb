import {reactive} from 'vue';
import config2 from './config2';

export const store = reactive ({
  apiKey : config2.apiKey,

  apiHostUrl : 'http://127.0.0.1:8000/api',
  getTpartments : '/apartment',
  findLocation: '/find/location',
  findServices: '/find/services',


  TomtomBaseUrl:'https://api.tomtom.com/',
  apiUrlSearchAddress: 'search/2/geocode/',
  queryType: '.json?typeahead=false&limit=1&view=Unified&key=',






  // home page------------
  apartmentsGetted: [],
  homeStored: false,
  apartmentDetails : null,
  // search page ---------------------------------------------------\
  pagination : {
    current_page: false,
    first_page_url: false,
    last_page_url: false,
    links: [],
    next_page_url: false,
    prev_page_url:false,
    total:false,
  },
  apartmentsfiltred: [],
  services:[
            'Piscina','Parcheggio gratuito nella proprietà','Cucina','Wi-Fi',
            'Lavatrice','Aria condizionata','Rilevatore di   monossido di carbonio',
            'Animali domestici ammessi','Asciugatrice','Telecamere di sicurezza presenti nella proprietà',
            'Riscaldamento','Griglia per barbecue','TV','Sauna','Lavastoviglie','Palestra','Spazio di lavoro dedicato'
          ],


  cord: false,
  newCenter: [],
  fakePoints: [
    [12.46341, 41.90575 ],
  ],

  load : false,

  advSrcRequest: {

    type: 'adv', //or drv
    // priceRange: [20,160],
    radius: 20,
    size: 15,
    rooms: 1,
    beds: 1,
    bathrooms: 1,
    servicesChecked: [false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,],
    services: [],
    longitude : false,
    latitude : false,
    coord:[
      [ 11.166504901180673, 43.74673562381395  ],
      [ 11.160517660159542, 43.72833625965026  ],
      [ 11.255282317736459, 43.703600113836075 ],
      [ 11.286793397171635, 43.7591431626044   ],
      [ 11.185512700570968, 43.77460258943185  ],
      [ 11.174559844226877, 43.767117547831674 ],
      [ 11.166504901180673, 43.74673562381395  ],
    ]

  },


  // search page ---------------------------------------------------/

  RomaRequest: {

    type: 'adv', //or drv
    // priceRange: [20,160],
    radius: 30,
    size: 15,
    rooms: 1,
    beds: 1,
    bathrooms: 1,
    services: [],
    longitude : 12.49427,
    latitude : 41.89056,
    coord:[[]]
  },

  MilanoRequest: {

    type: 'adv', //or drv
    // priceRange: [20,160],
    radius: 30,
    size: 15,
    rooms: 1,
    beds: 1,
    bathrooms: 1,
    services: [],
    longitude : 9.18812,
    latitude : 45.46362,
    coord:[[]]
  },

  NapoliRequest: {

    type: 'adv', //or drv
    // priceRange: [20,160],
    radius: 30,
    size: 15,
    rooms: 1,
    beds: 1,
    bathrooms: 1,
    services: [],
    longitude : 14.25254,
    latitude : 	40.83998,
    coord:[ []]
  },

  RiminiRequest: {

    type: 'adv', //or drv
    // priceRange: [20,160],
    radius: 30,
    size: 15,
    rooms: 1,
    beds: 1,
    bathrooms: 1,
    services: [],
    longitude : 12.5663,
    latitude : 44.06092,
    coord:[[]]
  },

  FirenzeRequest: {

    type: 'adv', //or drv
    // priceRange: [20,160],
    radius: 30,
    size: 15,
    rooms: 1,
    beds: 1,
    bathrooms: 1,
    services: [],
    longitude : 11.25693,
    latitude : 43.7687,
    coord:[[]]
  },
})



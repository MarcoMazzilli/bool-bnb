import {reactive} from 'vue';
import config2 from './config2';

export const store = reactive ({
  apiKey : config2.apiKey,

  apiHostUrl : 'http://127.0.0.1:8000/api',
  getTpartments : '/apartment',
  findLocation: '/find/location',
  findServices: '/find/services',
  findPerimeter: '/find/perimeter',


  TomtomBaseUrl:'https://api.tomtom.com/',
  apiUrlSearchAddress: 'search/2/geocode/',
  queryType: '.json?typeahead=false&limit=1&view=Unified&key=',


  // home page------------
  apartmentsGetted: [],
  homeStored: false,
  apartmentDetails : null,
  // search page ---------------------------------------------------\
  searchMessage:'risultati',

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
  mapCoord: false, // <---
  servicesChecked: [false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false],
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
    services: [],
    longitude : false,
    latitude : false,
    coord: false,
    address: false,

  },

  lastRequest : false,


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
    coord:[[]],
    address: 'Roma',
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
    coord:[[]],
    address: 'Milano',
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
    coord:[[]],
    address: 'Napoli',
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
    coord:[[]],
    address: 'Rimini',
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
    coord:[[]],
    address: 'Firenze',
  },
})



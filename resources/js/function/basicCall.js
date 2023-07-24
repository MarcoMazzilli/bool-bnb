import {store} from '../../data/store';
import axios from 'axios';
export {getCordianates, requestCompiler, findServices,  searchByRange};




function  searchByRange(data){
  store.load = false;

  axios.post('http://127.0.0.1:8000/api/find/location', data)
  .then(result =>{
    console.log('risultato ===>',result);
    store.apartmentsfiltred = result.data.apartments.data
    store.load = true;

  }).catch(error => {
    console.log('Errori ===>',error)
  })
}

function getCordianates(addres){


  // -------- chiamata
  axios.get(store.TomtomBaseUrl + store.apiUrlSearchAddress + convertAddress(addres) + store.queryType + store.apiKey)
  .then(result =>{

    const cordinates = result.data.results[0].position;

    const jsonLink = store.TomtomBaseUrl + store.apiUrlSearchAddress + convertAddress(addres) + store.queryType + store.apiKey;

    console.log('cordinate ottenute:', [cordinates.lon , cordinates.lat], 'jsonLink:', jsonLink );

    store.newCenter = [cordinates.lon , cordinates.lat];
  })
}

function  convertAddress(address){
    const converted = address.replace(/ /g,'%20') ;
    // console.log(converted);
    return converted;
}


function findServices(data){
  store.load = false;
  // -------- chiamata
  axios.post(store.apiHostUrl + store.findServices , data)
  .then(result =>{
    console.log('risultato ===>',result.data.apartments);
    store.apartmentsfiltred = result.data.apartments;
    store.load = true;
  })
  .catch(error => { console.log(store.apiHostUrl + store.findServices )})
}



// ----------------adv search call
function requestCompiler(){


}
// ----------------adv search call

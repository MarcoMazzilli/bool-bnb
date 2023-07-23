import {store} from '../../data/store';
import axios from 'axios';
export {getCordianates, requestCompiler};



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

// ----------------adv search call
function requestCompiler(){


}
// ----------------adv search call

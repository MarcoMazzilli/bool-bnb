import {store} from '../../data/store';
import axios from 'axios';
export {advancedSearch, navigateApartmentResults, getCordianates, compileServiceIndex, findServices,  searchByRange, getMarkers, convertAddress};




function advancedSearch(){
  if(store.advSrcRequest.type === 'adv'){
    // service ricerca avanzata -------------------------
    compileServiceIndex();
    console.log('request state :', store.advSrcRequest );
    searchByRange( store.advSrcRequest );

  }else if(store.advSrcRequest.type === 'drv'){
    // service ricerca avanzata -------------------------


  }else if(store.advSrcRequest.type = 'srv-only'){
    // service only search -------------------------
    store.advSrcRequest.coord = [[store.cord]]
    compileServiceIndex();
    console.log('solo servizi', store.advSrcRequest );
    findServices(store.advSrcRequest);
  }

}


function searchByRange(data){
  console.warn('src by range')
  store.load = false;
  store.lastRequest = JSON.parse(JSON.stringify(store.advSrcRequest));
  console.log('search store.lastRequest', store.lastRequest );
  axios.post(store.apiHostUrl + store.findLocation, data)
  .then(result =>{
    console.log('risultato ===>',result.data);
    store.apartmentsfiltred = result.data.apartments.data;

    store.pagination.current_page = result.data.apartments.current_page;
    store.pagination.first_page_url = result.data.apartments.first_page_url;
    store.pagination.last_page_url = result.data.apartments.last_page_url;
    store.pagination.links = result.data.apartments.links;
    store.pagination.total = result.data.apartments.total;
    store.pagination.next_page_url = result.data.apartments.next_page_url;
    store.pagination.prev_page_url = result.data.apartments.prev_page_url;

    console.warn('store.pagination', store.pagination);
    store.load = true;
  }).catch(error => {
    console.log('Errori ===>',error)
  })
}

function navigateApartmentResults(url){
  store.load = false;
  console.log('paginate store.lastRequest', url , store.lastRequest )
  axios.post(url,  store.lastRequest )
    .then(result =>{

      store.apartmentsfiltred = result.data.apartments.data;

      store.pagination.current_page = result.data.apartments.current_page;
      store.pagination.first_page_url = result.data.apartments.first_page_url;
      store.pagination.last_page_url = result.data.apartments.last_page_url;
      store.pagination.links = result.data.apartments.links;
      store.pagination.total = result.data.apartments.total;
      store.pagination.next_page_url = result.data.apartments.next_page_url;
      store.pagination.prev_page_url = result.data.apartments.prev_page_url;

      store.load = true;
  })
  }

function findServices(data){
  store.load = false;
  store.lastRequest = JSON.parse(JSON.stringify(store.advSrcRequest));
  console.log('search store.lastRequest', store.lastRequest );
  axios.post(store.apiHostUrl + store.findServices , data)
  .then(result =>{
    console.log('risultato ===>',result.data.apartments);
    store.apartmentsfiltred = result.data.apartments.data;

    store.pagination.current_page = result.data.apartments.current_page;
    store.pagination.first_page_url = result.data.apartments.first_page_url;
    store.pagination.last_page_url = result.data.apartments.last_page_url;
    store.pagination.links = result.data.apartments.links;
    store.pagination.total = result.data.apartments.total;
    store.pagination.next_page_url = result.data.apartments.next_page_url;
    store.pagination.prev_page_url = result.data.apartments.prev_page_url;

    store.load = true;
  })
  .catch(error => { console.log(store.apiHostUrl + store.findServices )})
}

function getMarkers(){
  axios.get('http://127.0.0.1:8000/api/apartment/markers')
  .then(result =>{
    console.log('risultato ===>',result.data.coordinates);
    store.fakePoints = result.data.coordinates;
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

function  compileServiceIndex(){
  store.advSrcRequest.longitude = store.mapCoord[0];
  store.advSrcRequest.latitude = store.mapCoord[1];
  console.log('request state:', store.advSrcRequest);
  store.advSrcRequest.coord = [[store.mapCoord]];
  store.advSrcRequest.services = [];
  store.servicesChecked.forEach((element, key) => {
    if(element){
      store.advSrcRequest.services.push(key + 1);
      // console.log(key, element , store.advSrcRequest.services);
    }
  });
}


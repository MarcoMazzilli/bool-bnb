<script>
import {store} from '../../data/store';
import tt from '@tomtom-international/web-sdk-maps';
import axios from 'axios';

export default {
    name: 'Apartment',

    data(){
        return{
          apartment : store.apartmentDetails,
          author_first_name: "",
          author_last_name: "",
          author_email: "",
          apartment_id: '',
          text: "",
          object:'',
          errors : {},
          success : false,
          sending : false
        }
    },
    components:{},
    methods :{
      getImage(img){
        return new URL ()
      },
      sendMail(){
        this.sending = true

        const data = {
          author_first_name: this.author_first_name,
          author_last_name: this.author_last_name,
          author_email: this.author_email,
          text: this.text,
          apartment_id : this.apartment.id,
          object : this.object
        }
        sending :false

        axios.post(store.apiHostUrl +'/contacts',data)
        .then(result => {
          this.sending = false
          this.success = result.data.success
          console.log('datacompilato->',data)
          console.log('log->',result.data)

          if (result.data.success) {
            this.errors = {};
          }else{
            this.errors = result.data.errors;
          }
          // setTimeout(() => {
          //   this.success = false;
          //   this.author_first_name = '';
          //   this.author_last_name = '';
          //   this.senders_email = '';
          //   this.message = '';
          // }, 10000);

        })
      },
      // tomtom map----------------------------------------------------------------\

      initializeMap() {
        store.advSrcRequest.type='adv';
        // se arrivi direttamente in advanced search allora centra la mappa su Roma
        // if(store.advSrcRequest.radius === '?'){
        //   store.advSrcRequest.radius = 20;
        // }

        // if(!store.mapCoord){
        //   store.mapCoord = [12.49427, 41.89056];
        //   console.warn('centro mappa mancante')
        // }

        // reset dom---
        const mapDiv = document.getElementById('map');
        mapDiv.innerHTML = '';

        // inizializza mappa
        map = tt.map({
        key: store.apiKey,
        container: 'map',
        center: [ store.apartmentDetails.longitude, store.apartmentDetails.latitude,],
        zoom: 9,
        pitch: true, // Abilita l'animazione --- D: ...ma non funziona!!! :(
        animate: true, // nada--- :'(
        });

        map.addControl(new tt.FullscreenControl());
        map.addControl(new tt.NavigationControl());

        map.on('load', () => {
            new tt.Marker().setLngLat([store.apartmentDetails.longitude, store.apartmentDetails.latitude]).addTo(map);
        });
      },

    },
    mounted(){
      console.log('whereIam?', this.$route.name );
      console.log(store.apartmentDetails );
      this.initializeMap();
    }
}
</script>

<template>
    <div class="container py-3" id="apartment-page">

      <!--Titolo -->
      <div class="py-2">
        <h4>{{ apartment.name }}</h4>
        <span><i class="fa-solid fa-star"></i> 5,0</span>
        <span class="card-text mx-2"><b>{{ apartment.address }}</b></span>
      </div>

      <div class="apartment_top " >

        <!-- Immagine -->

          <img :src="'/storage/' + apartment.cover_image" alt="">

        <!-- mappa -->
        <div class="mapping">
          <div id="mountMap" class="w-100 h-100">
              <div class="map w-100 h-100" id="map" ref="mapRef">MAPPA</div>
          </div>
        </div>

      </div>

      <!-- Testo -->
      <div class="info py-4">

        <div v-show="apartment.address_info">

          <h5>{{ apartment.name }}</h5>
          <div class="" role="alert">

            <p>{{ apartment.description }}</p>
            <p>{{ apartment.address_info }}</p>

          </div>

        </div>

        <h5>Informazioni aggiuntive</h5>
        <div class="row row-cols-2 row-cols-md-3 mb-3">
          <div class="col my-2 ">
            Tipologia: {{ apartment.type }} <i class="fa-solid fa-house"></i>
          </div>
          <!-- <div class="col my-2">
            Descrizione: {{ apartment.description }}
          </div> -->
          <div class="col my-2">
            Grendezza del locale: {{ apartment.apartment_size }} m2
          </div>
          <div class="col my-2">
            Numeri di letti: {{ apartment.n_of_bed }} <i class="fa-solid fa-bed"></i>
          </div>
          <div class="col my-2">
            Camere: {{ apartment.n_of_room }}
          </div>
          <div class="col my-2">
            Numeri di bagni: {{ apartment.n_of_bathroom }} <i class="fa-solid fa-bath"></i>
          </div>
          <div class="col my-2">
            Prezzo: <b>{{ apartment.price }} €</b> a notte
          </div>
        </div>

        <h5>Servizi offerti</h5>
        <span v-for="(service, index) in apartment.services" :key="index" class="badge mx-1">{{ service.name }}</span>

      </div>


      <!-- FORM CONTATTO HOST  -->

      <form v-if="!success" class="row" @submit.prevent="sendMail()">
        <h2>Invia un messaggio all'host</h2>

        <div class="col col-12 col-md-4 mb-3">
          <label for="author_first_name" class="form-label">Nome</label>
          <input v-model.trim="author_first_name" type="text" class="form-control" :class="{'is-invalid' : errors.first_name }" id="author_first_name" placeholder="Inserisci il nome">
          <p v-for="(error,index) in errors.author_first_name" :key="index" class="text-danger">{{ error }}</p>
        </div>

        <div class="col col-12 col-md-4 mb-3">
          <label for="author_last_name" class="form-label">Cognome</label>
          <input v-model.trim="author_last_name" type="text" class="form-control" :class="{'is-invalid' : errors.author_last_name }" id="author_last_name" placeholder="Inserisci il cognome">
          <p v-for="(error,index) in errors.author_last_name" :key="index" class="text-danger">{{ error }}</p>
        </div>

        <div class="col col-12 col-md-4 mb-3">
          <label for="author_email" class="form-label">Indirizzo email</label>
          <input v-model.trim="author_email" type="email" class="form-control" :class="{'is-invalid' : errors.author_email }" id="author_email" placeholder="Inserisci la tua email">
          <p v-for="(error,index) in errors.author_email" :key="index" class="text-danger">{{ error }}</p>
        </div>

        <div class="col col-12 mb-3">
          <label for="object" class="form-label">Oggetto del messaggio</label>
          <input v-model.trim="object" type="text" class="form-control" :class="{'is-invalid' : errors.author_email }" id="object" placeholder="Oggetto del messaggio">
          <p v-for="(error,index) in errors.object" :key="index" class="text-danger">{{ error }}</p>
        </div>

        <div class="mb-3">
          <label for="text" class="form-label">Messaggio</label>
          <textarea v-model.trim="text" class="form-control" :class="{'is-invalid' : errors.text }" placeholder="Inserisci un messaggio" id="text" rows="3"></textarea>
          <p v-for="(error,index) in errors.text" :key="index" class="text-danger">{{ error }}</p>
        </div>

        <div class="col-auto">
          <button type="submit" :disabled="sending" class="btn btn-primary mb-3">{{ sending ? 'Invio in corso' : 'Invia messaggio' }}</button>
        </div>
      </form>

      <div v-else class="p-4 shadow">
        <div>
          <h2>Il messaggio è stato inviato correttamente!</h2>
        </div>
      </div>

    </div>
</template>

<style lang="scss" scoped>
@use '../../scss/var' as *;

.apartment_top{
  display: flex;
  flex-direction: column;
}

.mapping{
  margin-top: 20px;
  width: 100%;
  height: 150px;
}

img{
    display: inline-block;
    object-fit: cover;
    width: 100%;
    height: auto;
}

h5{
  color: $brand-main;
  font-weight: bold;
}

span.badge{
  background-color: $brand-blue;
}

@media screen and (min-width: 768px) {
  .apartment_top{
  display: flex;
  justify-content: space-between;
  flex-direction: row;
  height: 400px;
}
img{
    display: inline-block;
    object-fit: cover;
    width: 60%;
    height: auto;
}
.mapping{
  margin-top: 0px;
  width: 38%;
  height: 100%;
}
}
@media screen and (min-width: 992px) {

}
@media screen and (min-width: 1200px) {
  img{
    display: inline-block;
    object-fit: cover;
    width: 68%;
    height: auto;
}
.mapping{
  margin-top: 0px;
  width: 30%;
  height: 100%;
}

}
</style>

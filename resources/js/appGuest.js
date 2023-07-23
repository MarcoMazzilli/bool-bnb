import { createApp } from 'vue';
import App from './App.vue';
import { router } from './routes/router';
import "/node_modules/@tomtom-international/web-sdk-maps/dist/maps.css";
import "/node_modules/@tomtom-international/web-sdk-plugin-drawingtools/dist/DrawingTools.css";

createApp(App).use(router).mount('#app')

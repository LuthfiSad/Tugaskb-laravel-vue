// App
import { createApp } from 'vue'
import App from '@/src/App.vue'
import router from '@/router/index.js'
import axios from 'axios';
import Swal from 'sweetalert2'
// axios.defaults.withCredentials = true;
axios.defaults.baseURL = assetUrl+'api/';
// console.log(axios.defaults.baseURL);
window.axios = axios;
window.Swal = Swal;
import "../../public/assets/vendors/owl-carousel/css/owl.carousel.min.css";
import "../../public/assets/vendors/owl-carousel/css/owl.theme.default.css";
import "../../public/assets/vendors/mdi/css/materialdesignicons.min.css";
import "../../public/assets/vendors/aos/css/aos.css";
import "../../public/assets/css/style.min.css";
// <!-- Ninestars -->
// <!-- Template Main CSS File -->
import "../../public/assets/ninestars/assets/css/style.css";
{/* <!-- Tutup Ninestars --> */ }

{/* <!-- AVILON --> */ }
{/* <!-- Template Main CSS File --> */ }
import "../../public/assets/avilon/assets/css/style.css";
{/* <!-- Tutup AVILON --> */ }

const data = localStorage.getItem('data');
const token = data ? JSON.parse(data).token : null;
window.addEventListener('storage', async (event) => {
    // alert(token);
    if (event.key === 'data' && event.newValue === null) {
        await axios.post("/logout", null, {
            headers: {
                Authorization: `Bearer ${token}`,
            },
        });
    }
    window.location.reload(); // Refresh halaman jika local storage 'data' dihapus
});
const app = createApp(App)
app.provide('assetUrl', assetUrl);
app.use(router)
app.mount('#app')
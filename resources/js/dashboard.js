// Dashboard
import { createApp } from 'vue'
import Dashboard from '@/src/Admin.vue'
import router from '@/router/dashboard.js'
import axios from 'axios';
import Swal from 'sweetalert2'
import { QuillEditor } from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css';
import { setupCalendar, Calendar, DatePicker } from 'v-calendar';
import 'v-calendar/style.css';
import DataTable from 'datatables.net-vue3';
import DataTablesCore from 'datatables.net-bs5';
axios.defaults.baseURL = assetUrl+'api/';
window.axios = axios;
window.Swal = Swal;

const data = localStorage.getItem('data');
const token = data ? JSON.parse(data).token : null;
const login = data ? JSON.parse(data).login : null;
window.addEventListener('storage', async (event) => {
  if (event.key === 'data' && event.newValue === null) {
    await axios.post("/logout", null, {
      headers: {
        Authorization: `Bearer ${token}`,
      },
    });
  }
  window.location.reload(); // Refresh halaman jika local storage 'data' dihapus
  // alert(token);
});
// console.log('pa');
if (token && login === true) {
  axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
  const userPromise = axios.get("user"); // Buat Promise untuk request user data

  userPromise
    .then((response) => {
      DataTable.use(DataTablesCore);
      // console.log(response.data.name);
      const dashboard = createApp(Dashboard);
      dashboard.use(router);
      dashboard.use(setupCalendar, {});
      dashboard.component('VCalendar', Calendar);
      dashboard.component('VDatePicker', DatePicker);
      dashboard.component('QuillEditor', QuillEditor);
      dashboard.component('DataTable', DataTable);
      dashboard.provide('nameUser', response.data.name);
      dashboard.mount('#dashboard');
    })
    .catch((error) => {
      console.log(error);
      Swal.fire({
        title: 'User Tidak Valid',
        icon: 'warning',
      }).then(() => {
        const data = localStorage.getItem('data');
        if(data){
          localStorage.removeItem('data');
        }
        window.location.href = '/login';
      });
    });
} else {
  if(data){
    localStorage.removeItem('data');
  }
  Swal.fire({
    title: 'Anda Belum Login',
    icon: 'warning',
  }).then(() => {
    window.location.href = '/login';
  });
}



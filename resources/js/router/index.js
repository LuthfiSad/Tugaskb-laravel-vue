import { createRouter, createWebHistory } from "vue-router";
import User from "@/src/User.vue";
import Home from "@/views/Home.vue";
import Tentang from "@/views/Tentang.vue";
import Sharing from "@/views/Sharing.vue";
import Tutorial from "@/views/Tutorial.vue";
import Acara from "@/views/Acara.vue";
import DetailAcara from "@/views/Detail.vue";
import Klinik from "@/views/Klinik.vue";
import Artikel from "@/views/Artikel.vue";
import DetailArtikel from "@/views/Detail.vue";
import Auth from "@/src/Auth.vue";
import Login from "@/views/Auth/Login.vue";
import Registrasi from "@/views/Auth/Registrasi.vue";


const router = createRouter({
  history: createWebHistory(),
  routes: [
    {
      path: "",
      component: User,
      redirect: "home",
      children: [
        {
          path: "/home",
          name: "Home",
          component: Home,
        },
        {
          path: "/tentang",
          name: "Tentang",
          component: Tentang,
        },
        {
          path: "/sharing",
          name: "Sharing",
          component: Sharing,
        },
        {
          path: "/tutorial",
          name: "Tutorial",
          component: Tutorial,
        },
        {
          path: "/acara",
          name: "Acara",
          component: Acara,
        },
        {
          path: "/acara/detail/:id",
          name: "DetailAcara",
          component: DetailAcara,
        },
        {
          path: "/klinik",
          name: "Klinik",
          component: Klinik,
        },
        {
          path: "/artikel",
          name: "Artikel",
          component: Artikel,
        },
        {
          path: "/artikel/detail/:id",
          name: "DetailArtikel",
          component: DetailArtikel,
        },
      ],
    },
    {
      path: "/",
      component: Auth,
      children: [
        {
          path: "login",
          name: "Login",
          component: Login,
        },
        {
          path: "registrasi",
          name: "Registrasi",
          component: Registrasi,
        },
      ]
    },
    {
      path: '/:catchAll(.*)',
      redirect: '/home',
    },
    {
      path: '/dashboard',
      redirect: ()=>{
        window.location.href = '/dashboard';
      },
    },
  ],
  linkActiveClass: 'active',
});

router.beforeEach(async (to, from, next) => {
  const data = localStorage.getItem('data');
  const token = data ? JSON.parse(data).token : null;
  const login = data ? JSON.parse(data).login : null;
  if(token && login === true){
    if(to.name === 'Login' || to.name == 'Registrasi'){
      await Swal.fire({
        title: 'Anda Sudah Login',
        icon: 'warning',
      });
      next('/dashboard')
    }
  }
  // console.log(to.name === 'Login' || to.name == 'Registrasi');
  // console.log(from.name);
  // console.log(token && login === true)

  if(to.name == "Login" || to.name == "Registrasi"){
    document.title = "Auth" + " - " + to.name;
  } else {
    document.title = "HIMTI" + " - " + to.name;
  }

  // Setelah komponen rute diperbarui, scroll halaman ke paling atas
  window.scrollTo({
    top: 0,
    behavior: 'smooth'
  });

  // Teruskan ke route berikutnya
  next();
});

export default router;

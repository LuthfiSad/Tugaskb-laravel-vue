import { createRouter, createWebHistory } from "vue-router";
import Dashboard from "@/views/Dashboard/Dashboard.vue";
import Anggota from "@/views/Dashboard/Anggota.vue";
import IndexAnggota from "@/views/Dashboard/Letter/Anggota/Index.vue";
import CreateAnggota from "@/views/Dashboard/Letter/Anggota/Create.vue";
import EditAnggota from "@/views/Dashboard/Letter/Anggota/Edit.vue";
import Acara from "@/views/Dashboard/Acara.vue";
import IndexAcara from "@/views/Dashboard/Letter/Acara/Index.vue";
import DetailAcara from "@/views/Dashboard/Letter/Detail.vue";
import CreateAcara from "@/views/Dashboard/Letter/Acara/Create.vue";
import EditAcara from "@/views/Dashboard/Letter/Acara/Edit.vue";
import Artikel from "@/views/Dashboard/Artikel.vue";
import IndexArtikel from "@/views/Dashboard/Letter/Artikel/Index.vue";
import DetailArtikel from "@/views/Dashboard/Letter/Detail.vue";
import CreateArtikel from "@/views/Dashboard/Letter/Artikel/Create.vue";
import EditArtikel from "@/views/Dashboard/Letter/Artikel/Edit.vue";
import Sharing from "@/views/Dashboard/Sharing.vue";
import IndexSharing from "@/views/Dashboard/Letter/Sharing/Index.vue";
import DetailSharing from "@/views/Dashboard/Letter/Detail.vue";
import CreateSharing from "@/views/Dashboard/Letter/Sharing/Create.vue";
import EditSharing from "@/views/Dashboard/Letter/Sharing/Edit.vue";


const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/dashboard',
            component: Dashboard,
            meta: Dashboard,
            name: ''
        },
        {
            path: '/dashboard/anggota',
            component: Anggota,
            children:[
                {
                    path: "/dashboard/anggota",
                    name: "IndexAnggota",
                    component: IndexAnggota,
                    meta: Anggota
                },
                {
                    path: "/dashboard/anggota/create",
                    name: "CreateAnggota",
                    component: CreateAnggota,
                    meta: Anggota
                },
                {
                    path: "/dashboard/anggota/edit/:id",
                    name: "EditAnggota",
                    component: EditAnggota,
                    meta: Anggota
                },
            ]
        },
        {
            path: '/dashboard/acara',
            component: Acara,
            children:[
                {
                    path: "/dashboard/acara",
                    name: "IndexAcara",
                    component: IndexAcara,
                    meta: Acara
                },
                {
                    path: "/dashboard/acara/detail/:id",
                    name: "DetailAcara",
                    component: DetailAcara,
                    meta: Acara
                },
                {
                    path: "/dashboard/acara/create",
                    name: "CreateAcara",
                    component: CreateAcara,
                    meta: Acara
                },
                {
                    path: "/dashboard/acara/edit/:id",
                    name: "EditAcara",
                    component: EditAcara,
                    meta: Acara
                },
            ]
        },
        {
            path: '/dashboard/artikel',
            component: Artikel,
            children:[
                {
                    path: "/dashboard/artikel",
                    name: "IndexArtikel",
                    component: IndexArtikel,
                    meta: Artikel
                },
                {
                    path: "/dashboard/artikel/detail/:id",
                    name: "DetailArtikel",
                    component: DetailArtikel,
                    meta: Artikel
                },
                {
                    path: "/dashboard/artikel/create",
                    name: "CreateArtikel",
                    component: CreateArtikel,
                    meta: Artikel
                },
                {
                    path: "/dashboard/artikel/edit/:id",
                    name: "EditArtikel",
                    component: EditArtikel,
                    meta: Artikel
                },
            ]
        },
        {
            path: '/dashboard/sharing',
            component: Sharing,
            children:[
                {
                    path: "/dashboard/sharing",
                    name: "IndexSharing",
                    component: IndexSharing,
                    meta: Sharing
                },
                {
                    path: "/dashboard/sharing/detail/:id",
                    name: "DetailSharing",
                    component: DetailSharing,
                    meta: Sharing
                },
                {
                    path: "/dashboard/sharing/create",
                    name: "CreateSharing",
                    component: CreateSharing,
                    meta: Sharing
                },
                {
                    path: "/dashboard/sharing/edit/:id",
                    name: "EditSharing",
                    component: EditSharing,
                    meta: Sharing
                },
            ]
        },
        // {
        //     path: '/:catchAll(.*)',
        //     redirect: '/',
        // },
        {
            path: '/dashboard:catchAll(.*)',
            redirect: '/dashboard',
        },
        {
            path: '/:catchAll(.*)',
            redirect: '/home'
        },
    ],
    linkActiveClass: 'active',
});

router.beforeEach((to, from, next) => {
    function addSpaceToCamelCase(inputString) {
        return inputString
          .replace(/([a-z])([A-Z])/g, '$1 $2')
          .replace(/([A-Z])([A-Z][a-z])/g, '$1 $2');
    }
    if(to.meta.name == "Dashboard"){
        document.title = to.meta.name; 
    } else {
          document.title = "Dashboard" + " - " + addSpaceToCamelCase(to.name); 
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

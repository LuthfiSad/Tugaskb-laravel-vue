<template>
  <Sidebaradmin :name="name"  />
  <main class="main-content position-relative border-radius-lg pb-5">
    <Navbaradmin @darkVersion="darkVersion" />
    <div class="container-fluid py-4">
      <div v-if="meta === 'Dashboard'">
        <router-view :isDark="isDark" :langgota="langgota" :acaras="acaras"  :lartikel="lartikel" :sharings="sharings"></router-view>
      </div>
      <div v-if="meta === 'Anggota'">
        <router-view 
            :angkatans="angkatans" 
            :anggotas="anggotas" 
            @getAnggota="getAnggota"
            @back="back"
        ></router-view>
      </div>
      <div v-if="meta === 'Acara'">
        <router-view 
            :acaras="acaras"
            :kategoris="kategoris"
            :isDark="isDark"
            @getAcara="getAcara" 
            @back="back"
        ></router-view>
      </div>
      <div v-if="meta === 'Artikel'">
        <router-view 
            :artikels="artikels"
            :kategoris="kategoris"
            @getArtikel="getArtikel" 
            @back="back"
        ></router-view>
      </div>
      <div v-if="meta === 'Sharing'">
        <router-view 
            :sharings="sharings"
            :kategoris="kategoris"
            :isDark="isDark"
            @getSharing="getSharing" 
            @back="back"
        ></router-view>
      </div>
    </div>
    <Footeradmin />
  </main>
  <Modal 
  @getAngkatan="getAngkatan" 
  @getKategori="getKategori" 
  @getArtikel="getArtikel" 
  @getAnggota="getAnggota" 
  @getAcara="getAcara" 
  @getSharing="getSharing" 
  :kategoris="kategoris" 
  :angkatans="angkatans"
  :sharings="sharings"
  />
</template>
  
<script>
import Navbaradmin from "@/components/NavbarAdmin.vue"; // Import komponen Navbar.vue
import Footeradmin from "@/components/FooterAdmin.vue";
import Sidebaradmin from "@/components/SidebarAdmin.vue";
import Modal from "@/components/Modal.vue";
// // <!--   Core JS Files   -->
// import '../../../public/js/core/bootstrap.min.js'
// import '../../../public/js/plugins/perfect-scrollbar.min.js'
// // <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
// import '../../../public/js/argon-dashboard.js'

export default {
  components: {
    Navbaradmin,
    Footeradmin,
    Sidebaradmin,
    Modal,
  },
  name: "Admin",
  data() {
    return {
      assetUrl: assetUrl,
      name: '',
      angkatans: [],
      anggotas: [], // Mengambil variabel JavaScript dari halaman Blade
      kategoris: [],
      acaras: [],
      artikels: [],
      sharings: [],
      langgota: 0,
      lartikel: 0,
      lsharing: 0,
      lacara: 0,
      meta: '',
      isDark: false
    }
  },
  provide() {
    return {
      assetUrl: this.assetUrl // Menyediakan assetUrl ke semua komponen anak
    };
  },
  watch: {
    '$route': {
      immediate: true, // Jalankan handler saat komponen dipasang
      handler(to, from) {
        this.meta = this.$route.meta.name;
        // console.log(this.$route.meta.name);

        // Kondisikan perubahan $route di sini
        // if (to.meta.name === 'something') {
        //   // Lakukan sesuatu jika meta.name sama dengan 'something'
        // } else if (to.meta.name === 'another') {
        //   // Lakukan sesuatu jika meta.name sama dengan 'another'
        // }
      },
    },
  },
  mounted() {
    const mode = localStorage.getItem('mode');
    this.isDark = mode === 'dark';
    // await this.getUser();
    const existingScripts = document.querySelectorAll("script[src='" + this.assetUrl + "js/argon-dashboard.js']");
    if (existingScripts.length === 0) {
      const script = document.createElement("script");
      script.src = this.assetUrl + "js/argon-dashboard.js"; // Ganti dengan jalur yang sesuai ke landingpage.js
      document.body.appendChild(script);
      this.scriptElement = script;
    }
    this.getAngkatan();
    this.getAnggota();
    this.getKategori();
    this.getAcara();
    this.getArtikel();
    this.getSharing();
    // console.log(this.name);
  },
  methods: {
    // async getUser() {
    //   try {
    //     const user = await axios.get("user");
    //     console.log(user);
    //     this.name = user.data.name;
    //     // console.log(user.data.name);
    //   } catch (e) {
    //     await Swal.fire({
    //     title: 'User Tidak ',
    //     icon: 'warning',
    //   });
        
    //   }
    // },
    async getAngkatan() {
      try {
        const angkatans = await axios.get("angkatan");
        // console.log(angkatans.data.angkatans);
        this.angkatans = angkatans.data.angkatans;
      } catch (e) {
        alert(e);
      }
    },
    async getAnggota() {
      try {
        const anggotas = await axios.get("anggota");
        // console.log(anggotas.data);
        this.anggotas = anggotas.data.anggotas;
        this.langgota = anggotas.data.anggotas.length;
      } catch (e) {
        alert(e);
      }
    },
    async getKategori() {
      try {
        const kategoris = await axios.get("kategori");
        // console.log(kategoris.data);
        this.kategoris = kategoris.data.kategoris;
      } catch (e) {
        alert(e);
      }
    },
    async getAcara() {
      try {
        const acaras = await axios.get("acara");
        // console.log(acaras.data);
        this.acaras = acaras.data.acaras;
      } catch (e) {
        alert(e);
      }
    },
    async getArtikel() {
      try {
        const artikels = await axios.get("artikel");
        // console.log(acaras.data);
        this.artikels = artikels.data.artikels;
        this.lartikel = artikels.data.artikels.length;
      } catch (e) {
        alert(e);
      }
    },
    async getSharing() {
      try {
        const sharings = await axios.get("sharing");
        // console.log(acaras.data);
        this.sharings = sharings.data.sharings;
        console.log();
      } catch (e) {
        alert(e);
      }
    },
    darkVersion(){
      const mode = localStorage.getItem('mode');
      this.isDark = mode === 'dark';
      // console.log(this.isDark);
    },
    back(){
      if(this.meta === 'Anggota'){
        this.anggotas = [];
      }
      if(this.meta === 'Acara'){
        this.acaras = [];
      }
      if(this.meta === 'Artikel'){
        this.artikels = [];
      }
      if(this.meta === 'Sharing'){
        this.sharings = [];
      }
      // console.log(this.isDark);
    }
  },
};
</script>

<style>
/* body{
  font-family: 'Roboto Mono', monospace;
} */
@import 'datatables.net-bs5';
.navbar-vertical.navbar-expand-xs .navbar-collapse {
  height: auto;
}
.table-responsive::-webkit-scrollbar {
  height: 10px;
}

/* Track */
.table-responsive::-webkit-scrollbar-track {
  background: #f1f1f1;
}

/* Handle */
.table-responsive::-webkit-scrollbar-thumb {
  background: #888;
}

/* Handle on hover */
.table-responsive::-webkit-scrollbar-thumb:hover {
  background: #555; 
}
main {
  min-height: 100vh;
}

.alert .btn-close {
  position: absolute;
  /* top: 0; */
  right: 0;
  z-index: 2;
  padding-right: 2rem;
  /* background-image: url('data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='%23fff' viewBox='0 0 16 16'%3e%3cpath d='M.293.293a1 1 0 011.414 0L8 6.586 14.293.293a1 1 0 111.414 1.414L9.414 8l6.293 6.293a1 1 0 01-1.414 1.414L8 9.414l-6.293 6.293a1 1 0 01-1.414-1.414L6.586 8 .293 1.707a1 1 0 010-1.414z'/%3e%3c/svg%3e') */
}
.ql-container .ql-editor.ql-blank::before {
  font-style: normal;
  /* font-weight: 400; */
  top: 15px;
  font-size: .9rem;
  color: #344767;
  font-family: "Open Sans", sans-serif;
  opacity: 0.5;
}
.ql-snow .ql-tooltip{
  left: 0 !important;
}
#dashboard .ql-snow a{
  color: #344767;
}
/* .dark-version #dashboard .ql-snow a{
  color: #fff;
} */
.dark-version #dashboard .ql-snow a{
  color: #fff;
}
.dark-version #dashboard .ql-snow .ql-tooltip a{
  color: #344767 !important;
}
.dark-version #dashboard .ql-snow .ql-tooltip a:hover{
  color: var(--bs-link-hover-color) !important;
}

#dashboard main a:hover{
  color: var(--bs-link-hover-color) !important;
}

#dashboard main a.badge:hover{
  color: #fff !important;
}
#dashboard main a.btn:hover{
  color: #fff !important;
}

.dark-version .ql-container .ql-editor.ql-blank::before {
  color:  #fff;
}

.dark-version .vc-container button, .dark-version .vc-popover-content-wrapper button {
  color: #000; /* Contoh gaya untuk teks warna hitam */
}
.dark-version .pagination .page-link{
    background-color: #111C44;
  }
  .dark-version .active .page-link{
    background-color: #5e72e4;
  }
</style>
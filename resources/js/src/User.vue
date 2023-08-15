<template>
    <Navbar/>
    <div v-if="meta === 'Home' || meta === 'Sharing'">
      <router-view :sharings="sharings"></router-view>
    </div>
    <div v-else-if="meta === 'Acara' || meta === 'DetailAcara'">
      <router-view :acaras="acaras"></router-view>
    </div>
    <div v-else-if="meta === 'Artikel' || meta === 'DetailArtikel'">
      <router-view :artikels="artikels"></router-view>
    </div>
    <div v-else>
      <router-view></router-view>
    </div>
    <Footervue/>
</template>
  
<script>
import Navbar from "@/components/Navbar.vue"; // Import komponen Navbar.vue
import Footervue from "@/components/Footer.vue";

export default {
  components: {
    Navbar, // Daftarkan komponen Navbar untuk digunakan di dalam template
    Footervue,
  },
  data(){
    return {
      acaras: [],
      artikels: [],
      sharings: [],
      meta: '',
    }
  },
  watch: {
    '$route': {
      immediate: true, // Jalankan handler saat komponen dipasang
      handler(to, from) {
        this.meta = this.$route.name;
        // console.log(this.meta);
      },
    },
  },
  name: "User",
  updated(){
    $("body").removeClass('sidebar-open');
    $('.navbar-collapse.navbar-menu-wrapper').removeClass("show")
  },
  mounted() {
    this.getAcara();
    this.getArtikel();
    this.getSharing();
  },
  methods: {
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
      } catch (e) {
        alert(e);
      }
    },
    async getSharing() {
      try {
        const sharings = await axios.get("sharing");
        // console.log(acaras.data);
        this.sharings = sharings.data.sharings;
      } catch (e) {
        alert(e);
      }
    },
  }
};
</script>

<style>
</style>
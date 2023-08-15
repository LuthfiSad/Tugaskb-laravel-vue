<template>
  <section id="speakers-details">
    <div class="container">
      <div class="section-header">
        <h2 class="my-3 text-break">{{ formatTitle($route.name) }}</h2>
      </div>

      <div class="row mb-4">
        <div class="col-md-6">
          <img
            v-if="item.image"
            :src="assetUrl+'storage/'+item.image"
            alt="Speaker 1"
            class="img-fluid"
          />
          <img
            v-else
            :src="assetUrl + 'assets/images/HIMTI1.png'"
            alt="Speaker 1"
            class="img-fluid"
          />
        </div>

        <div class="col-md-6 justify-content-center">
          <div class="align-items-lg-center">
            <br /><br /><br />
            <h2 class="text-uppercase">{{ item.title }}</h2>
            <h5>
              <b>
                <span v-if="item.jadwal">Hari/Tanggal : {{ getTanggal(item.jadwal) }}. <br />
                Jam : {{ getWaktu(item.jadwal) }} s/d Selesai. <br />
                </span>
                Kategori : {{ item.name_kategori }}.</b
              >
            </h5>
          </div>
          <button
            class="btn btn-info"
            data-target="#exampleModal"
            data-toggle="modal"
          >
            Daftar Sekarang
          </button>
        </div>
      </div>
      <div v-if="item.deskripsi" class="row">
        <div class="col-md-12 justify-content-center">
          <div class="align-items-lg-center">
            <h2>Deskripsi</h2>
            <h5 v-html="item.deskripsi">
            </h5>
          </div>
          <!-- <button class="btn btn-info" data-target="#exampleModal" data-toggle="modal">Daftar Sekarang</button> -->
        </div>
        <!-- <div class="col-md-6">
                    <img src="assets/images/ws1.jpg" alt="Speaker 1" class="img-fluid">
                </div> -->
      </div>
    </div>
  </section>
</template>

<script>
import { format } from 'date-fns';
import idLocale from "date-fns/locale/id";

export default {
  props: {
    artikels: Object,
    acaras: Object,
  },
  data() {
    return {
      item: {},
    };
  },
  inject: ["assetUrl"],
  methods: {
    formatTitle(input) {
      return input.replace(/([a-z])([A-Z])/g, "$1 $2");
    },
  },
  watch: {
    acaras: {
      immediate: true,
      handler(items) {
        if (this.$route.name == "DetailAcara") {
          //   console.log(items);
          // Ketika anggotas berubah (setelah loading selesai), ambil data anggota dengan ID yang sesuai
          const id_acara = this.$route.params.id;
          const acara = items.find((k) => k.id == id_acara);
          if (acara) {
            this.item = acara;
            // console.log(acara);
          }
        }
      },
    },
    artikels: {
      immediate: true,
      handler(items) {
        if (this.$route.name == "DetailArtikel") {
          //   console.log(items);
          // Ketika anggotas berubah (setelah loading selesai), ambil data anggota dengan ID yang sesuai
          const id_artikel = this.$route.params.id;
          const artikel = items.find((k) => k.id == id_artikel);
          if (artikel) {
            this.item = artikel;
            // console.log(acara);
          }
        }
      },
    },
  },
  computed: {
    getTanggal(){
      return(date)=>{
        return format(new Date(date), "EEEE, dd MMMM yyyy", {
        locale: idLocale
      });
      };
    },
    getWaktu(){
      return(date)=>{
        return format(new Date(date), "HH:mm", {
        locale: idLocale
      });
      };
    }
  },
  created() {
    var routerLinkElement = $('router-link[to="/sharing"]');
    console.log(routerLinkElement);
    const script = document.createElement("script");
    script.src = this.assetUrl + "assets/js/landingpage.js"; // Ganti dengan jalur yang sesuai ke landingpage.js
    document.body.appendChild(script);
    this.scriptElement = script;
  },
  beforeUnmount() {
    if (this.scriptElement) {
      document.body.removeChild(this.scriptElement); // Hapus elemen script dari DOM
      this.scriptElement = null;
    }
  },
};
</script>

<style scoped>
@import url("../../../public/assets/css/style.min.css");
@import url("../../../public/assets/css/style-acara.css");
</style>
<template>
  <div class="content-wrapper">
    <div class="container">
      <section class="customer-feedback" id="feedback-section">
        <div class="section-title" data-aos="fade-up">
          <h2>HIMTI</h2>
          <p>Materi Pembelajaran</p>
        </div>
        <div class="row">
          <div class="owl-carousel owl-theme grid-margin">
            <div class="card customer-cards">
              <div class="card-body">
                <div class="text-center">
                  <img :src="assetUrl + 'assets/images/java.png'" width="89" height="89" alt="" class="img-customer" />
                  <p class="m-0 py-3 text-muted">
                    Java adalah bahasa pemrograman yang dapat dijalankan di
                    berbagai komputer termasuk telepon genggam. Bahasa ini
                    awalnya dibuat oleh James Gosling saat masih bergabung di
                    Sun Microsystems, yang saat ini merupakan bagian dari Oracle
                    dan dirilis tahun 1995.
                  </p>
                  <div class="content-divider m-auto"></div>
                  <br />
                </div>
              </div>
            </div>
            <div class="card customer-cards">
              <div class="card-body">
                <div class="text-center">
                  <img :src="assetUrl + 'assets/images/html-coding.png'" width="95" height="95" alt="" class="img-customer" />
                  <p class="m-0 py-3 text-muted">
                    Hypertext Markup Language adalah bahasa markah standar untuk
                    dokumen yang dirancang untuk ditampilkan di peramban
                    internet. Ini dapat dibantu oleh teknologi seperti Cascading
                    Style Sheets dan bahasa scripting seperti JavaScript dan
                    VBScript.
                  </p>
                  <div class="content-divider m-auto"></div>
                  <br />
                </div>
              </div>
            </div>
            <div class="card customer-cards">
              <div class="card-body">
                <div class="text-center">
                  <img :src="assetUrl + 'assets/images/computer.png'" width="85" height="85" alt="" class="img-customer" />
                  <p class="m-0 py-3 text-muted">
                    Desain grafis atau rancang grafis adalah proses komunikasi
                    menggunakan elemen visual, seperti tipografi, fotografi,
                    serta ilustrasi yang dimaksudkan untuk menciptakan persepsi
                    akan suatu pesan yang disampaikan. Bidang ini melibatkan
                    proses komunikasi visual dan desain komunikasi. membentuk
                    gagasan dan pesan secara visual.
                  </p>
                  <div class="content-divider m-auto"></div>
                </div>
              </div>
            </div>
            <div class="card customer-cards">
              <div class="card-body">
                <div class="text-center">
                  <img :src="assetUrl + 'assets/images/android-logo.png'" width="89" height="89" alt="" class="img-customer" />
                  <p class="m-0 py-3 text-muted">
                    Studio adalah Integrated Development Enviroment untuk sistem
                    operasi Android, yang dibangun di atas perangkat lunak
                    JetBrains IntelliJ IDEA dan didesain khusus untuk
                    pengembangan Android.
                  </p>
                  <div class="content-divider m-auto"></div>
                  <br /><br />
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="digital-marketing-service" id="digital-marketing-section">
        <div class="section-title" data-aos="fade-up">
          <h2>HIMTI</h2>
          <p>Jadwal Pembelajaran</p>
        </div>
        <div class="row grid-margin">
          <div v-for="(sharing, index) in sharings" :key="sharing.id" class="row align-items-center justify-content-center mb-4" style="width: 1170px;">
            <div v-if="(index + 1) % 2 == 1" class="col-12 col-lg-5 text-center flex-item grid-margin" data-aos="fade-right">
              <img v-if="sharing.image" :src="assetUrl + 'storage/' + sharing.image" alt="" height="336" width="306" class="img-fluid" />
              <img v-else :src="assetUrl + 'assets/images/HIMTI1.png'" alt="" height="336" width="306" class="img-fluid" />
            </div>
            <div v-if="(index + 1) % 2 == 1" class="col-5 col-lg-5 flex-item grid-margin" data-aos="fade-left">
              <h3 class="m-0 text-uppercase">{{ sharing.title }}</h3>
              <div class="col-lg-9 col-xl-8 p-0">
                <div class="pt-3 m-0 text-muted" v-html="sharing.deskripsi">
              </div>
                <p class="pb-2 font-weight-medium text-muted">
                  <b>
                  Hari/Tanggal : {{ getTanggal(sharing.jadwal) }}.<br />
                  Jam : {{ getWaktu(sharing.jadwal) }} s/d Selesai. <br/>
                  Kategori : {{ sharing.name_kategori }}.</b>
                </p>
              </div>
            </div>
            <div v-if="(index + 1) % 2 == 0" class="col-5 col-lg-5 flex-item grid-margin" data-aos="fade-left">
              <h3 class="m-0 text-uppercase">{{ sharing.title }}</h3>
              <div class="col-lg-12 col-xl-8 p-0">
                <div class="pt-3 m-0 text-muted" v-html="sharing.deskripsi">
              </div>
                <p class="pb-2 font-weight-medium text-muted">
                  <b>
                  Hari/Tanggal : {{ getTanggal(sharing.jadwal) }}.<br />
                  Jam : {{ getWaktu(sharing.jadwal) }} s/d Selesai. <br/>
                  Kategori : {{ sharing.name_kategori }}.</b>
                </p>
              </div>
            </div>
            <div v-if="(index + 1) % 2 == 0" class="col-12 col-lg-3 text-center flex-item grid-margin" data-aos="fade-right">
              <img v-if="sharing.image" :src="assetUrl + 'storage/' + sharing.image" alt="" height="236" width="306" class="img-fluid" />
              <img v-else :src="assetUrl + 'assets/images/HIMTI1.png'" alt="" height="236" width="306" class="img-fluid" />
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
</template>
  
<script>
import { format } from "date-fns";
import idLocale from "date-fns/locale/id";

export default {
  name: "Sharing",
  inject: ["assetUrl"],
  props: {
    sharings: Object,
  },
  created() {
    // console.log(this.sharings);
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
  computed: {
    getTanggal() {
      return (date) => {
        return format(new Date(date), "EEEE, dd MMMM yyyy", {
          locale: idLocale,
        });
      };
    },
    getWaktu() {
      return (date) => {
        return format(new Date(date), "HH:mm", {
          locale: idLocale,
        });
      };
    },
  },
};
</script>
  
  <!-- <script scope>
    import ''
  </script> -->
  
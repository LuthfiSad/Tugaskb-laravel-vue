<template>
  <div class="banner">
    <div class="container">
      <h1 class="font-weight-semibold">
        Himpunan Mahasiswa Teknik Informatika<br />Universitas Muhammadiyah
        Tangerang
      </h1>
      <img
        :src="assetUrl + 'assets/images/HIMTI.png'"
        alt=""
        class="img-fluid"
        height="500"
        width="500"
      />
    </div>
  </div>
  <div class="content-wrapper">
    <div class="container">
      <section class="features-overview" id="features-section">
        <div class="section-title" data-aos="fade-up">
          <h2>HIMTI</h2>
          <p>Prestasi Kami</p>
        </div>
        <div class="d-md-flex justify-content-between">
          <div class="grid-margin d-flex justify-content-start">
            <div class="features-width">
              <img
                :src="assetUrl + 'assets/images/Group12.svg'"
                alt=""
                class="img-icons"
              />
              <h5 class="py-3">Juara II<br />Lomba Startup Inovation</h5>
              <p class="text-muted">
                Lomba Startup Inovation ini diadakan oleh PERMIKOMNAS Wilayah IV
                Banten yang diadakan secara online pada Tanggal 10-11 April
                2021.
              </p>
              <a href="#">
                <p class="readmore-link">Readmore</p>
              </a>
            </div>
          </div>
          <div class="grid-margin d-flex justify-content-center">
            <div class="features-width">
              <img
                :src="assetUrl + 'assets/images/clapperboard.png'"
                height="65"
                width="65"
                alt=""
                class="img-icons"
              />
              <h5 class="py-3">Juara II<br />Lomba Short Movie</h5>
              <p class="text-muted">
                Lomba Short Movie ini diadakan oleh Badan Eksekutif Mahasiswa
                Global Institute untuk memperingati hari Kartini pada Tanggal 21
                April 2021.
              </p>
              <a href="#">
                <p class="readmore-link">Readmore</p>
              </a>
            </div>
          </div>
          <div class="grid-margin d-flex justify-content-end">
            <div class="features-width">
              <img
                :src="assetUrl + 'assets/images/computer.png'"
                height="65"
                width="65"
                alt=""
                class="img-icons"
              />
              <h5 class="py-3">Juara II<br />Lomba Design Grafis</h5>
              <p class="text-muted">
                Lomba Design Grafis ini diadakan oleh Universitas Darma Persada,
                Jakarta Timur.
              </p>
              <a href="#">
                <p class="readmore-link">Readmore</p>
              </a>
            </div>
          </div>
        </div>
      </section>
      <section class="digital-marketing-service" id="digital-marketing-section">
        <div class="mb-5 sharing">
        <div
          class="row align-items-center mb-4"
          v-for="(sharing, index) in sharings"
          :key="sharing.id"
        >
          <div
            v-if="(index + 1) % 2 == 1"
            class="col-12 col-lg-7 grid-margin grid-margin-lg-0"
            data-aos="fade-right"
          >
            <h3 class="m-0 text-uppercase">{{ sharing.title }}</h3>
            <div class="col-lg-7 col-xl-6 p-0">
              <div class="pt-3 m-0 text-muted" v-html="sharing.deskripsi">
              </div>
              <p>
                <b>
                  Hari/Tanggal : {{ getTanggal(sharing.jadwal) }}.<br />
                  Jam : {{ getWaktu(sharing.jadwal) }} s/d Selesai. <br/>
                  Kategori : {{ sharing.name_kategori }}.</b>
              </p>
            </div>
          </div>
          <div
            v-if="(index + 1) % 2 == 1"
            class="col-12 col-lg-5 p-0 img-digital grid-margin grid-margin-lg-0"
            data-aos="fade-left"
          >
            <img
              v-if="sharing.image"
              :src="assetUrl + 'storage/' + sharing.image"
              alt=""
              height="336"
              width="306"
              class="img-fluid"
            />
            <img
              v-else
              :src="assetUrl + 'assets/images/HIMTI1.png'"
              alt=""
              height="336"
              width="306"
              class="img-fluid"
            />
          </div>
          <div
            v-if="(index + 1) % 2 == 0"
            class="col-12 col-lg-7 text-center flex-item grid-margin"
            data-aos="fade-right"
          >
            <img
              v-if="sharing.image"
              :src="assetUrl + 'storage/' + sharing.image"
              alt=""
              height="336"
              width="306"
              class="img-fluid"
            />
            <img
              v-else
              :src="assetUrl + 'assets/images/HIMTI1.png'"
              alt=""
              height="336"
              width="306"
              class="img-fluid"
            />
          </div>
          <div
            v-if="(index + 1) % 2 == 0"
            class="col-12 col-lg-5 flex-item grid-margin"
            data-aos="fade-left"
          >
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
        </div>
        </div>
        <div class="banner-clinic">
          <div class="row justify-content-center">
            <div class="col">
              <div class="col-md-12 text-center pb-5">
                <img :src="assetUrl+'assets/images/himti-klinik.png'" width="1100" alt="" class="img-fluid">
                <div
                  class="card-desc-box d-flex align-items-center justify-content-around"
                ></div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="case-studies" id="case-studies-section">
        <div class="section-title" data-aos="fade-up">
          <h2>HIMTI</h2>
          <p>Pembelajaran</p>
        </div>
        <div class="row grid-margin">
          <div
            class="col-12 col-md-6 col-lg-3 stretch-card mb-3 mb-lg-0"
            data-aos="zoom-in"
          >
            <div class="card color-cards">
              <div class="card-body p-0">
                <div class="bg-primary text-center card-contents">
                  <div class="card-image">
                    <img
                      :src="assetUrl + 'assets/images/java.png'"
                      class="case-studies-card-img"
                      alt=""
                    />
                  </div>
                  <div
                    class="card-desc-box d-flex align-items-center justify-content-around"
                  >
                    <div>
                      <h6 class="text-white pb-2 px-3">Java Programming</h6>
                      <a href="sharing.html"
                        ><button class="btn btn-white">Read More</button></a
                      >
                    </div>
                  </div>
                </div>
                <div class="card-details text-center pt-4">
                  <h6 class="m-0 pb-1">Java Programming</h6>
                </div>
              </div>
            </div>
          </div>
          <div
            class="col-12 col-md-6 col-lg-3 stretch-card mb-3 mb-lg-0"
            data-aos="zoom-in"
            data-aos-delay="200"
          >
            <div class="card color-cards">
              <div class="card-body p-0">
                <div class="bg-warning text-center card-contents">
                  <div class="card-image">
                    <img
                      :src="assetUrl + 'assets/images/html-coding.png'"
                      class="case-studies-card-img"
                      alt=""
                    />
                  </div>
                  <div
                    class="card-desc-box d-flex align-items-center justify-content-around"
                  >
                    <div>
                      <h6 class="text-white pb-2 px-3">Web Development</h6>
                      <a href="sharing.html"
                        ><button class="btn btn-white">Read More</button></a
                      >
                    </div>
                  </div>
                </div>
                <div class="card-details text-center pt-4">
                  <h6 class="m-0 pb-1">Web Development</h6>
                </div>
              </div>
            </div>
          </div>
          <div
            class="col-12 col-md-6 col-lg-3 stretch-card mb-3 mb-lg-0"
            data-aos="zoom-in"
            data-aos-delay="400"
          >
            <div class="card color-cards">
              <div class="card-body p-0">
                <div class="bg-violet text-center card-contents">
                  <div class="card-image">
                    <img
                      :src="assetUrl + 'assets/images/computer.png'"
                      class="case-studies-card-img"
                      alt=""
                    />
                  </div>
                  <div
                    class="card-desc-box d-flex align-items-center justify-content-around"
                  >
                    <div>
                      <h6 class="text-white pb-2 px-3">Desain Grafis</h6>
                      <a href="sharing.html"
                        ><button class="btn btn-white">Read More</button></a
                      >
                    </div>
                  </div>
                </div>
                <div class="card-details text-center pt-4">
                  <h6 class="m-0 pb-1">Desain Grafis</h6>
                </div>
              </div>
            </div>
          </div>
          <div
            class="col-12 col-md-6 col-lg-3 stretch-card"
            data-aos="zoom-in"
            data-aos-delay="600"
          >
            <div class="card color-cards">
              <div class="card-body p-0">
                <div class="bg-success text-center card-contents">
                  <div class="card-image">
                    <img
                      :src="assetUrl + 'assets/images/android-logo.png'"
                      class="case-studies-card-img"
                      alt=""
                    />
                  </div>
                  <div
                    class="card-desc-box d-flex align-items-center justify-content-around"
                  >
                    <div>
                      <h6 class="text-white pb-2 px-3">Android Development</h6>
                      <a href="sharing.html"
                        ><button class="btn btn-white">Read More</button></a
                      >
                    </div>
                  </div>
                </div>
                <div class="card-details text-center pt-4">
                  <h6 class="m-0 pb-1">Android Development</h6>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="customer-feedback" id="feedback-section">
        <div class="section-title" data-aos="fade-up">
          <h2>HIMTI</h2>
          <p>Alumni</p>
        </div>
        <div class="row">
          <div class="owl-carousel owl-theme grid-margin">
            <div class="card customer-cards">
              <div class="card-body">
                <div class="text-center">
                  <img
                    :src="assetUrl + 'assets/images/rajif.jpeg'"
                    width="89"
                    height="89"
                    alt=""
                    class="img-customer"
                  />
                  <p class="m-0 py-3 text-muted">Fullstack Developer.</p>
                  <div class="content-divider m-auto"></div>
                  <h6 class="card-title pt-3">Rajif Mahendra</h6>
                  <h6 class="customer-designation text-muted m-0">
                    Fullstack Developer
                  </h6>
                  <br />
                </div>
              </div>
            </div>
            <div class="card customer-cards">
              <div class="card-body">
                <div class="text-center">
                  <img
                    :src="assetUrl + 'assets/images/viky.jpeg'"
                    width="89"
                    height="89"
                    alt=""
                    class="img-customer"
                  />
                  <p class="m-0 py-3 text-muted">
                    Mobile Developer at Indivara Group.
                  </p>
                  <div class="content-divider m-auto"></div>
                  <h6 class="card-title pt-3">Viky Yahya</h6>
                  <h6 class="customer-designation text-muted m-0">
                    Mobile Developer
                  </h6>
                  <br />
                </div>
              </div>
            </div>
            <div class="card customer-cards">
              <div class="card-body">
                <div class="text-center">
                  <img
                    :src="assetUrl + 'assets/images/asad.jpeg'"
                    width="89"
                    height="89"
                    alt=""
                    class="img-customer"
                  />
                  <p class="m-0 py-3 text-muted">
                    Mobile Application Developer di PT. Cudo Communications.
                  </p>
                  <div class="content-divider m-auto"></div>
                  <h6 class="card-title pt-3">Asadullah Al Hamasy</h6>
                  <h6 class="customer-designation text-muted m-0">
                    Mobile Developer
                  </h6>
                </div>
              </div>
            </div>
            <div class="card customer-cards">
              <div class="card-body">
                <div class="text-center">
                  <img
                    :src="assetUrl + 'assets/images/rangga.jpeg'"
                    width="89"
                    height="89"
                    alt=""
                    class="img-customer"
                  />
                  <p class="m-0 py-3 text-muted">
                    Android Developer di PT. STARCOM TECHNOLOGY INDONESIA.
                  </p>
                  <div class="content-divider m-auto"></div>
                  <h6 class="card-title pt-3">Rangga Cikal Senopati</h6>
                  <h6 class="customer-designation text-muted m-0">
                    Android Developer
                  </h6>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="customer-feedback" id="feedback-section">
        <div class="section-title" data-aos="fade-up">
          <h2>HIMTI</h2>
          <p>Partnership</p>
        </div>
        <div class="row">
          <div class="owl-carousel owl-theme grid-margin">
            <div class="card customer-cards">
              <div class="card-body">
                <div class="text-center">
                  <img
                    :src="assetUrl + 'assets/images/permikomnas.png'"
                    width="89"
                    height="89"
                    alt=""
                    class="img-customer"
                  />
                  <p class="m-0 py-3 text-muted">
                    Perhimpunan Mahasiswa Informatika Dan Komputer Nasional
                  </p>
                  <div class="content-divider m-auto"></div>
                  <h6 class="card-title pt-3">PERMIKOMNAS</h6>
                </div>
              </div>
            </div>
            <div class="card customer-cards">
              <div class="card-body">
                <div class="text-center">
                  <img
                    :src="assetUrl + 'assets/images/bangkukelas_ig-02.png'"
                    width="89"
                    height="89"
                    alt=""
                    class="img-customer"
                  />
                  <p class="m-0 py-3 text-muted"><br />bangkukelas.id</p>
                  <div class="content-divider m-auto"></div>
                  <h6 class="card-title pt-3">Bangku[KELAS]</h6>
                </div>
              </div>
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
  name: "Home",
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

<style scoped>
.sharing {
  height: 600px;
  overflow-y: scroll; 
  overflow-x: hidden; 
  box-sizing: border-box;
}
.sharing::-webkit-scrollbar {
  width: 10px;
}

/* Track */
.sharing::-webkit-scrollbar-track {
  background: #f1f1f1;
}

/* Handle */
.sharing::-webkit-scrollbar-thumb {
  background: #888;
}

/* Handle on hover */
.sharing::-webkit-scrollbar-thumb:hover {
  background: #555; 
}
</style>
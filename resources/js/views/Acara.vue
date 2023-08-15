<template>
  <div class="content-wrapper">
    <div class="container">
      <section id="speakers">
        <div class="section-title" data-aos="fade-up">
          <h2>HIMTI</h2>
          <p>Acara</p>
        </div>
        <div class="col-12 text-center pb-2">
          <p>Beberapa Acara kami dalam acara HIMTI FESTIVAL</p>
        </div>
        <div class="row">
          <div class="col-lg-4 col-md-4" v-for="acara in acaras" :key="acara.id">
            <div class="speaker" data-aos="fade-up" data-aos-delay="100">
              <img
                v-if="acara.image"
                :src="assetUrl + 'storage/' + acara.image"
                alt="Speaker 1"
                class="img-fluid"
              />
              <img
                v-else
                :src="assetUrl + 'assets/images/HIMTI1.png'"
                alt="Speaker 1"
                class="img-fluid"
              />
              <div class="details">
                <h3><router-link class="text-capitalize" :to="{ name: 'DetailAcara', params: { id: acara.id } }" exact>{{ acara.title }}</router-link></h3>
              </div>
            </div>
          </div>
        </div>
      </section>
      <br />
      <section id="speakers">
        <div class="container" data-aos="fade-up">
          <div class="section-title" data-aos="fade-up">
            <h2>HIMTI</h2>
            <p>Pembicara</p>
          </div>
          <div class="col-12 text-center pb-2">
            <p>Beberapa Pembicara kami dalam acara HIMTI FESTIVAL</p>
          </div>
          <div class="row">
            <div class="col-lg-4 col-md-6">
              <div class="speaker" data-aos="fade-up" data-aos-delay="100">
                <img
                  :src="assetUrl + 'assets/images/pakono.jpg'"
                  alt="Speaker 1"
                  class="img-fluid"
                />
                <div class="details">
                  <h3><a href="#">Onno Widodo Purbo</a></h3>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-6">
              <div class="speaker" data-aos="fade-up" data-aos-delay="200">
                <img
                  :src="assetUrl + 'assets/images/rajif.jpg'"
                  alt="Speaker 2"
                  class="img-fluid"
                />
                <div class="details">
                  <h3><a href="#">Rajif Mahendra</a></h3>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-6">
              <div class="speaker" data-aos="fade-up" data-aos-delay="300">
                <img
                  :src="assetUrl + 'assets/images/erry.jpeg'"
                  alt="Speaker 3"
                  height="500"
                  width="500"
                  class="img-fluid"
                />
                <div class="details">
                  <h3><a href="#">Ery Ricardo</a></h3>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-6">
              <div class="speaker" data-aos="fade-up" data-aos-delay="100">
                <br />
                <img
                  :src="assetUrl + 'assets/images/pakoskar.jpeg'"
                  alt="Speaker 4"
                  height="500"
                  width="800"
                  class="img-fluid"
                />
                <div class="details">
                  <h3><a href="#">Oskar Riandi</a></h3>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-6">
              <div class="speaker" data-aos="fade-up" data-aos-delay="200">
                <img
                  :src="assetUrl + 'assets/images/beno.jpg'"
                  alt="Speaker 5"
                  width="350"
                  class="img-fluid"
                />
                <div class="details">
                  <h3><a href="#">Beno Kunto Pradekso</a></h3>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-6">
              <div class="speaker" data-aos="fade-up" data-aos-delay="300">
                <img
                  :src="assetUrl + 'assets/images/yudho.jpg'"
                  alt="Speaker 6"
                  width="400"
                  class="img-fluid"
                />
                <div class="details">
                  <h3><a href="#">Yudho Giri Sucahyo</a></h3>
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
export default {
  props: {
    acaras: Object,
  },
  name: "Acara",
  inject: ["assetUrl"],
  created() {
    // console.log('p');
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

/* @import url('../../../public/assets/js/main-acara.js'); */
@import url('../../../public/assets/css/style.min.css');
@import url('../../../public/assets/css/style-acara.css');
</style>
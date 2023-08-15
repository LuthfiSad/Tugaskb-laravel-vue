<template>
  <div class="content-wrapper">
    <div class="container">
      <section id="speakers">
        <div class="section-title" data-aos="fade-up">
          <h2>HIMTI</h2>
          <p>Artikel</p>
        </div>
        <div class="col-12 text-center pb-2">
          <p>Beberapa Agenda kami dalam acara HIMTI FESTIVAL</p>
        </div>
        <div class="row">
          <div class="col-lg-4 col-md-4" v-for="artikel in artikels" :key="artikel.id">
            <div class="speaker" data-aos="fade-up" data-aos-delay="100">
              <img
                v-if="artikel.image"
                :src="assetUrl + 'storage/' + artikel.image"
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
                <h3><router-link class="text-capitalize" :to="{ name: 'DetailArtikel', params: { id: artikel.id } }" exact>{{ artikel.title }}</router-link></h3>
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
  props:{
    artikels: Object
  },
  name: "Artikel",
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
@import url('../../../public/assets/css/style.min.css');
@import url('../../../public/assets/css/style-acara.css');
</style>
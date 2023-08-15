<template>
  <div class="content-wrapper">
    <div class="container">
      <section id="team" class="team">
        <div class="container">
          <div class="section-title" data-aos="fade-up">
            <h2>HIMTI</h2>
            <p>Tutorial Youtube</p>
          </div>
          <div class="features-row section-bg" id="advanced-features">
            <div class="container" id="bg">
              <div class="row">
                <div class="col-12">
                  <iframe
                    class="advanced-feature-img-right wow fadeInRight"
                    width="555"
                    height="371"
                    src="https://www.youtube.com/embed/iYG29Ng91Bc"
                    title="YouTube video player"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen
                  ></iframe>
                  <div class="wow fadeInLeft">
                    <h2>Form Element dan Input Element Type Text (Textbox)</h2>
                    <i
                      class="ion-ios-paper-outline wow fadeInRight"
                      data-wow-duration="0.5s"
                    ></i>
                    <p class="wow fadeInLeft" data-wow-duration="0.5s">
                      Penjelasan singkat maksud dari video
                    </p>
                    <i
                      class="ion-ios-color-filter-outline wow fadeInRight"
                      data-wow-delay="0.2s"
                      data-wow-duration="0.5s"
                    ></i>
                    <p
                      class="wow fadeInLeft"
                      data-wow-delay="0.2s"
                      data-wow-duration="0.5s"
                    >
                      Tools apa saja yang digunakan
                    </p>
                    <i
                      class="ion-ios-barcode-outline wow fadeInRight"
                      data-wow-delay="0.4"
                      data-wow-duration="0.5s"
                    ></i>
                    <p
                      class="wow fadeInLeft"
                      data-wow-delay="0.4s"
                      data-wow-duration="0.5s"
                    >
                      Links pembelajaran yang berhubungan dengan video.
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="features-row mt-5" id="advanced-features">
            <div class="container">
              <div class="row">
                <div class="col-12">
                  <iframe
                    class="advanced-feature-img-left"
                    width="555"
                    height="371"
                    src="https://www.youtube.com/embed/rnxiWZRRKB0"
                    title="YouTube video player"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen
                  ></iframe>
                  <div class="wow fadeInRight">
                    <h2>Acak Angka Doorprize dengan HTML Dan jQuery</h2>
                    <i
                      class="ion-ios-paper-outline wow fadeInRight"
                      data-wow-duration="0.5s"
                    ></i>
                    <p class="wow fadeInRight" data-wow-duration="0.5s">
                      Penjelasan singkat maksud dari video
                    </p>
                    <i
                      class="ion-ios-color-filter-outline wow fadeInRight"
                      data-wow-delay="0.2s"
                      data-wow-duration="0.5s"
                    ></i>
                    <p
                      class="wow fadeInRight"
                      data-wow-delay="0.2s"
                      data-wow-duration="0.5s"
                    >
                      Tools apa saja yang digunakan
                    </p>
                    <i
                      class="ion-ios-barcode-outline wow fadeInRight"
                      data-wow-delay="0.4"
                      data-wow-duration="0.5s"
                    ></i>
                    <p
                      class="wow fadeInRight"
                      data-wow-delay="0.4s"
                      data-wow-duration="0.5s"
                    >
                      Links pembelajaran yang berhubungan dengan video
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="features-row section-bg mt-5" id="advanced-features">
            <div class="container" id="bg">
              <div class="row">
                <div class="col-12">
                  <iframe
                    class="advanced-feature-img-right wow fadeInRight"
                    width="555"
                    height="371"
                    src="https://www.youtube.com/embed/vt6x8t_mY9A"
                    title="YouTube video player"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen
                  ></iframe>
                  <div class="wow fadeInLeft">
                    <h2>Alur System React Js dan Membuat Component</h2>
                    <i
                      class="ion-ios-paper-outline wow fadeInRight"
                      data-wow-duration="0.5s"
                    ></i>
                    <p class="wow fadeInLeft" data-wow-duration="0.5s">
                      Penjelasan singkat maksud dari video
                    </p>
                    <i
                      class="ion-ios-color-filter-outline wow fadeInRight"
                      data-wow-delay="0.2s"
                      data-wow-duration="0.5s"
                    ></i>
                    <p
                      class="wow fadeInLeft"
                      data-wow-delay="0.2s"
                      data-wow-duration="0.5s"
                    >
                      Tools apa saja yang digunakan
                    </p>
                    <i
                      class="ion-ios-barcode-outline wow fadeInRight"
                      data-wow-delay="0.4"
                      data-wow-duration="0.5s"
                    ></i>
                    <p
                      class="wow fadeInLeft"
                      data-wow-delay="0.4s"
                      data-wow-duration="0.5s"
                    >
                      Links pembelajaran yang berhubungan dengan video
                    </p>
                  </div>
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
  name: "Tutorial",
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
@import url('../../../public/assets/avilon/assets/vendor/ionicons/css/ionicons.min.css');
@import url('../../../public/assets/avilon/assets/vendor/animate.css/animate.min.css');
@import url('../../../public/assets/avilon/assets/vendor/font-awesome/css/font-awesome.min.css');
@import url('../../../public/assets/avilon/assets/vendor/venobox/venobox.css');
@import url('../../../public/assets/css/style.css');
</style>
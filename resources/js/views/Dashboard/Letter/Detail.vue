<template>
  <div class="row mt-4">
    <div class="col-12 mb-lg-0 mb-4">
      <div class="card">
        <div class="card-body">
          <section id="speakers-details">
            <div class="container">
              <div
                class="section-header d-flex justify-content-between align-items-center"
              >
                <h2 class="my-3">Detail {{ $route.meta.name }}</h2>
                <router-link
                  :to="'/dashboard/' + $route.meta.name"
                  class="badge border-0 bg-gradient-danger"
                  >back</router-link
                >
              </div>

              <div class="row mb-4">
                <div class="col-md-6">
                  <img
                    v-if="item.image"
                    :src="assetUrl + 'storage/' + item.image"
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
                    <h2 class="text-uppercase">
                      {{ item.title }}
                    </h2>
                    <p
                      v-if="$route.meta.name == 'Sharing'"
                      v-html="item.deskripsi"
                    ></p>
                    <p>
                      <b
                        ><span v-if="item.jadwal"
                          >Hari/Tanggal : {{ getTanggal(item.jadwal) }}.<br />
                          Jam :
                          {{ getWaktu(item.jadwal) }}
                          s/d Selesai. <br
                        /></span>
                        Kategori :
                        {{ item.name_kategori }}.</b
                      >
                    </p>
                  </div>
                </div>
              </div>
              <div
                class="row"
                v-if="$route.meta.name != 'Sharing' && item.deskripsi"
              >
                <div class="col-md-12 justify-content-center">
                  <div class="align-items-lg-center">
                    <h2>Deskripsi</h2>
                    <p v-html="item.deskripsi"></p>
                  </div>
                  <!-- <button class="btn btn-info" data-target="#exampleModal" data-toggle="modal">Daftar Sekarang</button> -->
                </div>
                <!-- <div class="col-md-6">
                    <img src="assets/images/ws1.jpg" alt="Speaker 1" class="img-fluid">
                </div> -->
              </div>
            </div>
          </section>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { format } from "date-fns";
import idLocale from "date-fns/locale/id";

export default {
  inject: ["assetUrl"],
  props: {
    artikels: Object,
    acaras: Object,
    sharings: Object,
  },
  data() {
    return {
      item: {},
    };
  },
  watch: {
    acaras: {
      immediate: true,
      async handler(items) {
        if (items.length > 0) {
          if (this.$route.meta.name == "Acara") {
            //   console.log(items);
            // Ketika anggotas berubah (setelah loading selesai), ambil data anggota dengan ID yang sesuai
            const id_acara = this.$route.params.id;
            const acara = items.find((k) => k.id == id_acara);
            if (acara) {
              this.item = acara;
              // console.log(acara);
            } else {
              await Swal.fire({
                title: "ID Tidak Tersedia",
                icon: "warning",
              });
              this.$router.push({ name: "IndexAcara" });
            }
          }
        }
      },
    },
    artikels: {
      immediate: true,
      async handler(items) {
        if (items.length > 0) {
          if (this.$route.meta.name == "Artikel") {
            //   console.log(items);
            // Ketika anggotas berubah (setelah loading selesai), ambil data anggota dengan ID yang sesuai
            const id_artikel = this.$route.params.id;
            const artikel = items.find((k) => k.id == id_artikel);
            if (artikel) {
              this.item = artikel;
              // console.log(acara);
            } else {
              await Swal.fire({
                title: "ID Tidak Tersedia",
                icon: "warning",
              });
              this.$router.push({ name: "IndexAcara" });
            }
          }
        }
      },
    },
    sharings: {
      immediate: true,
      async handler(items) {
        if (items.length > 0) {
          if (this.$route.meta.name == "Sharing") {
            //   console.log(items);
            // Ketika anggotas berubah (setelah loading selesai), ambil data anggota dengan ID yang sesuai
            const id_sharing = this.$route.params.id;
            const sharing = items.find((k) => k.id == id_sharing);
            if (sharing) {
              this.item = sharing;
              // console.log(acara);
            } else {
              await Swal.fire({
                title: "ID Tidak Tersedia",
                icon: "warning",
              });
              this.$router.push({ name: "IndexAcara" });
            }
          }
        }
      },
    },
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

<style></style>

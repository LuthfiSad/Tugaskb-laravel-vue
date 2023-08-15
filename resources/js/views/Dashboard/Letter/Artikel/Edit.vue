<template>
  <div class="row">
    <div class="col-12 mb-lg-0 mb-4">
      <div class="card">
        <div class="card-header pb-0">
          <div class="d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Edit Artikel</h4>
            <button v-on:click="back" class="badge border-0 bg-gradient-danger">
              back
            </button>
          </div>
        </div>
        <div class="card-body">
          <form
            v-on:submit.prevent="formOnSubmit"
            enctype="multipart/form-data"
          >
            <div class="form-group">
              <label for="title" class="form-control-label">Title</label>
              <input
              id="title"
                name="title"
                v-model="artikel.title"
                type="text"
                autofocus
                class="form-control"
                :class="{ 'is-invalid': errors.title }"
                placeholder="Masukan Title"
              />
              <small v-if="errors.title" class="text-danger">{{
                errors.title
              }}</small>
            </div>
            <div class="form-group">
              <label for="deskripsi" class="form-control-label"
                >Deskripsi</label
              >
              <QuillEditor
                v-model:content="artikel.deskripsi"
                contentType="html"
                :options="options"
              />
              <!-- <textarea
                name="deskripsi"
                class="form-control"
                v-model="artikel.deskripsi"
                :class="{ 'is-invalid': errors.deskripsi }"
                placeholder="Masukan Deskripsi"
              ></textarea> -->

              <small v-if="errors.deskripsi" class="text-danger">{{
                errors.deskripsi
              }}</small>
            </div>
            <div class="form-group">
              <label for="image" class="form-control-label d-block"
                >Gambar</label
              >
              <img
                :src="imgPreview"
                width="300"
                style="max-width: 100%"
                class="mb-2"
                v-if="imgPreview"
                alt=""
              />
              <img
                :src="assetUrl + 'storage/' + artikel.image"
                width="300"
                style="max-width: 100%"
                class="mb-2"
                v-else-if="artikel.image"
                alt=""
              />
              <button
                v-if="artikel.image || imgPreview"
                type="button"
                class="btn btn-sm btn-dark p-2 ms-2"
                v-on:click="defaultImg"
              >
                Hapus Gambar
              </button>
              <input
              id="image"
                name="image"
                type="file"
                ref="fileInput"
                v-on:change="changeImg"
                class="form-control"
                :class="{ 'is-invalid': errors.image }"
                placeholder="Masukan Gambar"
              />
              <small v-if="errors.image" class="text-danger">{{
                errors.image
              }}</small>
            </div>
            <div class="form-group">
              <label for="kategori" class="form-control-label">Kategori</label>
              <select
              id="kategori"
                name="id_kategori"
                class="form-select"
                v-model="artikel.id_kategori"
                :class="{ 'is-invalid': errors.id_kategori }"
              >
                <option value="" selected>Pilih Kategori</option>
                <option
                  v-for="kategori in kategoris"
                  :key="kategori.id"
                  :value="kategori.id"
                >
                  {{ kategori.name_kategori }}
                </option>
              </select>
              <small v-if="errors.id_kategori" class="text-danger">{{
                errors.id_kategori
              }}</small>
            </div>
            <div class="d-flex flex-column flex-sm-row">
              <button
              type="button"
                v-on:click="backValue"
                class="btn btn-success btn-sm mb-0"
              >
                Ulang
              </button>
              <button class="btn btn-primary btn-sm ms-sm-auto my-1 my-sm-0">
                Submit
              </button>
              <button
                type="reset"
                v-on:click="resetButton"
                class="btn btn-secondary btn-sm mb-0 ms-sm-1"
              >
                Reset
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>
  
<script>
export default {
  name: "EditAnggota",
  inject: ["assetUrl"],
  props: {
    kategoris: Object,
    artikels: Object,
  },
  data() {
    return {
      artikel: {
        title: "",
        deskripsi: "",
        id_kategori: "",
      },
      options: {
        modules: {
          toolbar: [
            ["bold", "italic", "underline", "strike"], // toggled buttons
            [{ list: "ordered" }, { list: "bullet" }],
            [{ script: "sub" }, { script: "super" }], // superscript/subscript
            [{ header: [4, 5, 6, false] }],
            [{ color: [] }, { background: [] }], // dropdown with defaults from theme
            ["link"], // add's image support
          ],
        },
        placeholder: "Masukan Deskripsi",
        theme: "snow",
      },
      errors: {},
      imgPreview: "",
      default: false,
    };
  },
  watch: {
    artikels: {
      immediate: true,
      async handler(items) {
        // console.log(items);
        // Ketika anggotas berubah (setelah loading selesai), ambil data anggota dengan ID yang sesuai
        if (items.length > 0) {
          this.id_artikel = this.$route.params.id;
          const artikel = items.find((k) => k.id == this.id_artikel);
          if (artikel) {
            if (artikel.deskripsi === null) {
              artikel.deskripsi = "";
            }
            this.artikel = artikel;
            // document.querySelector(".ql-editor").innerHTML = (this.artikel.deskripsi ? this.artikel.deskripsi : '');
          } else {
            await Swal.fire({
              title: "ID Tidak Tersedia",
              icon: "warning",
            });
            this.$router.push({ name: "IndexArtikel" });
          }
        }
      },
    },
  },
  methods: {
    async formOnSubmit() {
      // this.error.nama = 'kocag';
      try {
        const parser = new DOMParser();
        const htmlDoc = parser.parseFromString(
          this.artikel.deskripsi,
          "text/html"
        );

        const processElement = (element) => {
          const children = element.childNodes;
          for (let i = children.length - 1; i >= 0; i--) {
            const child = children[i];
            if (child.nodeType === Node.ELEMENT_NODE) {
              processElement(child);
              if (child.innerHTML.trim() === "") {
                element.removeChild(child);
              }
            }
          }
        };

        const root = htmlDoc.body;
        processElement(root);

        if (root.innerHTML.trim() === "") {
          this.artikel.deskripsi = "";
        } else {
          this.artikel.deskripsi = root.innerHTML;
        }

        const formData = new FormData();
        formData.append("_method", "put");
        formData.append("title", this.artikel.title);
        formData.append("deskripsi", this.artikel.deskripsi);
        formData.append("id_kategori", this.artikel.id_kategori);
        if (this.default) {
          formData.append("default", this.default);
        }
        // console.log(!this.imgPreview);
        if (this.artikel.image && this.imgPreview) {
          formData.append("image", this.artikel.image);
        }
        // console.log(formData.get());
        const user = await axios.post("artikel/" + this.id_artikel, formData);
        this.artikel = {};
        this.artikel.id_kategori = "";
        this.errors = {};
        this.$emit("getArtikel");
        await Swal.fire({
          title: user.data.message,
          icon: "success",
        });
        this.$router.push({ name: "IndexArtikel" });
      } catch (e) {
        // console.log(e.response.data.errors);
        await Swal.fire({
          title: e.response.data.message,
          icon: "warning",
        });
        this.errors = e.response.data.errors;
        // console.log(e.response.data.errors);
      }
    },
    changeImg(e) {
      this.artikel.image = e.target.files[0];
      this.imgPreview = URL.createObjectURL(e.target.files[0]);
      this.default = false;
    },
    backValue() {
      this.$emit("getArtikel");
      this.errors = {};
      // document.querySelector(".ql-editor").textContent = "";
      const anggota = this.artikels.find((k) => k.id == this.id_artikel);
      if (anggota) {
        $('#image').val('');
        this.anggota = anggota;
        this.imgPreview = "";
        this.default = false;
        // console.log(anggota);
      }
    },
    back() {
      this.$emit("back");
      this.$emit("getArtikel");
      this.$router.push({ name: "IndexArtikel" });
    },
    async resetButton() {
      // console.log(!this.default);
      if (!this.default && this.artikel.image) {
        const result = await Swal.fire({
          text: `Apakah anda ingin mengubah ke gambar default ?`,
          icon: "question",
          showCancelButton: true,
          confirmButtonColor: "#d33",
          cancelButtonColor: "#3085d6",
          confirmButtonText: "Hapus",
          cancelButtonText: "Tidak",
        });
        if (result.isConfirmed) {
          this.defaultImg();
        }
      }
      this.artikel.title = "";
      this.artikel.deskripsi = "";
      this.artikel.id_kategori = "";
      document.querySelector(".ql-editor").textContent = "";
      this.errors = {};
    },
    defaultImg() {
      $('#image').val('');
      this.imgPreview = "";
      this.artikel.image = "";
      this.default = true;
    },
  },
};
</script>
  
<style></style>
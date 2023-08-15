<template>
  <div class="row">
    <div class="col-12 mb-lg-0 mb-4">
      <div class="card">
        <div class="card-header pb-0">
          <div class="d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Edit Sharing</h4>
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
                v-model="sharing.title"
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
                v-model:content="sharing.deskripsi"
                contentType="html"
                :options="options"
              />
              <!-- <textarea
                name="deskripsi"
                class="form-control"
                v-model="sharing.deskripsi"
                :class="{ 'is-invalid': errors.deskripsi }"
                placeholder="Masukan Deskripsi"
              ></textarea> -->

              <small v-if="errors.deskripsi" class="text-danger">{{
                errors.deskripsi
              }}</small>
            </div>
            <div class="form-group">
              <label for="jadwal" class="form-control-label">Jadwal</label>
              <VDatePicker
                :key="selectedDate"
                v-model="selectedDate"
                mode="dateTime"
                locale="id"
                is24hr
                :popover="popover"
                :min-date="afterToday"
                :is-dark="isDark"
              >
                <template #default="{ inputValue, inputEvents }">
                  <input
                    type="text"
                    :value="inputValue"
                    class="form-control"
                    :class="{ 'is-invalid': errors.jadwal }"
                    placeholder="Masukan Jadwal"
                    v-on="inputEvents"
                  />
                </template>
              </VDatePicker>
              <small v-if="errors.jadwal" class="text-danger">{{
                errors.jadwal
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
                :src="assetUrl + 'storage/' + sharing.image"
                width="300"
                style="max-width: 100%"
                class="mb-2"
                v-else-if="sharing.image"
                alt=""
              />
              <button
                v-if="sharing.image || imgPreview"
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
                v-model="sharing.id_kategori"
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
import { format } from "date-fns";
export default {
  name: "EditAnggota",
  inject: ["assetUrl"],
  props: {
    kategoris: Object,
    sharings: Object,
    isDark: Boolean
  },
  data() {
    return {
      sharing: {
        title: "",
        deskripsi: "",
        jadwal: "",
        id_kategori: "",
      },
      afterToday: new Date().setDate(new Date().getDate() + 1),
      popover: {
        visibility: "click",
      },
      selectedDate: null,
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
    selectedDate(newValue) {
      if (newValue) {
        // console.log(newValue);
        const formattedDate = format(newValue, "yyyy-MM-dd HH:mm:ss");
        this.sharing.jadwal = formattedDate;
      }
    },
    sharings: {
      immediate: true,
      async handler(items) {
        // console.log(items);
        // Ketika anggotas berubah (setelah loading selesai), ambil data anggota dengan ID yang sesuai
        if (items.length > 0) {
          this.id_sharing = this.$route.params.id;
          const sharing = items.find((k) => k.id == this.id_sharing);
          if (sharing) {
            if (sharing.deskripsi === null) {
              sharing.deskripsi = "";
            }
            this.selectedDate = new Date(sharing.jadwal);
            this.sharing = sharing;
            // document.querySelector(".ql-editor").innerHTML = (this.sharing.deskripsi ? this.sharing.deskripsi : '');
          } else {
            await Swal.fire({
              title: "ID Tidak Tersedia",
              icon: "warning",
            });
            this.$router.push({ name: "IndexSharing" });
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
          this.sharing.deskripsi,
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
          this.sharing.deskripsi = "";
        } else {
          this.sharing.deskripsi = root.innerHTML;
        }

        const formData = new FormData();
        formData.append("_method", "put");
        formData.append("title", this.sharing.title);
        formData.append("deskripsi", this.sharing.deskripsi);
        formData.append("jadwal", this.sharing.jadwal);
        formData.append("id_kategori", this.sharing.id_kategori);
        if (this.default) {
          formData.append("default", this.default);
        }
        // console.log(!this.imgPreview);
        if (this.sharing.image && this.imgPreview) {
          formData.append("image", this.sharing.image);
        }
        // console.log(formData.get());
        const user = await axios.post("sharing/" + this.id_sharing, formData);
        this.sharing = {};
        this.sharing.id_kategori = "";
        this.errors = {};
        this.$emit("getSharing");
        await Swal.fire({
          title: user.data.message,
          icon: "success",
        });
        this.$router.push({ name: "IndexSharing" });
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
      this.sharing.image = e.target.files[0];
      this.imgPreview = URL.createObjectURL(e.target.files[0]);
      this.default = false;
    },
    backValue() {
      this.$emit("getSharing");
      this.errors = {};
      // document.querySelector(".ql-editor").textContent = "";
      const anggota = this.sharings.find((k) => k.id == this.id_sharing);
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
      this.$emit("getSharing");
      this.$router.push({ name: "IndexSharing" });
    },
    async resetButton() {
      // console.log(!this.default);
      if (!this.default && this.sharing.image) {
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
      this.sharing.title = "";
      this.sharing.deskripsi = "";
      this.sharing.jadwal = "";
      this.sharing.id_kategori = "";
      this.selectedDate = null;
      document.querySelector(".ql-editor").textContent = "";
      this.errors = {};
    },
    defaultImg() {
      $('#image').val('');
      this.imgPreview = "";
      this.sharing.image = "";
      this.default = true;
    },
  },
};
</script>
  
<style></style>
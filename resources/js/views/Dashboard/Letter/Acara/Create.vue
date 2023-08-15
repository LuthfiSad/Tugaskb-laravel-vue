<template>
  <div class="row">
    <div class="col-12 mb-lg-0 mb-4">
      <div class="card">
        <div class="card-header pb-0">
          <div class="d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Tambah Acara</h4>
            <router-link
              to="/dashboard/acara"
              class="badge border-0 bg-gradient-danger"
              >back</router-link
            >
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
                name="title"
                id="title"
                v-model="acara.title"
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
                v-model:content="acara.deskripsi"
                contentType="html"
                :options="options"
              />
              <!-- <textarea
                name="deskripsi"
                class="form-control"
                v-model="acara.deskripsi"
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
                v-model="selectedDate"
                mode="dateTime"
                locale="id"
                :is-dark="isDark"
                is24hr
                :popover="popover"
                :min-date="afterToday"
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
              <button
                v-if="acara.image || imgPreview"
                type="button"
                class="btn btn-sm btn-dark p-2 ms-sm-2"
                v-on:click="defaultImg"
              >
                Hapus Gambar
              </button>
              <input
                id="image"
                name="image"
                type="file"
                v-on:change="changeImg"
                class="form-control"
                :class="{ 'is-invalid': errors.image }"
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
                v-model="acara.id_kategori"
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
              <button class="btn btn-primary btn-sm mb-0 ms-sm-auto">
                Submit
              </button>
              <button
                type="reset"
                v-on:click="resetButton"
                class="btn btn-secondary btn-sm mb-0 ms-sm-1 mt-1 mt-sm-0"
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
  name: "CreateAcara",
  props: {
    kategoris: Object,
    isDark: Boolean
  },
  watch: {
    selectedDate(newValue) {
      if (newValue) {
        const formattedDate = format(newValue, "yyyy-MM-dd HH:mm:ss");
        this.acara.jadwal = formattedDate;
      }
    },
  },
  data() {
    return {
      acara: {
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
    };
  },
  methods: {
    async formOnSubmit() {
      // console.log(this.afterToday);
      // this.error.nama = 'kocag';
      try {
        // alert(this.acara.title);
        const parser = new DOMParser();
        const htmlDoc = parser.parseFromString(
          this.acara.deskripsi,
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
          this.acara.deskripsi = "";
        } else {
          this.acara.deskripsi = root.innerHTML;
        }
        // input
        const formData = new FormData();
        formData.append("title", this.acara.title);
        formData.append("deskripsi", this.acara.deskripsi);
        formData.append("jadwal", this.acara.jadwal);
        formData.append("id_kategori", this.acara.id_kategori);
        if (this.acara.image) {
          formData.append("image", this.acara.image);
        }
        // console.log(formData);
        const user = await axios.post("acara", formData);
        (this.acara = {
          title: "",
          deskripsi: "",
          jadwal: "",
          id_kategori: "",
        }),
          (this.errors = {});
        this.$emit("getAcara");
        await Swal.fire({
          title: user.data.message,
          icon: "success",
        });
        this.$router.push({ name: "IndexAcara" });
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
      this.acara.image = e.target.files[0];
      this.imgPreview = URL.createObjectURL(e.target.files[0]);
    },
    resetButton() {
      // this.$refs.quillEditor.value = "";
      // console.log(this.$refs.quillEditor);
      document.querySelector(".ql-editor").textContent = "";
      (this.acara = {
        title: "",
        deskripsi: "",
        jadwal: "",
        id_kategori: "",
      }),
        (this.imgPreview = "");
      this.errors = {};
    },
    defaultImg() {
      // console.log($('#image').val());
      $("#image").val("");
      this.imgPreview = "";
      this.acara.image = "";
    },
  },
};
</script>

<style>
</style>
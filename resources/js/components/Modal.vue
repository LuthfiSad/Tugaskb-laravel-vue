<template>
  <div
    class="modal fade"
    id="modal"
    tabindex="-1"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content card">
        <div class="modal-header">
          <h1 class="modal-title fs-5 text-capitalize">Tambah {{ status }}</h1>
          <button
            type="button"
            class="btn-close"
            style="filter: invert(0.6)"
            data-bs-dismiss="modal"
            aria-label="Close"
          ></button>
        </div>
        <form v-on:submit.prevent="formOnSubmit">
          <div class="modal-body row justify-content-between">
            <div class="form-group col-12 col-lg-7 my-auto pb-3">
              <label for="nama" class="form-control-label text-capitalize"
                >{{ status }} Baru</label
              >
              <input
                v-model="input"
                type="text"
                class="form-control"
                :class="{ 'is-invalid': errors }"
                :name="status"
                :placeholder="'Masukan ' + status + ' Baru'"
              />
              <small v-if="errors" class="text-danger">{{ errors }}</small>
            </div>
            <div class="col-11 col-md-9 col-sm-10 col-lg-4">
              <div class="row justify-content-between">
                <label
                  class="text-lg-center col-5 col-sm-5 col-lg-12 m-0 my-auto text-capitalize"
                  >Data {{ status }} :
                </label>
                <div
                  class="col-7 col-lg-12 col-sm-7"
                  v-if="status == 'angkatan'"
                  id="list"
                >
                  <div
                    class="d-flex justify-content-between pb-1"
                    v-for="(data, index) in angkatans"
                    :key="data.id"
                  >
                    <small>{{ index + 1 }}. {{ data.angkatan }}</small>
                    <button
                      type="button"
                      v-on:click="deleted(data.id, data.angkatan,status)"
                      class="badge badge-sm text-capitalize border-0 bg-danger"
                    >
                      Delete
                    </button>
                  </div>
                </div>
                <div
                  class="col-7 col-lg-12 col-sm-7"
                  v-if="status == 'kategori'"
                  id="list"
                >
                  <div
                    class="d-flex justify-content-between pb-1"
                    v-for="(data, index) in kategoris"
                    :key="data.id"
                  >
                    <small>{{ index + 1 }}. {{ data.name_kategori }}</small>
                    <button
                      type="button"
                      v-on:click="deleted(data.id, data.name_kategori, status)"
                      class="badge badge-sm text-capitalize border-0 bg-danger"
                    >
                      Delete
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button
              type="reset"
              v-on:click="resetButton"
              class="btn btn-secondary m-0 me-auto"
            >
              Reset
            </button>
            <button type="submit" class="btn btn-primary m-0">Tambah</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    angkatans: Object,
    kategoris: Object,
  },
  data() {
    return {
      input: "",
      datas: [],
      errors: "",
      status: "",
    };
  },
  watch: {
    $route: {
      immediate: true,
      async handler(items) {
        // console.log(this.angkatans);
        // await this.$emit("getAngkatan");
        if (items.meta.name == "Anggota") {
          this.status = "angkatan";
          // this.data = this.angkatans
        } else {
          this.status = "kategori";
        }
        $("#modal").modal("hide");
        this.errors = "";
        this.input = "";
      },
    },
    // angkatans: {
    //   immediate: true,
    //   handler(items) {
    //     if (this.$route.meta.name == "Anggota") {
    //       this.datas = items;
    //     } else {
    //       this.datas = this.kategoris;
    //     }
    //     // console.log(items);
    //   },
    // }
  },
  // created(){
  //   if (this.$route.meta.name == "Anggota") {
  //         this.datas = this.angkatans
  //         console.log(this.datas);
  //   } else {
  //   }
  // },
  // mounted(){
  
    
  // },
  methods: {
    async formOnSubmit() {
      // this.error.nama = 'kocag';
      try {
        if (this.status == "angkatan") {
          const item = await axios.post("angkatan", {
            angkatan: this.input,
          });
          this.$emit("getAngkatan");
          await Swal.fire({
            title: item.data.message,
            icon: "success",
          });
        } else {
          const item = await axios.post("kategori", {
            name_kategori: this.input,
          });
          this.$emit("getKategori");
          await Swal.fire({
            title: item.data.message,
            icon: "success",
          });
        }
        this.input = "";
        this.errors = "";
        $("#modal").modal("hide");
      } catch (e) {
        // console.log(e.response.data.errors);
        await Swal.fire({
          title: e.response.data.message,
          icon: "warning",
        });
        if (this.status == "angkatan") {
          this.errors = e.response.data.errors.angkatan;
        } else {
          this.errors = e.response.data.errors.name_kategori;
        }
        // console.log(e.response.data.errors);
      }
    },
    async deleted(id, name, status) {
      // const konfirmasi = confirm('Apakah Benar ingin Menghapus Data');
      // console.log(konfirmasi);
      try {
        const result = await Swal.fire({
          text: `Apakah Benar anda ingin menghapus ini ?`,
          icon: "question",
          showCancelButton: true,
          confirmButtonColor: "#d33",
          cancelButtonColor: "#3085d6",
          confirmButtonText: "Hapus",
        });

        if (result.isConfirmed) {
          const result = await Swal.fire({
            text: `Semua data dengan ${status} ${name} akan terhapus juga loh ?`,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Hapus!!",
          });
          if (result.isConfirmed) {
            if (this.status == "angkatan") {
              const response = await axios.delete("angkatan/" + id);
              this.$emit("getAngkatan");
              this.$emit("getAnggota");
              await Swal.fire({
                title: response.data.message,
                icon: "success",
              });
            } else {
              const response = await axios.delete("kategori/" + id);
              this.$emit("getKategori");
              this.$emit("get"+this.$route.meta.name);
              await Swal.fire({
                title: response.data.message,
                icon: "success",
              });
            }
            $("#modal").modal("hide");
          }
        }
      } catch (error) {
        // Handle error
        console.error(error);
      }
      // if(konfirmasi){
      // const user = await axios.delete("anggota/" + id);
      // // console.log();
      // alert(user.data.message);
      // this.$emit('updateAnggota');
      // }
    },
    resetButton() {
      this.input = "";
      this.errors = "";
    },
  },
};
</script>

<style scoped>
#list {
  max-height: 150px;
  overflow-y: scroll;
}
#list::-webkit-scrollbar {
  width: 10px;
}

/* Track */
#list::-webkit-scrollbar-track {
  background: #f1f1f1;
}

/* Handle */
#list::-webkit-scrollbar-thumb {
  background: #888;
}

/* Handle on hover */
#list::-webkit-scrollbar-thumb:hover {
  background: #555; 
}
</style>
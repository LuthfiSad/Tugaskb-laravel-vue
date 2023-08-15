<template>
  <div class="row">
    <div class="col-12 mb-lg-0 mb-4">
      <!-- <div class="alert alert-primary col-md-6 fade show text-white" role="alert">
        sukses
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div> -->
      <div class="card z-index-2">
        <div
          class="card-header py-3 bg-transparent d-flex justify-content-between align-items-center"
        >
          <h3 class="text-capitalize m-0">Data Artikel</h3>
          <router-link
            to="artikel/create"
            class="btn bg-gradient-primary px-1 mt-2 mb-0"
            >Tambah Artikel</router-link
          >
        </div>
        <div class="card-body pt-0">
          <div class="table-responsive p-0">
            <DataTable :key="artikels.length" class="table align-items-center mb-0">
              <thead>
                <tr>
                  <td
                    class="text-center text-uppercase text-xxs font-weight-bolder opacity-7"
                  >
                    No
                  </td>
                  <td
                    class="text-uppercase text-xxs font-weight-bolder opacity-7"
                  >
                    Title
                  </td>
                  <td
                    class="text-uppercase text-xxs font-weight-bolder opacity-7"
                  >
                    Nama Kategori
                    <button
                      class="border-0 badge badge-sm ms-1 bg-gradient-primary"
                      type="button"
                      data-bs-toggle="modal"
                      data-bs-target="#modal"
                    >
                      <i class="fa-solid fa-plus fw-bold"></i>
                    </button>
                  </td>
                  <td
                    class="text-center text-uppercase text-xxs font-weight-bolder opacity-7"
                  >
                    Aksi
                  </td>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(artikel, index) in artikels" :key="artikel.id">
                  <td class="text-center">
                    <p class="text-xs mb-0">{{ index + 1 }}</p>
                  </td>
                  <td>
                    <h6 class="mb-0 text-sm">{{ artikel.title }}</h6>
                  </td>
                  <td>
                    <p class="text-xs font-weight-bold mb-0">
                      {{ artikel.name_kategori }}
                    </p>
                  </td>
                  <td class="align-middle text-center" id="aksi">
                    <router-link
                      :to="'/dashboard/artikel/detail/' + artikel.id"
                      class="badge badge-sm bg-gradient-success font-weight-bold text-xs"
                    >
                      Detail
                    </router-link>
                    <router-link
                      :to="'/dashboard/artikel/edit/' + artikel.id"
                      class="badge badge-sm mx-2 bg-gradient-warning font-weight-bold text-xs"
                    >
                      Edit
                    </router-link>

                    <button
                      v-on:click="deletedArtikel(artikel.id, artikel.title)"
                      class="badge badge-sm border-0 bg-gradient-danger font-weight-bold text-xs"
                    >
                      Delete
                    </button>
                  </td>
                </tr>
              </tbody>
            </DataTable>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>

export default {
  name: "IndexArtikel",
  props: {
    artikels: Object,
  },
  // mounted(){
  //   console.log(this.artikels);
  // },
  methods: {
    async deletedArtikel(id, title) {
      // const konfirmasi = confirm('Apakah Benar ingin Menghapus Data');
      // console.log(konfirmasi);
      try {
        const result = await Swal.fire({
          text: `Apakah Benar anda ingin menghapus ${title} ?`,
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#d33",
          cancelButtonColor: "#3085d6",
          confirmButtonText: "Hapus!!",
        });

        if (result.isConfirmed) {
          const response = await axios.delete("artikel/" + id);
          this.$emit("getArtikel");
          await Swal.fire({
            title: response.data.message,
            icon: "success",
          });
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
  },
};
</script>

<style></style>
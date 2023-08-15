<template>
  <div class="row">
    <div class="col-12 mb-lg-0 mb-4">
      <!-- <div class="alert alert-primary col-md-6 fade show text-white" role="alert">
        sukses
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div> -->
      <div class="card z-index-2">
        <div class="card-header py-3 bg-transparent d-flex justify-content-between align-items-center">
          <h3 class="text-capitalize m-0">Data Anggota</h3>
          <router-link to="anggota/create" class="btn bg-gradient-primary px-1 mt-2 mb-0">Tambah Anggota</router-link>
        </div>
        <div class="card-body pt-0">
          <div class="table-responsive p-0">
            <DataTable :key="anggotas.length" class="table align-items-center mb-0">
              <thead>
                <tr>
                  <td class="text-center text-uppercase text-xxs font-weight-bolder opacity-7">
                    No
                  </td>
                  <td class="text-uppercase text-xxs font-weight-bolder opacity-7">
                    Nama
                  </td>
                  <td class="text-uppercase text-xxs font-weight-bolder opacity-7">
                    Nim
                  </td>
                  <td class="text-uppercase text-xxs font-weight-bolder opacity-7">
                    Nomor HP
                  </td>
                  <td class="text-uppercase text-xxs font-weight-bolder opacity-7">
                    Email
                  </td>
                  <td class="text-uppercase text-xxs font-weight-bolder opacity-7">
                    Angkatan
                    <button class="border-0 badge badge-sm ms-1 bg-gradient-primary" type="button" data-bs-toggle="modal"
                      data-bs-target="#modal">
                      <i class="fa-solid fa-plus fw-bold"></i>
                    </button>
                  </td>
                  <td class="text-center text-uppercase text-xxs font-weight-bolder opacity-7">
                    Aksi
                  </td>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(anggota, index) in anggotas" :key="anggota.id">
                  <td class="text-center">
                    <p class="text-xs mb-0">{{ index+1 }}</p>
                  </td>
                  <td>
                    <h6 class="mb-0 text-sm">{{ anggota.name }}</h6>
                  </td>
                  <td>
                    <p class="text-xs font-weight-bold mb-0">{{ anggota.nim }}</p>
                  </td>
                  <td>
                    <p class="text-xs font-weight-bold mb-0">{{ anggota.no_hp }}</p>
                  </td>
                  <td>
                    <p class="text-xs font-weight-bold mb-0">{{ anggota.email }}</p>
                  </td>
                  <td>
                    <p class="text-xs font-weight-bold mb-0">{{ anggota.angkatan }}</p>
                  </td>
                  <td class="align-middle text-center" id="aksi">
                    <!-- <a href="mahasiswa/{{ $mahasiswa->nim }}"
                      class="badge badge-sm bg-gradient-success font-weight-bold text-xs">
                      Detail
                    </a> -->
                    <router-link :to="'/dashboard/anggota/edit/'+anggota.id"
                      class="badge badge-sm me-1 bg-gradient-warning font-weight-bold text-xs">
                      Edit
                    </router-link>

                    <button v-on:click="deletedAnggota(anggota.id, anggota.name)"
                      class="badge badge-sm border-0 ms-1 bg-gradient-danger font-weight-bold text-xs">
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
  name: "IndexAnggota",
  props: {
    angkatans: Object,
    anggotas: Object,
  },
  methods:{
    async deletedAnggota(id, name){
      // const konfirmasi = confirm('Apakah Benar ingin Menghapus Data');
      // console.log(konfirmasi);
      try {
        const result = await Swal.fire({
          text: `Apakah Benar anda ingin menghapus ${name} ?`,
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#d33',
          cancelButtonColor: '#3085d6',
          confirmButtonText: 'Hapus!!'
        });

        if (result.isConfirmed) {
          const response = await axios.delete("anggota/" + id);
          this.$emit('getAnggota');
          await Swal.fire({
            title: response.data.message,
            icon: 'success'
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
    }
  }
}
</script>

<style></style>
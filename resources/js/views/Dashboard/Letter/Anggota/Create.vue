<template>
  <div class="row">
    <div class="col-12 mb-lg-0 mb-4">
      <div class="card">
        <div class="card-header pb-0">
          <div class="d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Tambah Anggota</h4>
            <router-link to="/dashboard/anggota" class="badge border-0 bg-gradient-danger">back</router-link>
          </div>
        </div>
        <div class="card-body">
          <form v-on:submit.prevent="formOnSubmit">
            <div class="form-group">
              <label for="nama" class="form-control-label">Nama Lengkap</label>
              <input id="nama" name="nama" v-model="anggota.name" type="text" class="form-control"
                :class="{ 'is-invalid': errors.name }" placeholder="Masukan Nama" />
              <small v-if="errors.name" class="text-danger">{{ errors.name }}</small>
            </div>
            <div class="form-group">
              <label for="nim" class="form-control-label">NIM</label>
              <input id="nim" name="nim" type="number" class="form-control" :class="{ 'is-invalid': errors.nim }"
                v-model="anggota.nim" placeholder="Masukan NIM" />
              <small v-if="errors.nim" class="text-danger">{{ errors.nim }}</small>
            </div>
            <div class="form-group">
              <label for="no_hp" class="form-control-label">No HP</label>
              <input id="no_hp" name="no_hp" type="tel" class="form-control" :class="{ 'is-invalid': errors.no_hp }"
                v-model="anggota.no_hp" placeholder="Masukan Nomor HP" />
              <small v-if="errors.no_hp" class="text-danger">{{ errors.no_hp }}</small>
            </div>
            <div class="form-group">
              <label for="email" class="form-control-label">Email</label>
              <input id="email" name="email" type="email" class="form-control" :class="{ 'is-invalid': errors.email }"
                v-model="anggota.email" placeholder="Masukan Email" />
              <small v-if="errors.email" class="text-danger">{{ errors.email }}</small>
            </div>
            <div class="form-group">
              <label for="angkatan" class="form-control-label">Angkatan</label>
              <select id="angkatan" class="form-select" v-model="anggota.id_angkatan"
                :class="{ 'is-invalid': errors.id_angkatan }">
                <option value='' selected>Pilih Angkatan</option>
                <option v-for="angkatan in angkatans" :key="angkatan.id" :value="angkatan.id">{{ angkatan.angkatan }}
                </option>
              </select>
              <small v-if="errors.id_angkatan" class="text-danger">{{ errors.id_angkatan }}</small>
            </div>
            <div class="d-flex">
              <button class="btn btn-primary btn-sm mb-0 ms-auto">
                Submit
              </button>
              <button type="reset" v-on:click="resetButton" class="btn btn-secondary btn-sm mb-0 ms-1">
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
  name: "CreateAnggota",
  props: {
    angkatans: Object,
  },
  data() {
    return {
      anggota: {
        id_angkatan: ''
      },
      errors: {}
    }
  },
  methods: {
    async formOnSubmit() {
      // this.error.nama = 'kocag';
      try {
        const user = await axios.post("anggota",
          {
            name: this.anggota.name,
            nim: this.anggota.nim,
            no_hp: this.anggota.no_hp,
            email: this.anggota.email,
            id_angkatan: this.anggota.id_angkatan
          }
        );
        this.anggota = {};
        this.anggota.id_angkatan = '';
        this.errors = {};
        this.$emit('getAnggota');
        await Swal.fire({
            title: user.data.message,
            icon: 'success'
        });
        this.$router.push({ name: 'IndexAnggota' });
      } catch (e) {
        // console.log(e.response.data.errors);
        await Swal.fire({
            title: e.response.data.message,
            icon: 'warning'
        });
        this.errors = e.response.data.errors;
        // console.log(e.response.data.errors);
      }
    },
    resetButton(){
      this.anggota = {};
      this.anggota.id_angkatan = '';
      this.errors = {};
    }
  }
};
</script>

<style></style>
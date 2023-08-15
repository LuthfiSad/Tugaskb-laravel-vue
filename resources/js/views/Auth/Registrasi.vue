<template>
  <h1 class="text-center" style="font-size: 4rem">Registration</h1>
  <div class="row">
    <div class="col-md d-none d-md-block">
      <img
        :src="this.assetUrl + 'assets/images/HIMTI.png'"
        class="w-100"
        alt="HIMTI"
      />
    </div>
    <div class="col-md-7 my-auto">
      <form v-on:submit.prevent="formOnSubmit">
        <div class="form-row">
          <label for="nama" class="col-sm-5 col-form-label">Nama</label>
          <div class="col-md-7 mb-2">
            <input
              v-model="user.name"
              type="text"
              class="form-control"
              id="nama"
              placeholder="Masukan Nama"
            />
            <small v-if="errors.name" class="text-danger text-center d-block">{{
              errors.name
            }}</small>
          </div>
        </div>
        <div class="form-row">
          <label for="mobile" class="col-sm-5 col-form-label">Mobile</label>
          <div class="col-md-7 mb-2">
            <input
              v-model="user.no_hp"
              type="tel"
              class="form-control"
              id="mobile"
              placeholder="Masukan Mobile"
            />
            <small
              v-if="errors.no_hp"
              class="text-danger text-center d-block"
              >{{ errors.no_hp }}</small
            >
          </div>
        </div>
        <div class="form-row">
          <label for="email" class="col-sm-5 col-form-label">Email</label>
          <div class="col-md-7 mb-2">
            <input
              v-model="user.email"
              type="email"
              class="form-control"
              id="email"
              placeholder="Masukan Email"
            />
            <small
              v-if="errors.email"
              class="text-danger text-center d-block"
              >{{ errors.email }}</small
            >
          </div>
        </div>
        <div class="form-row">
          <label for="password" class="col-sm-5 col-form-label">Passwrod</label>
          <div class="col-md-7 mb-2">
            <div class="input-group">
              <input
                v-model="user.password"
                :type="password ? 'text' : 'password'"
                class="form-control"
                id="password"
                placeholder="Masukan Password"
              />
              <span
                v-on:mousedown="showPassword"
                v-on:mouseup="hidePassword"
                class="input-group-text p-0 px-2 border-0"
              >
                <i
                  class="fa-regular fa-eye-slash"
                  :class="password ? 'fa-eye' : 'fa-eye-slash'"
                ></i>
              </span>
            </div>
            <small
              v-if="errors.password"
              class="text-danger text-center d-block"
              >{{ errors.password }}</small
            >
          </div>
        </div>
        <div class="form-row">
          <label for="password_confirmation" class="col-sm-5 col-form-label"
            >Konfirmasi Password</label
          >
          <div class="col-md-7 mb-2">
            <div class="input-group">
              <input
                v-model="user.password_confirmation"
                :type="confirm ? 'text' : 'password'"
                class="form-control"
                id="password_confirmation"
                placeholder="Konfirmasi Password"
              />
              <span
                v-on:mousedown="showConfirm"
                v-on:mouseup="hideConfirm"
                class="input-group-text p-0 px-2 border-0"
              >
                <i
                  class="fa-regular fa-eye-slash"
                  :class="confirm ? 'fa-eye' : 'fa-eye-slash'"
                ></i>
              </span>
            </div>
            <small
              v-if="errors.password_confirmation"
              class="text-danger text-center d-block"
              >{{ errors.password_confirmation }}</small
            >
          </div>
        </div>
        <div class="form-check text-center">
          <input class="form-check-input" type="checkbox" id="remember" />
          <label class="form-check-label" for="remember"> Remember Me </label>
        </div>
        <div class="form-row">
          <div class="ml-auto">
            <button class="btn btn-primary">Submit</button>
            <button
              class="btn btn-secondary mx-2"
              v-on:click="resetButton"
              type="reset"
            >
              Reset
            </button>
          </div>
        </div>
      </form>
      <small class="d-block"
        >Already have an account?
        <router-link style="color: var(--blue)" to="/login"
          >login</router-link
        ></small
      >
      <small
        ><router-link style="color: var(--blue)" to="/home"
          >Back</router-link
        ></small
      >
    </div>
  </div>
</template>
  
  <script>
export default {
  name: "Registrasi",
  inject: ["assetUrl"],
  mounted() {
    document.body.removeAttribute("class");
  },
  data() {
    return {
      user: {},
      errors: {},
      password: false,
      confirm: false,
    };
  },
  methods: {
    async formOnSubmit() {
      // this.error.nama = 'kocag';
      try {
        const user = await axios.post("register", {
          name: this.user.name,
          no_hp: this.user.no_hp,
          email: this.user.email,
          password: this.user.password,
          password_confirmation: this.user.password_confirmation,
        });
        this.user = {};
        this.errors = {};
        await Swal.fire({
          title: user.data.message,
          icon: "success",
        });
        this.$router.push({ name: "Login" });
      } catch (e) {
        // console.log(e.response.data.errors);
        // console.log(e.response.data=);
        await Swal.fire({
          title: e.response.data.message,
          icon: "warning",
        });
        this.errors = e.response.data.errors;
      }
    },
    showPassword() {
      this.password = true;
    },
    hidePassword() {
      this.password = false;
    },
    showConfirm() {
      this.confirm = true;
    },
    hideConfirm() {
      this.confirm = false;
    },
    resetButton() {
      this.user = {};
      this.errors = {};
    },
  },
};
</script>
  
  <style></style>
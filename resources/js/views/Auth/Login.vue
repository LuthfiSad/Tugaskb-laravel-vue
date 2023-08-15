<template>
  <h1 class="text-center" style="font-size: 4rem">LOGIN</h1>
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
          <label for="email" class="col-sm-5 col-form-label">Email</label>
          <div class="col-md-7 mb-2">
            <input
              type="email"
              v-model="login.email"
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
              :type="password ? 'text' : 'password'"
              v-model="login.password"
              class="form-control"
              id="password"
              placeholder="Masukan Password"
            />
            <span
              v-on:mousedown="showPassword"
              v-on:mouseup="hidePassword"
              class="input-group-text p-0 px-2 border-0"
            >
              <i class="fa-regular fa-eye-slash" :class="password ? 'fa-eye' : 'fa-eye-slash'"></i>
            </span>
          </div>
            <!-- <i class="fa-regular fa-eye-slash"></i> -->
            <small
              v-if="errors.password"
              class="text-danger text-center d-block"
              >{{ errors.password }}</small
            >
          </div>
        </div>
        <div class="form-check text-center">
          <input class="form-check-input" type="checkbox" id="remember" />
          <label class="form-check-label" for="remember"> Remember Me </label>
        </div>
        <div class="auto form-row">
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
        >don't have account?
        <router-link style="color: var(--blue)" to="/registrasi"
          >registration</router-link
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
  name: "Login",
  inject: ["assetUrl"],
  mounted() {
    document.body.removeAttribute("class");
  },
  data() {
    return {
      login: {},
      errors: {},
      password: false
    };
  },
  methods: {
    async formOnSubmit() {
      // this.error.nama = 'kocag';
      try {
        const login = await axios.post("login", {
          email: this.login.email,
          password: this.login.password,
        });
        this.login = {};
        this.errors = {};
        await Swal.fire({
          title: login.data.message,
          icon: "success",
        });
        localStorage.setItem(
          "data",
          JSON.stringify({
            token: login.data.token,
            login: true,
          })
        );
        window.location.href = "/dashboard";
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
    resetButton() {
      this.login = {};
      this.errors = {};
    },
  },
};
</script>


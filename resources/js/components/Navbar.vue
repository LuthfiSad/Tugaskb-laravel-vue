<template>
  <header id="header-section">
    <nav class="navbar navbar-expand-lg pl-3 pl-sm-0" id="navbar">
      <div class="container">
        <div class="navbar-brand-wrapper d-flex w-100">
          <img
            :src="assetUrl + 'assets/images/HIMTI.png'"
            alt=""
            eight="h75"
            width="75"
          />
          <button
            class="navbar-toggler ml-auto"
            type="button"
            data-toggle="collapse"
            data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span class="mdi mdi-menu navbar-toggler-icon"></span>
          </button>
        </div>
        <div
          class="collapse navbar-collapse navbar-menu-wrapper"
          id="navbarSupportedContent"
        >
          <ul
            class="navbar-nav align-items-lg-center align-items-start ml-auto"
          >
            <li
              class="d-flex align-items-center justify-content-between pl-4 pl-lg-0"
            >
              <div class="navbar-collapse-logo">
                <img :src="assetUrl + 'assets/images/Group12.svg'" alt="" />
              </div>
              <button
                class="navbar-toggler close-button"
                type="button"
                data-toggle="collapse"
                data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false"
                aria-label="Toggle navigation"
              >
                <span class="mdi mdi-close navbar-toggler-icon pl-5"></span>
              </button>
            </li>
            <li class="nav-item">
              <router-link class="nav-link" to="/home">Home</router-link>
            </li>
            <li class="nav-item">
              <router-link class="nav-link" to="/tentang">Tentang</router-link>
            </li>
            <li class="nav-item">
              <router-link class="nav-link" to="/sharing">Sharing</router-link>
            </li>
            <li class="nav-item">
              <router-link class="nav-link" to="/tutorial"
                >Tutorial</router-link
              >
            </li>
            <li class="nav-item">
              <router-link class="nav-link" :class="{ 'active': $route.name === 'DetailAcara' }" to="/acara">Acara</router-link>
            </li>
            <li class="nav-item">
              <router-link class="nav-link" :class="{ 'active': $route.name === 'DetailArtikel' }" to="/artikel">Artikel</router-link>
            </li>
            <li class="nav-item">
              <router-link class="nav-link" to="/klinik">Klinik</router-link>
            </li>
            <li class="nav-item btn-contact-us pl-4 pl-lg-0">
              <a v-if="isLogin" href="/dashboard">
                <button class="btn btn-primary">Dashboard</button>
              </a>
              <router-link v-else to="/login">
                <button class="btn btn-primary">Log In</button>
              </router-link>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>
</template>

<script scoped>
export default {
  data() {
    return {
      isLogin: false
    };
  },
  inject: ["assetUrl"],
  beforeMount() {
    const data = localStorage.getItem("data");
    const token = data ? JSON.parse(data).token : null;
    const login = data ? JSON.parse(data).login : null;
    // console.log(token && login === true);
    if (token && login === true) {
      this.isLogin = true;
    }
  },
};
</script>

<style>
</style>
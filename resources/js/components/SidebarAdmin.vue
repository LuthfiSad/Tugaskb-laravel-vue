<template>
  <aside
    class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4"
    id="sidenav-main"
    data-color="dark"
  >
    <div class="sidenav-header">
      <i
        class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
        aria-hidden="true"
        id="iconSidenav"
      ></i>
      <a class="navbar-brand m-0">
        <img
          :src="this.assetUrl + 'img/logo-ct-dark.png'"
          class="navbar-brand-img h-100"
          alt="main_logo"
        />
        <span class="ms-1 font-weight-bold">{{ nameUser }}</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0" />
    <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <router-link class="nav-link" to="/dashboard">
            <div
              class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center"
            >
              <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </router-link>
        </li>
        <li class="nav-item">
          <router-link class="nav-link" to="/dashboard/anggota">
            <div
              class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center"
            >
              <i
                class="ni ni-calendar-grid-58 text-warning text-sm opacity-10"
              ></i>
            </div>
            <span class="nav-link-text ms-1">Anggota</span>
          </router-link>
        </li>
        <li class="nav-item mt-3">
          <h6
            class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6"
          >
            Dengan Kategori
          </h6>
        </li>
        <li class="nav-item">
          <router-link class="nav-link" to="/dashboard/acara">
            <div
              class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center"
            >
              <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Acara</span>
          </router-link>
        </li>
        <li class="nav-item">
          <router-link class="nav-link" to="/dashboard/artikel">
            <div
              class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center"
            >
              <i
                class="ni ni-single-copy-04 text-warning text-sm opacity-10"
              ></i>
            </div>
            <span class="nav-link-text ms-1">Artikel</span>
          </router-link>
        </li>
        <li class="nav-item">
          <router-link class="nav-link" to="/dashboard/sharing">
            <div
              class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center"
            >
              <i class="ni ni-collection text-info text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Sharing</span>
          </router-link>
        </li>
        <li class="nav-item mt-3">
          <h6
            class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6"
          >
            User
          </h6>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/home">
            <div
              class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center"
            >
              <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Halaman Utama</span>
          </a>
        </li>
        <li class="nav-item">
          <a
            class="nav-link"
            v-on:click.prevent="logout()"
            style="cursor: pointer"
          >
            <div
              class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center"
            >
              <i
                class="ni ni-single-copy-04 text-warning text-sm opacity-10"
              ></i>
            </div>
            <span class="nav-link-text ms-1">Logout</span>
          </a>
        </li>
      </ul>
    </div>
  </aside>
</template>

<script>
export default {
  name: "SidebarAdmin",
  inject: ["assetUrl", "nameUser"],
  methods: {
    async logout() {
      // this.error.nama = 'kocag';
      const result = await Swal.fire({
        text: `Apakah Benar anda ingin Logout ?`,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Logout",
      });

      if (result.isConfirmed) {
        const logout = await axios.post("/logout");
        await Swal.fire({
          title: logout.data.message,
          icon: "success",
        });
        localStorage.removeItem("data");
        window.location.href = "/login";
      }
    },
  },
};
</script>

<style>
</style>
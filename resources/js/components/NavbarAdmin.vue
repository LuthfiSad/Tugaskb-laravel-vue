<template>
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
      data-scroll="false">
      <div class="container-fluid py-1 px-3">
          <nav aria-label="breadcrumb">
              <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                  <li class="breadcrumb-item text-sm"><router-link class="opacity-5 text-white" :to="'/dashboard/'+$route.meta.name">{{ $route.meta.name }}</router-link></li>
                  <li class="breadcrumb-item text-sm text-white active text-break" aria-current="page">{{ formatTitle($route.name) }}</li>
              </ol>
              <h6 class="font-weight-bolder text-white mb-0">{{ $route.meta.name }}</h6>
          </nav>
          <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
  
              <ul class="ms-md-auto navbar-nav  justify-content-end">
                  <li class="nav-item d-flex align-items-center">
                      <div class="d-flex text-white">
                          <span class="d-sm-inline d-none pe-2">Light / Dark</span>
                          <div class="form-check form-switch">
                              <input class="form-check-input" type="checkbox" id="dark-version" @change="$emit('darkVersion')" onclick="darkMode(this)">
                          </div>
                      </div>
                  </li>
                  <li class="nav-item d-xl-none px-3 d-flex align-items-center">
                      <a v-on:click.prevent style="cursor: pointer;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                          <div class="sidenav-toggler-inner">
                              <i class="sidenav-toggler-line bg-white"></i>
                              <i class="sidenav-toggler-line bg-white"></i>
                              <i class="sidenav-toggler-line bg-white"></i>
                          </div>
                      </a>
                  </li>
              </ul>
          </div>
      </div>
  </nav>
  </template>
  
  <script>
  export default {
      name: "NavbarAdmin",
      methods: {
          formatTitle(input) {
            if(input){
                return input.replace(/([a-z])([A-Z])/g, '$1 $2');
            }
          }
      }
  }
  </script>
  
  <style>
  
  </style>
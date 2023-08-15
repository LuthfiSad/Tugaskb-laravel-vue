<template>
  <div class="row">
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-uppercase font-weight-bold">
                  Data Anggota
                </p>
                <h5 class="font-weight-bolder">{{ langgota }}</h5>
              </div>
            </div>
            <div class="col-4 text-end">
              <div
                class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle"
              >
                <i
                  class="ni ni-money-coins text-lg opacity-10"
                  aria-hidden="true"
                ></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-uppercase font-weight-bold">
                  Data Acara
                </p>
                <h5 class="font-weight-bolder">{{ acaras.length }}</h5>
              </div>
            </div>
            <div class="col-4 text-end">
              <div
                class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle"
              >
                <i
                  class="ni ni-world text-lg opacity-10"
                  aria-hidden="true"
                ></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-uppercase font-weight-bold">
                  Data Artikel
                </p>
                <h5 class="font-weight-bolder">{{ lartikel }}</h5>
              </div>
            </div>
            <div class="col-4 text-end">
              <div
                class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle"
              >
                <i
                  class="ni ni-paper-diploma text-lg opacity-10"
                  aria-hidden="true"
                ></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-uppercase font-weight-bold">
                  Data Sharing
                </p>
                <h5 class="font-weight-bolder">{{ sharings.length }}</h5>
              </div>
            </div>
            <div class="col-4 text-end">
              <div
                class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle"
              >
                <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row mt-4">
    <div class="col-12 mb-lg-0 mb-4">
      <div class="card z-index-2">
        <div class="card-header py-3 bg-transparent">
          <h3 class="text-capitalize text-center m-0">Hello {{ nameUser }}</h3>
        </div>
        <div class="card-body pt-0">
          <VCalendar expanded :is-dark="isDark" :attributes="attributes" />
        </div>
       </div>
    </div>
  </div>
</template>

<script>
export default {
  inject: ["nameUser"],
  name: "Dashboard",
  props:{
    acaras: Object,
    sharings: Object,
    langgota: Number,
    lartikel: Number,
    isDark: Boolean
  },
  // data(){
  //   return{
      
  //   }
  // },
  computed: {
    attributes() {
      const combinedEvents = [
        ...this.acaras.map(event => ({
          dates: new Date(event.jadwal),
          bar: 'red',
          popover: {
            label: event.title,
            visibility: 'focus'
          },
        })),
        ...this.sharings.map(event => ({
          dates: new Date(event.jadwal),
          bar: 'blue',
          popover: {
            label: event.title,
            visibility: 'focus'
          },
        })),
      ];
        // console.log(combinedEvents);
      return combinedEvents;
    },
  }
};
</script>

<style>
</style>
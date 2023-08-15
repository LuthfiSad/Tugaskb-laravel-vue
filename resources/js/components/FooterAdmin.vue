<template>
  <footer class="container-fluid position-absolute bottom-0">
    <p class="text-center">Copyright © 2023<a href="#" id="copyright" class="px-1">Kelompok Belajar Web Development HIMTI-UMT</a>.
    </p>
</footer>
</template>

<script>
export default {
    name: "FooterAdmin"
}
</script>

<style scoped>
  .dark-version footer {
    color: #fff;
  }
  footer {
    color: #000;
  }
  footer a{
    color: red;
  }
  #dashboard footer a:hover{
    color: #000 !important;
  }
  .dark-version #dashboard footer a:hover{
    color: #5e72e4 !important;
  }
</style>
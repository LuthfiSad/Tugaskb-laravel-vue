<template>
    <div class="d-flex vh-100">
        <div class="container my-auto">
            <router-view></router-view>
        </div>
    </div>
</template>
  
<script>
// import '../../../public/assets/js/landingpage.js'

export default {
    name: "Auth",
    inject: ["assetUrl"],
    created() {
        const linkElement = document.createElement("link");
        linkElement.setAttribute("href", this.assetUrl + "assets/css/style.min.css");
        // Mengatur atribut rel untuk menentukan hubungan antara halaman dan sumber eksternal
        linkElement.setAttribute("rel", "stylesheet");
        document.head.appendChild(linkElement);
        this.linkElement = linkElement;
        //   console.log(linkElement);
    },
    beforeUnmount() {
        if (this.linkElement) {
            document.head.removeChild(this.linkElement); // Hapus elemen linkElement dari DOM
            this.linkElement = null;
        }
    },
}
</script>
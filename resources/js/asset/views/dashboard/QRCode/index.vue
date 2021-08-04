<template>
  <div>
    <div style="display: flex" >
      <vue-qr :text="this.data" size="100" margin="10"></vue-qr>
      <p>asdasd</p>
    </div>

    <button v-on:click="print">in</button>
  </div>
</template>
<script>
// import { QrcodeStream, QrcodeDropZone, QrcodeCapture } from 'vue-qrcode-reader'
import VueQr from "vue-qr";
export default {
  // components: { QrcodeStream, QrcodeDropZone, QrcodeCapture },
  components: { VueQr },
  data() {
    return {
      QRcont: {
        data1: "asdasd",
      },
    };
  },
  methods: {
    print: function () {
      var printContents = document.getElementById("tag").innerHTML;
      var originalContents = document.body.innerHTML;

      document.body.innerHTML = printContents;

      window.print();

      document.body.innerHTML = originalContents;
    },
  },
};
</script>




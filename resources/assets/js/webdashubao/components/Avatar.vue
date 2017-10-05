<template>
<div style="position: absolute;right: 0;top: 38px;width: 130px;text-align: center;background: #fff;padding: 10px 15px;">
<my-upload field="img"
           @crop-success="cropSuccess"
           @crop-upload-success="cropUploadSuccess"
           @crop-upload-fail="cropUploadFail"
           v-model="show"
           :width="120"
           :height="120"
           :url="a"
           :params="params"
           :headers="headers"
           img-format="png"></my-upload>
  <img :src="imgDataUrl" alt="头像" style="width: 120px;height: 120px;padding: 1px;border: #dbe6d8 1px solid;">
  <a href="javascript:" title="设置头像" @click="toggleShow">[快速设置头像]</a>
</div>
</template>

<script>
    import 'babel-polyfill'; // es6 shim
    import myUpload from 'vue-image-crop-upload/upload-2.vue';

    export default {
        props:['avatar','_token','updateavatar'],
        data() {
            return {
                show: false,
                params: {
                    name: 'img',
                    _token: this._token,
                },
                headers: {
                    smail: '*_~'
                },
                imgDataUrl: this.avatar,
                a: this.updateavatar,
            }
        },
        components: {
            'my-upload': myUpload
        },
        methods: {
            toggleShow() {
                this.show = !this.show;
            },
            msg: function (msg ,t = 3000) {
              this.$toasted.show(msg, {
                   theme: "bubble",
                   position: "top-center",
                   duration : t
                });
            },
            /**
             * crop success
             *
             * [param] 图片截取完成事件（上传前), 参数( imageDataUrl, field )
             * [param] field
             */
            cropSuccess(imgDataUrl, field){
                this.imgDataUrl = imgDataUrl;
            },
            /**
      			 * upload success
      			 *
      			 * [param] jsonData   服务器返回数据，已进行json转码
      			 * [param] field
      			 */
            cropUploadSuccess(response, field){
                if(response.errno == 0 ){
                  this.imgDataUrl = response.data
                }
                this.toggleShow();
            },
            /**
             * upload fail
             *
             * [param] status    server api return error status, like 500
             * [param] field
             */
            cropUploadFail(status, field){
                console.log('-------- upload fail --------');
                console.log(status);
                console.log('field: ' + field);

            }
        }
    }
</script>

<template>
<div>
<div class="set1" v-on:click="openModel('voteAlert')">
	报错
</div>
<sweet-modal title="举报错误" ref="voteAlert" style="margin-top:45px;">
		<form id="jubaoForm">
			<textarea name="content" v-model="content" @keyup.13="onSubmit" class="textarea" :style="'width:100%;height:'+ (screen_height * 0.4)+ 'px;'" placeholder="输入举报内容 来源地址 我们已经记录了"></textarea>
			<div class="input_el">
					<button type="button" class="btn_small" value="submit" v-on:click="onSubmit">提　　交</button>
			</div>
		</form>
</sweet-modal>
</div>
</template>

<script type="text/ecmascript-6">
	import {SweetModal , SweetModalTab} from 'sweet-modal-vue';
  //import BScroll from 'better-scroll'
  export default {
    props:['title','from'],
    data() {
      return {
					content: '',
					screen_height: Util.windowHeight,
      }
    },
		components: {
				SweetModal,
				SweetModalTab,
		},
		computed: {

    },
    methods: {
			openModel(ref) {
				if (this.$refs[ref]) {
					this.$refs[ref].open()
				} else {
					throw new Error('openModel Ref not defined: ' + ref)
				}
			},
			closeModel(ref) {
				if (this.$refs[ref]) {
					this.$refs[ref].close()
				} else {
					throw new Error('openModel Ref not defined: ' + ref)
				}
			},
			onSubmit(){
				this.closeModel('voteAlert');
				 var content =  $.trim(this.content);
				 this.content = '';
				 if(!content){
				 		this.$toast.center('提交内容不能为空');
						return
				 }
				 var self = this;
				 var from = self.from;
				 var title = '来源手机_书名：'+ self.title + '_来路：' + self.from;
				 axios.post(Config.jubaourl, {
							 content: content,
							 title: title,
					 })
					 .then(function (response) {
						 //console.log(response);
						 if(response.data.message){
						 		self.$toast.center(response.data.message);
						 }else{
						 		self.$toast.center('返回数据出错了');
						 }

					 })
					 .catch(function (response) {
							 console.log(response);
							 self.$toast.center('网络故障稍后再试！');
					 });

				},

    },
  }
</script>

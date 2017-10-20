<template>
<div id="top_nav" class="reader_top_nav" style="display: none;">
		<a class="reader__back" href="javascript:"></a>返回
		<a class="reader__more iconfont icon-warning" v-on:click.stop="openModel('voteAlert')"></a>
		<sweet-modal title="举报错误" ref="voteAlert">
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
  export default {
    props:['from','bookname','chaptername'],
    data() {
      return {
				screen_height: Util.windowHeight,
				content:'',
      }
    },
		components: {
				SweetModal,
				SweetModalTab,
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
					 var title = '来源手机_书名：'+ self.bookname + '_章节名：'+ self.chaptername;
					 axios.post(Config.jubaourl, {
								 content: content,
								 title: title,
								 from: from,
						 })
						 .then(function (response) {
							 if(response.data.message){
							 		self.$toast.center(response.data.message);
							 }else{
							 		self.$toast.center('返回数据出错了');
							 }

						 })
						 .catch(function (response) {
								 console.log(response);
								 self.$toast.center('请刷新页面再尝试！');
						 });

					},

    },
  }
</script>

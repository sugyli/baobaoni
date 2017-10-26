<template>
<div :class="'header online ' + title_position">
    {{title}}
    <a class="header-right" v-if="right_icon" :href="right_href">
      <i :class="'iconfont '+ right_icon"></i>
    </a>
    <a class="header-left" v-if="left_icon" :href="left_href">
      <i :class="'iconfont '+ left_icon" ></i>
    </a>
</div>
</template>

<script>
  export default {
      props:['left_icon','left_href','right_icon','right_href','title','title_position'],
  }

</script>

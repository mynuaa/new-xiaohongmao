<template>
	<div id="loading">
	</div>
</template>
<script>
export default {
	name:'loading'
}
</script>

<style lang="scss" scoped>
#loading{
	width:400px;
	height: 400px;
	margin-left:33%;
	background:url(../assets/logo.png) no-repeat top;
	background-size: contain;
	animation-name: rotate;
	animation-duration:3s;
animation-timing-function: linear;
animation-delay: 0s;
animation-iteration-count: infinite;
}
@keyframes rotate {
	0%{
		transform: rotate(0)
	}
	50%{
		transform: rotate(-180deg) scale(2);
	}
	100%{
		transform: rotate(0deg)
	}
}
</style>
 
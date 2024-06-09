<template>


import {
	VueFlux,
	FluxPreloader,
	FluxControls,
	FluxPagination,
	Img,
	Fade,
} from 'vue-flux';

const options = reactive({
	allowFullscreen: false,
	allowToSkipTransition: true,
	autohideTime: 2500,
	autoplay: false,
	bindKeys: false,
	delay: 5000,
	enableGestures: false,
	infinite: true,
	lazyLoad: true,
	lazyLoadAfter: 3,
});

const rscs = shallowReactive([
	new Img('img-url-1'),
	new Img('img-url-2'),
	new Img('img-url-3'),
]);

const transitions = shallowReactive([
   Fade,
]);
<VueFlux
   :options="options"
   :rscs="rscs"
   :transitions="transitions"
>
   <template #preloader="preloaderProps">
      <FluxPreloader v-bind="preloaderProps" />
   </template>

   <template #controls="controlsProps">
      <FluxControls v-bind="controlsProps" />
   </template>

   <template #pagination="paginationProps">
      <FluxPagination v-bind="paginationProps" />
   </template>
</VueFlux>
</template>
<template>
    <transition name="fade" mode="out-in">
        <router-view></router-view>
    </transition>
</template>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  width: 1000px;
}

.fade-enter-active, .fade-leave-active {
  transition: opacity .3s ease-out;
}
.fade-enter, .fade-leave-to {
  opacity: 0;
}

a { text-decoration: none; color: #409EFF; }


</style>

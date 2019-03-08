<template>
  <div class="modal__mask" @click="close" v-if="display">
    <transition appear name="modal">
      <div class="modal__container" @click.stop>
        <slot name="title">Title</slot>
        <slot></slot>
      </div>
    </transition>
  </div>
</template>

<script>
export default {
  props: ["display"],
  methods: {
    close: function() {
      this.$emit("close");
    }
  },
  mounted: function() {
    document.addEventListener("keydown", e => {
      if (this.show && e.keyCode == 27) {
        this.close();
      }
    });
  }
};
</script>

<style scoped>
.modal-enter-active {
  animation: bounce-in 0.5s;
}
.modal-leave-active {
  animation: bounce-in 0.5s reverse;
}
@keyframes bounce-in {
  0% {
    transform: scale(0);
  }
  50% {
    transform: scale(1.2);
  }
  100% {
    transform: scale(1);
  }
}
</style>
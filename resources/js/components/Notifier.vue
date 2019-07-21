<template>
    <transition name="fade">
        <div v-if="message" :class="[type, 'notifier']" @click.prevent="message = false">
            <p>{{message}}</p>
        </div>
    </transition>
</template>

<script>
import { setTimeout, clearTimeout } from 'timers';
export default {
    data : function(){
        return {
            message:false ,
            type: "notice",
        }
    },
  mounted: function() {
    clearTimeout(timer);
    let timer = setTimeout(()=>{
        this.message = false;
    }, 5000);
    Bus.$on('flash', (message) => {
        this.message = message.content;
        this.type = message.type
    });
  }
}
</script>

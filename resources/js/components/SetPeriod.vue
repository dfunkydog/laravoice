<template>
  <modal :display="display" @close="close">
    <h3>Set the display time period</h3>
    <div class="select-period">
      <form action="period" method="POST">
        <input type="hidden" name="_token" :value="token">
        <input type="hidden" name="preset" value="7days">
        <button class="btn btn--incognito" type="submit">Last 7 Days</button>
      </form>
      <form action="period" method="POST">
        <input type="hidden" name="_token" :value="token">
        <input type="hidden" name="preset" value="1mth">
        <button class="btn btn--incognito" type="submit">Last 30 Days</button>
      </form>
      <form action="period" method="POST">
        <input type="hidden" name="_token" :value="token">
        <input type="hidden" name="preset" value="3mths">
        <button class="btn btn--incognito" type="submit">Last 90 Days</button>
      </form>
      <form action="period" method="POST">
        <input type="hidden" name="_token" :value="token">
        <input type="hidden" name="preset" value="month">
        <button class="btn btn--incognito" type="submit">This month</button>
      </form>
      <form action="period" method="POST">
        <input type="hidden" name="_token" :value="token">
        <input type="hidden" name="preset" value="week">
        <button class="btn btn--incognito" type="submit">This week</button>
      </form>
    </div>
  </modal>
</template>

<script>
export default {
  props: ["display", "token"],
  methods: {
    close: function() {
      this.$emit("close");
    },
    postPeriod: function() {}
  }
};
</script>

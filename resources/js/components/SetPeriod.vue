<template>
  <modal :display="display" @close="close">
    <h3>Set the display time period</h3>
    <div v-show="presetsView" class="select-period">
      <form action="/period" method="POST">
        <input type="hidden" name="_token" :value="token">
        <input type="hidden" name="preset" value="7days">
        <button class="btn btn--incognito" type="submit">Last 7 Days</button>
      </form>
      <form action="/period" method="POST">
        <input type="hidden" name="_token" :value="token">
        <input type="hidden" name="preset" value="1mth">
        <button class="btn btn--incognito" type="submit">Last 30 Days</button>
      </form>
      <form action="/period" method="POST">
        <input type="hidden" name="_token" :value="token">
        <input type="hidden" name="preset" value="3mths">
        <button class="btn btn--incognito" type="submit">Last 90 Days</button>
      </form>
      <form action="/period" method="POST">
        <input type="hidden" name="_token" :value="token">
        <input type="hidden" name="preset" value="month">
        <button class="btn btn--incognito" type="submit">This month</button>
      </form>
      <form action="/period" method="POST">
        <input type="hidden" name="_token" :value="token">
        <input type="hidden" name="preset" value="week">
        <button class="btn btn--incognito" type="submit">This week</button>
      </form>
      <button class="btn" @click="toggleCustom">Custom</button>
    </div>
    <div v-show="!presetsView" class="select-calendar">
      <form action="/period/custom" method="POST">
        <input type="hidden" name="_token" :value="token">
        <input type="date" name="start_date" :value="start">
        <input type="date" name="end_date" :value="end">
        <button class="btn btn" type="submit">Submit</button>
        <button class="btn btn--incognito" type="button" @click="toggleCustom">Back to presets</button>
      </form>
    </div>
  </modal>
</template>

<script>
export default {
  props: {
    display: {
      type: Boolean,
      default: false
    },
    token: {
      type: String,
      required: true
    },
    start: {
      type: String
    },
    end: {
      type: String
    }
  },
  data: function() {
    return {
      showCalendars: false
    };
  },
  computed: {
    presetsView: function() {
      return !this.showCalendars;
    }
  },
  methods: {
    close: function() {
      this.$emit("close");
    },
    postPeriod: function() {},
    toggleCustom: function() {
      console.log(this.showCalendars);
      this.showCalendars = !this.showCalendars;
      console.log(this.showCalendars);
    }
  }
};
</script>

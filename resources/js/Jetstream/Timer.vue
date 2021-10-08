<script>
import { defineComponent } from "vue";
import moment from "moment";
export default defineComponent({
  name: "Timer",
  props: {
    date: {
      type: String,
      required: true
    }
  },
  data() {
    return {
      error: "",
      now: null,
      remaining: null,
      moment: null,
      mode: 0,
      modes: {
        years: 5,
        months: 4,
        days: 3,
        hours: 2,
        minutes: 1
      }
    };
  },
  mounted() {
    this.moment = moment.utc(this.date);
    if (this.moment.isValid()) {
      this.tick(0);
      this.tock(0);
    } else {
      this.error = "Invalid date";
    }
  },
  beforeUnmount() {
    window.clearTimeout(this.$options.timer);
  },
  methods: {
    s(count) {
      if (count !== 1) return "s";
    },
    tick(timeout = 50) {
      this.$options.timer = window.setTimeout(this.updateDateTime, timeout);
    },
    tock(timeout = 30 * 60) {
      this.$options.timer = window.setTimeout(this.updateTitle, timeout);
    },
    updateTitle() {
      const readable = this.moment.fromNow();
      let title = readable.charAt(0).toUpperCase() + readable.slice(1);
      if (this.$route?.query?.title) {
        title = `${this.$route.query.title} — ${title}`;
      }
      document.title = title;
    },
    updateDateTime() {
      const duration = moment.duration(this.moment.diff(moment()));
      this.remaining = {
        years: duration.years(),
        months: duration.months(),
        days: duration.days(),
        hours: duration.hours(),
        minutes: duration.minutes(),
        seconds: duration.seconds()
      };
      if (this.remaining.years > 0) this.mode = this.modes.years;
      else if (this.remaining.months > 0) this.mode = this.modes.months;
      else if (this.remaining.days > 0) this.mode = this.modes.days;
      else if (this.remaining.hours > 0) this.mode = this.modes.hours;
      else if (this.remaining.minutes > 0) this.mode = this.modes.minutes;
      if (this.moment.diff(moment()) > 0) this.tick();
    }
  }
});
</script>
<template>
  <div class="timer">
    <h1 v-if="$route?.query?.title">
      {{ $route.query.title }}
    </h1>
    <div v-if="error">
      {{ error }}
    </div>
    <dl v-else-if="remaining">
      <dt v-if="mode >= modes.years">Year{{ s(remaining.years) }}</dt>
      <dd v-if="mode >= modes.years">
        {{ remaining.years > 0 ? remaining.years : 0 }}
      </dd>
      <dt v-if="mode >= modes.months">Month{{ s(remaining.months) }}</dt>
      <dd v-if="mode >= modes.months">
        {{ remaining.months > 0 ? remaining.months : 0 }}
      </dd>
      <dt v-if="mode >= modes.days">Day{{ s(remaining.days) }}</dt>
      <dd v-if="mode >= modes.days">
        {{ remaining.days > 0 ? remaining.days : 0 }}
      </dd>
      <dt v-if="mode >= modes.hours">Hour{{ s(remaining.hours) }}</dt>
      <dd v-if="mode >= modes.hours">
        {{ remaining.hours > 0 ? remaining.hours : 0 }}
      </dd>
      <dt v-if="mode >= modes.minutes">Minute{{ s(remaining.minutes) }}</dt>
      <dd v-if="mode >= modes.minutes">
        {{ remaining.minutes > 0 ? remaining.minutes : 0 }}
      </dd>
      <dt>Second{{ s(remaining.seconds) }}</dt>
      <dd>{{ remaining.seconds > 0 ? remaining.seconds : 0 }}</dd>
    </dl>
  </div>
</template>
<style lang="scss">
.timer {
  display: flex;
  flex-direction: column;
  width: 100%;
}
h1 {
  font-size: 4em;
}
dl {
  align-self: center;
  display: grid;
  grid-auto-columns: 1fr;
  grid-gap: 0 1rem;
  margin: 10px;
  text-align: center;
  width: 100%;
}
dd {
  grid-row-start: 1;
  margin: 0;
  font-family: "Teko", sans-serif;
  font-size: 6em;
  margin-bottom: -0.1em;
}
dt {
  grid-row-start: 2;
  font-size: 1.1em;
  font-family: "Hind", sans-serif;
  letter-spacing: 0.1em;
  text-transform: uppercase;
}
@media screen and (max-width: 724px) {
  dd {
    font-size: 5em;
  }
  dt {
    font-size: 1em;
  }
}
</style>
<template>
  <div>
    <label :class="labelClass" v-text="labelName" v-if="labelName"></label>
    <div class="color-picker">
      <input v-model="localColor" type="text"
             :placeholder="placeholder"
             :class="inputClass"
             :style="stylePaddingPicker"
      >
      <input type="color"
             class="color-picker__color"
             v-model="localColor"
             :style="[
                 backgroundStyle,
                 stylePickerPosition
                 ]"
      >
    </div>
  </div>
</template>

<script>
export default {
  name: "ColorPickerInput",
  props: {
    value: {
      type: String,
      default: '#000000'
    },
    placeholder: {
      type: String,
      default: '#000000'
    },
    labelName: {
      type: String,
      default: 'Color'
    },
    labelClass: {
      type: String,
      default: 'mb-2'
    },
    stylePickerPosition: {
      type: Object,
      default() {
        return {left: '5px'}
        },
    },
    stylePaddingPicker: {
      type: String,
      default: 'padding-left: 35px;'
    },
    inputClass: {
      type: String,
      default: 'form-control'
    },
  },
  computed: {
    localColor: {
      get() {
        return this.value
      },
      set(val) {
        this.$emit('change', val)
        this.$emit('input', val)
      }
    },
    backgroundStyle() {
      console.log('localColor : '+this.localColor)
      return {background: (this.localColor.length > 0 && this.localColor.length > 3) ? this.localColor : '#000000'};
    }
  }
}
</script>

<style lang="scss">

.color-picker {
  position: relative;

  input:not([type=color]) {
    text-transform: uppercase;
  }

  &__color {
    display: block;
    position: absolute;
    width: 26px;
    height: 26px;
    padding: 0;
    border-color: transparent;
    border-radius: 50%;
    top: calc(50% - 13px);

    &:focus {
      outline: none;
    }

    &::-webkit-color-swatch {
      border: none;
    }
  }
}

</style>

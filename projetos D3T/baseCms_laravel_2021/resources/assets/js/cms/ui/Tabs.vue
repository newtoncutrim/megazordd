<template>
  <div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
      <li
        v-for="(tab, index) in tabs_prop"
        :key="index"
        v-bind:class="{ active: activeTab_prop == index }"
      >
        <a
          v-bind:href="'#tab_' + index"
          @click="activeTab_prop = index"
          data-toggle="tab"
          ><i v-bind:class="tab.icon"></i> {{ tab.title }}</a
        >
      </li>
    </ul>
    <div class="tab-content">
      <div
        v-for="(tab, index) in tabs_prop"
        :key="index"
        class="tab-pane"
        v-bind:class="{ active: activeTab_prop == index }"
        v-bind:id="'tab_' + index"
      >
        <slot v-bind:name="'tabslot_' + index"></slot>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["tabs", "activeTab"],
  data() {
    return {
      tabs_prop: this.tabs,
      activeTab_prop: this.activeTab,
    };
  },
};
</script>

window.vue = require("vue");
require("lodash");
import Vue from "vue";

// register the plugin on vue
import Toasted from "vue-toasted";
Vue.use(Toasted);

import vSelect from "vue-select";
Vue.component("v-select", vSelect);
import "vue-select/dist/vue-select.css";

//Allows localization using trans()
Vue.prototype.trans = (key) => {
  return _.get(window.lang, key, key);
};
//Tells if an JSON parsed object is empty
Vue.prototype.isEmpty = (obj) => {
  return _.isEmpty(obj);
};

import ZipCodeSettings from "./pages/Settings";

new Vue({
  el: "#VueJs",

  data: {},

  components: {
    zipcodesettings: ZipCodeSettings,
  },

  created: function() {},
});

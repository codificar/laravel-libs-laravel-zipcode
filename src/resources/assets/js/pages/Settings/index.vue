<script>
import ZipCodeGateway from "./zip_code_gateway";
export default {
  props: ["enumData", "model", "zipCodeSettingStoreRoute"],
  components: {
    ZipCodeGateway,
  },
  data() {
    return {};
  },
  methods: {},
  async mounted() {},
};
</script>
<template>
  <div>
    <ZipCodeGateway
      :enum-data="enumData"
      :model="model"
      :zip-code-setting-store-route="zipCodeSettingStoreRoute"
    />
  </div>
</template>

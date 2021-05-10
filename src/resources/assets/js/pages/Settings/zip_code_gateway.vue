<script>
import axios from "axios";
import Card from "../../components/Layout/Card";
export default {
  props: ["enumData", "model", "zipCodeSettingStoreRoute"],
  components: {
    Card,
  },
  data() {
    return {
      optionsList: [],

      provideRules: {
        name: "",
        value: "",
        required_key: false,
      },

      providerRedundancyRule: {
        name: "",
        value: "",
        required_key: false,
      },

      dataModel: {
        zipcode_provider: "",
        zipcode_key: "",

        zipcode_redundancy: "",

        zipcode_redundancy_provider: "",
        zipcode_redundancy_key: "",
      },

      dataErrors: {
        zipcode_provider: "",
        zipcode_key: "",

        zipcode_redundancy: "",

        zipcode_redundancy_provider: "",
        zipcode_redundancy_key: "",
      },
    };
  },
  methods: {
    selectService(selectedData) {
      this.provideRules = selectedData;
      this.dataModel.zipcode_provider.value = selectedData.value;
    },
    selectRedundancyService(selectedData) {
      this.providerRedundancyRule = selectedData;
      this.dataModel.zipcode_redundancy_provider.value = selectedData.value;
    },
    toogleRedundancy(checkedValue) {
      const value = checkedValue.target.value;
      this.dataModel.zipcode_redundancy.value = value;
    },
    async store() {
      //Format Data in Array
      if (!this.validate(this.dataModel)) {
        this.$toasted.show("Preencha todos os campo obrigatorios", {
          theme: "bubble",
          type: "error",
          position: "bottom-center",
          duration: 3000,
        });
      } else {
        let arrayDataModel = Object.keys(this.dataModel).map(
          (key) => this.dataModel[key]
        );
        const response = await axios.post(
          this.zipCodeSettingStoreRoute,
          arrayDataModel
        );
        this.$toasted.show("Salvo com sucesso", {
          theme: "bubble",
          type: "success",
          position: "bottom-center",
          duration: 3000,
        });
        this.cleanErrors();
        location.reload(true);
      }
    },
    cleanErrors() {
      this.dataErrors = {
        zipcode_provider: "",
        zipcode_key: "",

        zipcode_redundancy: "",

        zipcode_redundancy_provider: "",
        zipcode_redundancy_key: "",
      };
    },
    validate(data) {
      let isValid = true;
      if (
        this.dataModel.zipcode_key.value == null ||
        this.dataModel.zipcode_key.value.trim() == ""
      ) {
        isValid = false;
        this.dataErrors.zipcode_key = this.trans("zipcode.generic_required");
      }
      if (
        this.dataModel.zipcode_provider.value == null ||
        this.dataModel.zipcode_provider.value.trim() == ""
      ) {
        isValid = false;
        this.dataErrors.zipcode_provider = this.trans(
          "zipcode.generic_required"
        );
      }

      if (this.dataModel.zipcode_redundancy.value == 1) {
        if (
          this.dataModel.zipcode_redundancy_key.value == null ||
          this.dataModel.zipcode_redundancy_key.value.trim() == ""
        ) {
          isValid = false;
          this.dataErrors.zipcode_redundancy_key = this.trans(
            "zipcode.generic_required"
          );
        }
        if (
          this.dataModel.zipcode_redundancy_provider.value == null ||
          this.dataModel.zipcode_redundancy_provider.value.trim() == ""
        ) {
          isValid = false;
          this.dataErrors.zipcode_redundancy_provider = this.trans(
            "zipcode.generic_required"
          );
        }
      }

      return isValid;
    },
  },
  async mounted() {
    this.dataModel = JSON.parse(this.model);
    this.optionsList = JSON.parse(this.enumData).zip_code_gateway_enum;

    const selectedProvider = this.optionsList.filter(
      (objectData) => objectData.value == this.dataModel.zipcode_provider.value
    );
    if (selectedProvider.length > 0) this.selectService(selectedProvider[0]);

    const selectedRedundancyProvider = this.optionsList.filter(
      (objectData) =>
        objectData.value == this.dataModel.zipcode_redundancy_provider.value
    );
    if (selectedRedundancyProvider.length > 0)
      this.selectRedundancyService(selectedRedundancyProvider[0]);
  },
};
</script>
<template>
  <Card>
    <h4 slot="card-title" class="m-b-0 text-white">
      {{ trans("zipcode.zip_code_settings") }}
    </h4>

    <h3 slot="card-content-title" class="box-title"></h3>
    <div slot="card-content">
      <div class="row">
        <div class="col-lg-6">
          <div class="form-group">
            <label> {{ trans("zipcode.zip_code_provider") }}* </label>
            <v-select
              @input="selectService"
              :options="optionsList"
              label="name"
              v-model="provideRules"
            />
            <div class="help-block with-errors" style="color: red;">
              {{ dataErrors.zipcode_provider }}
            </div>
          </div>
        </div>

        <div class="col-lg-6" v-show="provideRules.required_key">
          <div class="form-group">
            <label> {{ trans("zipcode.zip_code_key") }}* </label>
            <input
              v-model="dataModel.zipcode_key.value"
              type="text"
              class="form-control"
            />
            <div class="help-block with-errors" style="color: red;">
              {{ dataErrors.zipcode_key }}
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-12">
          <div class="form-check">
            <label class="form-check-label pl-0"
              ><h3 style="color: #54667a;">
                {{ trans("zipcode.zip_code_red_enable") }}
              </h3>
            </label>

            <label class="pl-1"
              ><input
                type="radio"
                name="radioPlaces"
                value="1"
                @change="toogleRedundancy"
                v-model="dataModel.zipcode_redundancy.value"
              />{{ trans("zipcode.generic_yes") }}</label
            >
            <label class="pl-1"
              ><input
                type="radio"
                name="radioPlaces"
                value="0"
                @change="toogleRedundancy"
                v-model="dataModel.zipcode_redundancy.value"
              />{{ trans("zipcode.generic_no") }}</label
            >
          </div>
        </div>
      </div>
      <!-- Redundancy -->
      <div v-if="dataModel.zipcode_redundancy.value == 1">
        <div class="row">
          <div class="col-lg-6">
            <div class="form-group">
              <label> {{ trans("zipcode.zip_code_red_provider") }}* </label>
              <v-select
                @input="selectRedundancyService"
                :options="optionsList"
                label="name"
                v-model="providerRedundancyRule"
              />
              <div class="help-block with-errors" style="color: red;">
                {{ dataErrors.zipcode_redundancy_provider }}
              </div>
            </div>
          </div>

          <div class="col-lg-6" v-show="providerRedundancyRule.required_key">
            <div class="form-group">
              <label> {{ trans("zipcode.zip_code_red_key") }}* </label>
              <input
                v-model="dataModel.zipcode_redundancy_key.value"
                type="text"
                class="form-control"
              />
              <div class="help-block with-errors" style="color: red;">
                {{ dataErrors.zipcode_redundancy_key }}
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="box-footer pull-right">
        <button @click="store" class="btn btn-success right" type="button">
          {{ trans("zipcode.generic_save") }}
        </button>
      </div>
    </div>
  </Card>
</template>

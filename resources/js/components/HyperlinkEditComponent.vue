<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit hyperlink</div>

                    <div class="card-body">
                        <form @submit.prevent="createHyperlink">
                            <div class="form-group">
                                <label class="required">Title:</label>
                                <input type="text" class="form-control" v-model="hyperlink.title" required>
                            </div>
                            <div class="form-group">
                                <label class="required">URL:</label>
                                <input type="text" class="form-control" v-model="hyperlink.url" required>
                            </div>
                            <div class="form-group">
                                <label>Color:</label>
                                <chrome-picker v-model="hyperlink.color"/>
                            </div>
                            <div class="form-group" v-if="!loading">
                                <label>¿Do you want open this link in a new tab?</label>
                                <toggle-button v-model="hyperlink.new_tab" :labels="{checked: 'Yes', unchecked: 'No'}"
                                               :color="hyperlink.color.hex"/>
                            </div>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save hyperlink
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

  import {Chrome} from 'vue-color'
  import {fontAwesomePicker} from 'font-awesome-picker';

  export default {
    props: ['id'],

    components: {
      'chrome-picker': Chrome,
      'font-awesome-picker': fontAwesomePicker,
    },

    data() {
      return {
        loading: true,
        hyperlink: {
          title: "",
          url: "",
          color: ""
        }
      }
    },

    /**
     * Get specified Hypelink
     */
    async mounted() {
      let hyperlink = await axios.get(`/api/hyperlinks/${this.id}`);

      this.hyperlink = hyperlink.data;
      this.hyperlink.new_tab = hyperlink.data.new_tab === 1;

      this.loading = false;

    },

    methods: {
      /**
       * Question about save Hyperlink
       */
      async createHyperlink() {

        let result = await this.$swal.fire({
          title: 'Are you sure?',
          text: "You really want update this hyperlink?",
          icon: 'warning',
          showCancelButton: true
        });

        if (result.value) {
          this.saveHyperlink();
        }
      },

      /**
       * Save the new Hyperlink
       */
      async saveHyperlink() {

        if (typeof (this.hyperlink.color) == 'object')
          this.hyperlink.color = this.hyperlink.color.hex;

        await axios.put(`/api/hyperlinks/${this.id}`, this.hyperlink);

        await this.$swal('Good!', 'Hyperlink updated successfully', 'success');

        window.location.href = '/hyperlinks';
      },

    }
  }
</script>

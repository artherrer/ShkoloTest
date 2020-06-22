<template>
    <div class="container" v-if="!loading">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Your hyperlinks</div>

                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-md-4 mb-3" v-for="(hyper, index) in hyperlinks" :key="index">
                                <div v-if="hyper.nullable">
                                    <a href="/hyperlinks/create">
                                        <i class="fa fa-plus-circle fa-10x w-100"></i>
                                        <p class="text-center mb-0 ">Add new hyperlink</p>
                                    </a>
                                </div>

                                <div class="card" v-else>
                                    <div class="card-body">
                                        <a :href="hyper.url" :target="openType(hyper.new_tab)" :style="{color: hyper.color}">
                                            <i class="fa fa-link fa-10x w-100"></i>
                                            <p class="text-center mb-0 ">{{ hyper.title }}</p>
                                            <p class="text-center">{{ hyper.url }}</p>
                                        </a>
                                        <div class="">
                                            <button class="btn btn-outline-primary btn-sm w-48" @click="goToEditHyperlink(hyper.id)">Edit</button>
                                            <button class="btn btn-outline-danger btn-sm w-48" @click="goToDeleteHyperlink(hyper.id, index)">Delete</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
  export default {

    data() {
      return {
        hyperlinks: [],
        loading: true
      }
    },

    /**
     * Get hyperlinks
     */
    async mounted() {
      let hyperlinks = await axios.get('/api/hyperlinks');

      this.hyperlinks = hyperlinks.data;

      this.loading = false;
    },

    methods: {
      /**
       * Delete Hyperlink selected
       */
      async goToDeleteHyperlink(hyperlinkId, index) {
        let result = await this.$swal.fire({
          title: 'Are you sure?',
          text: "You really want delete this hyperlink?",
          icon: 'warning',
          showCancelButton: true
        });

        if(result.value) {
          this.deleteHyperlink(hyperlinkId, index);
        }
      },

      /**
       * Destroy Hyperlink selected
       */
      async deleteHyperlink(hyperlinkId, index) {

        await axios.delete(`/api/hyperlinks/${hyperlinkId}`);

        this.$swal('Good!', 'Hyperlink deleted successfully', 'success');
        this.hyperlinks.splice(index, 1);
        this.hyperlinks.push({nullable: true});
      },

      /**
       * Go to Edit View
       * @param hyperlinkId
       */
      goToEditHyperlink(hyperlinkId) {
        window.location.href = `/hyperlinks/${hyperlinkId}/edit`;
      },

      /**
       * New tab o self tab?
       */
      openType(newTab) {
        return newTab ? '_blank' : '_self';
      }
    }
  }
</script>

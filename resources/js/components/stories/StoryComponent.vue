<template>
    <section>
        <div class="row">
            <div class="col-md-2">
                <div class="rounded-circle border story-div" @click="openModal()">
                    <i class="fas fa-history"></i>
                </div>
            </div>

            <div class="slider-wrapper-2 col-md-10 row" data-slick='{"slidesToShow": 4, "slidesToScroll": 4}'>
                <div v-for="story in stories">
                    <img :src="story.image" alt="" class="rounded-circle" width="100px" height="100px">
                </div>
            </div>
        </div>
    <div>
        <story-modal></story-modal>
    </div>
    </section>

</template>

<script>
    export default {
        props: ['stories'],
        name: "StoryComponent.vue",
        data() {
          return {
              open: false
          }
        },
        mounted() {
            console.log(this.stories);
        },
        methods: {
            openModal() {
                $('#myModal').modal('show');
            }
        }
    }
</script>

<style scoped>

</style>
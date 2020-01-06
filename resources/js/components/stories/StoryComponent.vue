<template>
    <section class="overflow-hidden">
        <div>
            <div class="float-left">
                <div class="rounded-circle border story-div" @click="openModal()">
                    <i class="fas fa-history"></i>
                </div>
            </div>


            <div class="horizontal-scroll-wrapper squares">
                <div v-for="story in stories">
                    <div>
                        <img :src="story.image" alt="" class="child rounded-circle" width="100px" height="100px">
                    </div>
                    <div>
                        <img :src="story.user.avatar" alt="" width="30px" height="30px" class="rounded-circle small-story-avatar">
                    </div>
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
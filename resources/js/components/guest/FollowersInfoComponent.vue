<template>
    <section class="container mt-5">
        <div class="row">
            <div class="col-md-12 mt-5" v-for="file in files">
                <div>
                    <!--         header           -->
                    <a :href="'/home/guest/'+file.user.id">
                        <div class="col-md-12 border-bottom row mb-1">
                            <div class="col-md-1">
                                <img :src="'images/profile/'+file.user.id+'/'+file.user.avatar" alt="" class="rounded-circle avatar">
                            </div>
                            <div class="circle col-md-2 pt-3">
                                <p>
                                    {{ file.user.name }}
                                </p>
                            </div>
                        </div>
                    </a>

                    <!--         body             -->
                    <div class="col-md-12 row border-bottom">
                        <div class="col-md-6 user_images" v-for="(image, index) in file.image.slice(0,4)">
                                <img :src="'/images/images-user-'+image.user_id+'/'+image.name" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        props: ['files'],
        name: "FollowersInfoComponent",
        mounted() {
            console.log(this.files);
        }
    }
</script>

<style scoped>

</style>
<template>
    <section class="container mt-5">
        <div class="row" align="center">
            <div class="col-md-12 mt-5" v-for="(image, key) in followerImages">
                <div>
                    <!--         header           -->
                    <a :href="'/home/guest/'+image.user.id">
                        <div class="col-md-6 overflow-hidden border-bottom row mb-1">
                            <div>
                                <span class="col-md-1" v-if="image.user.avatar != null">
                                <img :src="'images/profile/'+image.user.id+'/'+image.user.avatar" alt="" class="rounded-circle avatar" width="50px">
                            </span>
                                <span class="col-md-1" v-else>
                                <img src="https://www.svgimages.com/svg-image/s5/man-passportsize-silhouette-icon-256x256.png"
                                     class="rounded-circle user_img_msg" width="50px">
                            </span>
                                <span>
                                {{ image.user.name }}
                            </span>
                            </div>
                        </div>
                    </a>

                    <!--         body             -->
                    <div class="border-bottom mt-3 col-md-6 col-sm-5 overflow-hidden ">
                        <div>
                            <img :src="'/images/images-user-'+image.user_id+'/'+image.name"
                                 alt=""
                                 width="100%"
                                 v-on:dblclick="likeImage(image.id, key)"
                                 style="cursor: pointer">
                        </div>
                    </div>
                        <div class="mt-2 col-md-6 fa-heart-div" align="left" v-if="image.like.length == 0">
                            <i class="far fa-heart" @click="likeImage(image.id, key)"></i>
                            <div>
                                {{ image.like.length }}
                            </div>
                        </div>
                        <div class="mt-2 col-md-6 fa-heart-div" align="left" v-else>
                            <i class="fas fa-heart like" @click="likeImage(image.id, key)"></i>
                            <div>
                                {{ image.like.length }}
                            </div>
                        </div>


                </div>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        props: ['images'],
        name: "FollowersInfoComponent",
        data() {
            return {
                followerImages: "",
            }
        },
        mounted() {
            this.followerImages = this.images;
        },
        methods: {
            likeImage(imageId, key) {
                axios.put("/likeImage/"+imageId).then(response => {
                    if(response.data.status === 200) {
                        this.followerImages[key].like.push({ "image_id":imageId });
                    } else {
                        this.followerImages[key].like = [];
                    }
                })
            }
        }
    }
</script>

<style scoped>

</style>
<template>
    <div class="container">
        <div class="row">
            <div v-for="guestImage in guestImages" class="col-md-3">
                <img :src="'/images/images-user-'+guestImage.user_id+'/'+guestImage.name">
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "GuestImagesComponent",
        props: ['guestImages'],
        mounted() {
            console.log(this.guestImages);
        }
    }
</script>

<style scoped>

</style>

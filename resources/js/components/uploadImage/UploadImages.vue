<template>
    <div>
        <div>
            <label for="images-upload">
                <span class="btn-primary btn">CHOOSE FILE</span>
                <input
                    type="file"
                    multiple
                    id="images-upload"
                    class="d-none"
                    @change="fileChange">
            </label>
            <button class="btn-success btn" @click="uploadImage">UPLOAD</button>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-2" v-for="(image, index) in otherImages">
                    <img :src="'/images/images-user-'+myInfo.id+'/'+image.name" width="150px">
                </div>
            </div>
        </div>

    </div>


</template>

<script>
    export default {
        name: "UploadImages",
        props: ['images', 'myInfo', 'folderId'],
        data() {
            return {
                attachments: [],
                form: new FormData,
                files: '',
                allImages: '',
                otherImages: [],
                sendArr: []
            }

        },
        mounted() {
            this.otherImages = this.images;
        },
        methods: {
            fileChange(e) {

                let selectedFile = e.target.files;

                if (!selectedFile.length) {
                    return false;
                }

                for (let i = 0; i < selectedFile.length; i++) {
                    this.attachments.push(selectedFile[i])
                }


            },

            uploadImage() {

                for (let i = 0; i < this.attachments.length; i++) {
                    this.form.append('pics[]', this.attachments[i]);
                    this.form.append('folderId', this.folderId);
                    console.log(this.attachments[i]);
                }

                let val = $("#images-upload").val();
                val  = []
                this.attachments = [];


                const config = {headers: {'Content-Type': 'multipart/form-data'}};

                axios.post('/uploadImage', this.form, config).then(response => {
                    for(let i = 0; i < response.data.length; i++) {
                        this.otherImages.push(response.data[i]);
                    }
                    this.form = new FormData;
                })
            }
        }
    }
</script>

<style scoped>

</style>

<template>
    <div>
        <button
            @click="likePost"
            class="btn btn-primary ms-4"
            v-text="buttonText"
        ></button>
    </div>
</template>

<script>
export default {
    props: ["postId", "likes"],
    mounted() {
        console.log("Component mounted.");
    },
    data: function () {
        return { status: this.likes };
    },

    methods: {
        likePost() {
            axios
                .post("/like/" + this.postId)
                .then((response) => {
                    console.log(response.data);
                    this.status = !this.status;
                })
                .catch((error) => {
                    if (error.response.status == 401) {
                        window.location = "/login";
                    }
                });
        },
    },
    computed: {
        buttonText() {
            return this.status ? "Unlike" : "Like";
        },
    },
};
</script>

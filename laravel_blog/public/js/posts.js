const { createApp } = Vue

createApp({
    data() {
        return {
            posts: [],
            showForm: false,
            sending: false,
        }
    },

    methods: {
        closeForm() {
            this.showForm = false;
        },

        onSubmit(event) {
            event.preventDefault();
            let data = new FormData(event.target);
            let requestBody = JSON.stringify(Object.fromEntries(data));

            this.sending = true;
            fetch('/posts/create', {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: requestBody
            })
                .then(r => r.json())
                .then((r) => {
                    this.posts.push(r['post']);
                    this.showForm = false;
                    this.sending = false;
                })
                .catch((error) => {
                    console.log('Error:' + error);
                });
        }
    },

    mounted: function() {
        fetch('/api/posts', {
            method: "GET",
            headers: {
                "Content-Type": "application/json",
            },
        })
            .then(r => r.json())
            .then((r) => {
                this.posts = r['posts'];
            })
            .catch((error) => {
                console.log('Error:' + error);
            });
    }
}).mount('.posts-container');

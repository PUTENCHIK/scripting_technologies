const { createApp } = Vue

createApp({
    data() {
        return {
            posts: [],
            showForm: false,
            sending: false,
            loading: false,
            updatingPost: null,
            errors: {}
        }
    },

    methods: {
        closeForm() {
            this.showForm = false;
        },

        createPost(event) {
            event.preventDefault();
            let data = new FormData(event.target);
            let requestBody = JSON.stringify(Object.fromEntries(data));

            this.sending = true;
            fetch('/posts/store', {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json",
                },
                body: requestBody
            })
                .then(r => r.json())
                .then((r) => {
                    if ('errors' in r) {
                        this.errors = r['errors'];
                    } else {
                        this.posts.unshift(r['post']);
                        this.showForm = false;
                    }
                })
                .catch(error => {
                    console.log(error);
                });
            this.sending = false;
        },

        updatePost(event, post_id) {
            event.preventDefault();

            let data = new FormData(event.target);
            let requestBody = JSON.stringify(Object.fromEntries(data));

            this.sending = true;
            fetch(`/posts/${post_id}/update`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json",
                },
                body: requestBody
            })
                .then(r => r.json())
                .then((r) => {
                    if ('errors' in r) {
                        this.errors = r['errors'];
                    } else {
                        this.updatingPost = null;

                        let index;
                        for (let i = 0; i < this.posts.length; i++) {
                            if (this.posts[i].id == post_id) {
                                index = i;
                                break;
                            }
                        }

                        if (index != null) {
                            this.posts[index] = r['post'];
                        }
                    }
                })
            this.sending = false;
        },

        formatDate(dt) {
            let date = new Date(dt);
            let monthes = [
                'января', 'февраля', 'марта', 'апреля',
                'мая', 'июня', 'июля', 'августа',
                'сентября', 'октября', 'ноября', 'декабря',
            ];
            let hours = date.getHours().toString();
            if (hours.length < 2)
                hours = '0' + hours;

            let minutes = date.getMinutes().toString();
            if (minutes.length < 2)
                minutes = '0' + minutes;

            let day = date.getDate().toString();
            if (day.length < 2)
                day = '0' + day;

            return `${hours}:${minutes}, ${day} ${monthes[date.getMonth()]} ${date.getFullYear()}`;
        },

        deletePost(event, id) {
            event.preventDefault();
            let data = new FormData(event.target);
            let requestBody = JSON.stringify(Object.fromEntries(data));

            fetch(`/posts/${id}/delete`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: requestBody
            })
                .then(r => r.json())
                .then((r) => {
                    let index;
                    for (let i = 0; i < this.posts.length; i++) {
                        if (this.posts[i].id == id) {
                            index = i;
                            break;
                        }
                    }
                    if (index != null) {
                        this.posts.splice(index, 1);
                    }
                });
        },

        addComment(event, post_id) {
            let data = new FormData(event.target);
            data.append('post_id', post_id);
            let requestBody = JSON.stringify(Object.fromEntries(data));

            this.sending = true
            fetch('/comments/store', {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: requestBody
            })
                .then(r => r.json())
                .then(r => {
                    for (let i = 0; i < this.posts.length; i++) {
                        let post = this.posts[i];
                        if (post.id == r['comment'].post_id) {
                            post.comments.push(r['comment']);
                        }
                    }
                    event.target.reset();
                    this.sending = false;
                });
            this.sending = false;
        },

        editUpdatingPost(post_id) {
            this.updatingPost = post_id;
            this.errors = {};
            this.showForm = false;
        }
    },

    mounted: function() {
        this.loading = true;
        fetch('/api/posts', {
            method: "GET",
            headers: {
                "Content-Type": "application/json",
            },
        })
            .then(r => r.json())
            .then((r) => {
                this.posts = r['posts'].reverse();
                this.loading = false;
            });
    }
}).mount('.posts-container');

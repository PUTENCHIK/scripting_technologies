const { createApp, ref } = Vue

createApp({
    data() {
        return {
            comments: [],
            statuses: [],
            isCommentsSection: true,
            loading: false,
            sending: false
        }
    },

    methods: {
        sectionComments() {
            this.isCommentsSection = true;
        },

        sectionStatuses() {
            this.isCommentsSection = false;
        },

        loadComments() {
            this.loading = true;
            fetch('/api/comments', {
                method: "GET",
                headers: {
                    'Content-Type': 'application/json'
                }
            })
                .then(r => r.json())
                .then(r => {
                    this.comments = r.comments;
                })
                .catch(error => {
                    console.log("Error: ", error);
                });
            this.loading = false;
        },

        loadStatuses() {
            this.loading = true;
            fetch('/api/statuses', {
                method: "GET",
                headers: {
                    'Content-Type': 'application/json'
                }
            })
                .then(r => r.json())
                .then(r => {
                    this.statuses = r.statuses;
                })
                .catch(error => {
                    console.log("Error: ", error);
                });
            this.loading = false;
        },

        formatDate(dt) {
            let date = new Date(dt);

            let hours = date.getHours().toString();
            if (hours.length < 2)
                hours = '0' + hours;

            let minutes = date.getMinutes().toString();
            if (minutes.length < 2)
                minutes = '0' + minutes;

            let day = date.getDate().toString();
            if (day.length < 2)
                day = '0' + day;

            let month = (date.getMonth() + 1).toString();
            if (month.length < 2)
                month = '0' + month;

            return `${hours}:${minutes}, ${day}.${month}.${date.getFullYear()}`;
        },

        onChangeStatus(event, comment_id) {
            console.log(event, comment_id);

        },

        changeCommentStatus(event, comment_id) {
            console.log(comment_id);
            // event.preventDefault();

            // let data = new FormData(event.target);
            // let requestBody = JSON.stringify(Object.fromEntries(data));
            // console.log(requestBody);
        }
    },

    mounted: function() {
        this.loadComments();
        this.loadStatuses();
    }

}).mount('.app-container');

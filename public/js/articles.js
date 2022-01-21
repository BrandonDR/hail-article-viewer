const ArticleViewer = {
    data() {
        return {
            articles: null,
            error: null
        }
    },
    computed: {
        loading() {
            return !this.error && this.articles == null;
        },
        empty() {
            return this.articles.length == 0;
        }
    },
    mounted() {
        axios.get('/api/articles').then(response => {
            this.articles = response.data;
        }).catch(err => {
            this.error = err.response &&
                err.response.data.message ?
                err.response.data.message : 'An unexpected error occurred. Please try again later.';
        });
    }
};

Vue.createApp(ArticleViewer).mount('#app');
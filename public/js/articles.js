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
    methods: {
        openArticle(article) {
            if (article.status != 'published') {
                alert('Article is not published');
                return;
            }

            window.open(article.url, '_blank');
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
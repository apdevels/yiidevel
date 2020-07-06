<template>
<div>
    <!-- <news-header></news-header> -->
    <main>
       
    </main>
</div>
</template>

<script>
// import NewsHeader from './Header.vue';

export default {
    data() {
        return {
            // allNews: [],
            // tableNews: [],
            // urlNews: 'news/',
            // pageNumber: 1,
            // newsPerPage: 4,
        }
    },
    components: { NewsHeader },
    mounted() {
    },
    computed: {
        // setPage: function() {                        
        //     return this.pageNumber;
        // }
    },
    methods: {
        // setTableNews: function() {
        //     if (!this.allNews || this.allNews.length === 0) return [];
        //     this.pageNumber = this.$refs.pagination.internalCurrentPage;
        //     this.tableNews = this.allNews.slice((this.pageNumber - 1) * this.newsPerPage, this.pageNumber * this.newsPerPage);
        //     return this.tableNews;
        // }
    }
}
</script>

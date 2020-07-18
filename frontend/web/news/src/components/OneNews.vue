<template>
    <div>
        <news-header></news-header>
        <el-row>
            <el-col :span="15">
                <el-button v-on:click="back" type="primary">Назад</el-button>
            </el-col>
        </el-row>
        <el-row>
            <el-col :span="15"><h2>{{ news.title }}</h2></el-col>
        </el-row>
        <el-row>
            <el-col :span="15"><div>{{ news.date }}</div></el-col>
        </el-row>
        <el-row>
            <el-col :span="15"><div v-html="news.text"></div></el-col>
        </el-row>
        <el-row>
            <el-col :span="7">
                <el-card shadow="always">
                    <div>Автор: {{ news.name }}</div>
                    <div>Рейтинг автора: {{ news.rating }}</div>
                    <div>Новостей: {{ news.count }}</div>
                </el-card>
            </el-col>
        </el-row>
    </div>
</template>

<script>

import NewsHeader from './NewsHeader.vue'

export default {
    name: 'OneNews',
    components: {
        NewsHeader
    },
    data() {
        return {
            idn: this.$route.params.idn
        }
    },
    computed: {
        news() {
            return this.$store.getters.oneNews;
        }
    },
    methods: {
        back() {
            this.$router.back();
        }
    },
    mounted() {
        this.$store.dispatch('initOneStore', this.idn);
    },
}
</script>

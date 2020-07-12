<template>
    <div>
        <news-header></news-header>
        <el-row>
            <el-col :span="15">
                <el-button v-on:click="back" type="primary">Назад</el-button>
            </el-col>
        </el-row>
        <el-row>
            <el-col :span="15"><div class="grid-content"><h2>{{ news.title }}</h2></div></el-col>
        </el-row>
        <el-row>
            <el-col :span="15"><div class="grid-content"><span>{{ news.date }}</span></div></el-col>
        </el-row>
        <el-row>
            <el-col :span="15"><div class="grid-content" v-html="news.text"></div></el-col>
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
            // news: ''
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

<style >
  .el-row {
    margin-bottom: 20px;
    width: 1000px;
    /* &:last-child {
      margin-bottom: 0;
    } */
  }
  .el-col {
    border-radius: 4px;
  }
  .bg-purple-dark {
    background: #99a9bf;
  }
  .bg-purple {
    background: #d3dce6;
  }
  .bg-purple-light {
    background: #e5e9f2;
  }
  .grid-content {
    border-radius: 4px;
    min-height: 36px;
  }
  .row-bg {
    padding: 10px 0;
    background-color: #f9fafc;
  }
</style>
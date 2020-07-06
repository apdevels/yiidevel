
<template>
<el-container>
    <el-header style="text-align: center; font-size: 12px">
      <h1>{{title}}</h1>
    </el-header>
</el-container>
</template>

<script>
    export default {
        name: 'news-header',
        data() {
            return {
                title: 'Новости',
            }
        },
        methods: {
            goBack() {
                
            }
        }
    }
</script>

<template>
<div>
    <news-header></news-header>
    <div>
        <el-input type="text" placeholder="Фильтр по заголовку" size="small" v-model="searchTitle" /><br/><br/>
        <el-button @click="open = true" type="primary">Фильтры</el-button><br/><br/>
    </div>
    
    <!-- Основной вывод через фильтры -->
    <el-table :data="news.filter
        ( data => data.title.toLowerCase().includes(searchTitle) )
        | tableDates(date1, date2, newsCount)                       
        | tableName(name, newsCount)                                
        | tablePaginate(firstNews, lastNews)                        
        " stripe border>

        <el-table-column width="180" label="Заголовок">
            <template slot-scope="scope">
                <router-link tag="el-link" :to="{name: 'OneNews', params: {idn: scope.row.id}}">
                    <a>{{scope.row.title}}</a>
                </router-link>        
            </template> 
        </el-table-column>

        <el-table-column prop="date" label="Дата" width="120"></el-table-column>
        <el-table-column prop="name" label="Автор" width="200"></el-table-column>
        <el-table-column prop="description" label="Описание" width="400"></el-table-column>
    </el-table>

    
    <!-- Пагинация -->
    <div class="block">
        <span class="demonstration">Страницы</span>
        <el-pagination
            ref="pagination"
            background
            layout="prev, pager, next"
            :total="newsCount.toShow"
            :page-size="newsPerPage"
            :current-page="setPage"
            @current-change="setTableNews"
        >
        </el-pagination>
    </div>

    
    <!-- Модальное окно с фильтрами -->
    <el-dialog title="Фильтры:" :visible.sync="open">
        <el-form :model="newsForm" status-icon :rules="rules" ref="newsForm" label-width="120px" class="demo-ruleForm">
            <el-form-item label="Интервал дат:" prop="newsDate">
                <div class="block">
                    <span class="demonstration"></span>
                    <el-date-picker
                        v-model="newsForm.newsDate"
                        type="daterange"
                        value-format="yyyy-MM-dd"
                        format="yyyy-MM-dd"
                        align="right"
                        unlink-panels
                        range-separator="-"
                        start-placeholder="Start date"
                        end-placeholder="End date"
                        :default-time="['00:00:00', '23:59:59']"
                        @change="setPageNumberToOne"
                    >
                    </el-date-picker>
                </div>
            </el-form-item>
            <el-form-item label="Автор:" prop="name">
                <el-input v-model.lazy="newsForm.name"></el-input>
            </el-form-item>
            <el-form-item class="dialog-footer">
                <el-button type="success" @click="submitForm('newsForm')">Применить</el-button>
                <el-button type="primary" @click="open = false">Отменить</el-button>
            </el-form-item> 
        </el-form>
    </el-dialog>
</div>
</template>


<script>
const newsPerPage = 4;  // Количество новостей на странице

import NewsHeader from './NewsHeader.vue'

export default {
    name: 'ListNews',
    components: {
        NewsHeader
    },
    data() {
        return {
            open: false,    // Модальное окно
            newsPerPage,
            pageNumber: Number(this.$route.params.id) || 1,                         // Нужна валидация
            firstNews: (Number(this.$route.params.id) - 1) * newsPerPage || 0,      
            lastNews:   Number(this.$route.params.id) * newsPerPage || newsPerPage, 
            searchTitle: '',
            newsForm: {
                newsDate: '',       // Поля ввода формы фильтов
                name: ''
            },
            rules: {                // Правила валидации формы фильтров
                date: [
                    { type: 'daterange',  message: 'Please pick a date', trigger: 'change' }
                ],
                name: [
                    { min: 3, max: 20, message: 'Текст должет содержать от 3-х до 20-ти символов', trigger: 'blur' }
                ]
            },
            flagPageNumberOne: false,       // При смене условий фильтрации страница должна быть первой
            path: '',
            name:  this.$route.params.name  || '',      //
            date1: this.$route.params.date1 || '',      // Нужна валидация
            date2: this.$route.params.date2 || '',      // 
            dates: '',
            newsCount: { toShow: 0 },
            title: 'Список новостей'
            
        };
    },
    filters: {
        tableDates(inputData, d1, d2) {
            if (d1 == '' || d2 == '') {
                return inputData;
            }
            else {
                const dataSlice = inputData.filter(c => (c.date >= d1 && c.date <= d2));
                return dataSlice;
            }
        },
        tableName(inputData, name, count) {
            if (name == '') {
                count.toShow = inputData.length;
                return inputData;
            }
            else {
                const dataSlice = inputData.filter(c => c.name.toLowerCase().includes(name+''));
                count.toShow = dataSlice.length;
                return dataSlice;
            }
        },
        tablePaginate: (inputData, firstNews, lastNews) => {
            return inputData.slice(firstNews, lastNews);
        }
    },
    computed: {
        news() {
            return this.$store.getters.news;
        },
        setPage() {                        
            return this.pageNumber;
        },
        pageSize() {
            return this.newsCount / newsPerPage;
        },
    },
    methods: {
        /**
         *
         */
        setTableNews() {
            this.pageNumber = this.flagPageNumberOne ? 1 : this.$refs.pagination.internalCurrentPage;    // Номер страницы из пагинации
            this.firstNews  = (this.pageNumber - 1) * newsPerPage;
            this.lastNews   = this.pageNumber * newsPerPage;
            this.setUrl();
        },
        setUrl() {
            if (this.date1 && this.name && this.pageNumber > 0) {
                this.$router.push(
                    '/d1/' + this.date1 + '/d2/' + this.date2 + 
                    '/n/'  + this.name + 
                    '/p/'  + this.pageNumber
                    
                );
            }
            else if ( this.date1 && this.pageNumber > 0) {
                this.$router.push(
                    '/d1/' + this.date1 + '/d2/' + this.date2 + 
                    '/p/'  + this.pageNumber
                );
            }
            else if ( this.name && this.pageNumber > 0) {
                this.$router.push(
                    '/n/' + this.name + 
                    '/p/' + this.pageNumber
                );
            }
            else if ( this.date1 && this.name) {
                this.$router.push(
                    '/d1/' + this.date1 + '/d2/' + this.date2 + 
                    '/n/'  + this.name
                );
            }
            else if (this.date1) {
                this.$router.push('/d1/' + this.date1 + '/d2/' + this.date2);
            } 
            else if (this.name) {
                this.$router.push('/n/' + this.name);
            }
            else if (this.pageNumber > 0) {
                this.$router.push('/p/' + this.pageNumber);
            }
            else this.$router.push('/');

            this.resetFlagPageNumberOne();
            this.open = false;
        },
        submitForm(newsForm) {
            this.$refs[newsForm].validate((valid) => {
                if (valid) {
                    this.pageNumber = 1;            // После применения фильтров 
                    this.setFlagPageNumberOne();    // страница устанавливается в первую
                    this.dates = this.newsForm.newsDate + '';           // Для сплита нужна строка
                    [this.date1, this.date2] = this.dates.split(',');
                    this.name = this.newsForm.name;
                    this.setTableNews();
                }
            });
        },
        setPageNumberToOne() {
            this.pageNumber = 1;
        },
        setFlagPageNumberOne() {
            this.flagPageNumberOne = true;
        },
        resetFlagPageNumberOne() {
            this.flagPageNumberOne = false;
        }
    },
    // components: { NewsHeader },
    mounted() {
        this.$store.dispatch('initStore');
    }
}
</script>

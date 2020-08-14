<template>
<div>
    <news-header></news-header>
    <div class="col-3">
        <el-input type="text" placeholder="Фильтр по заголовку" size="small" v-model="searchTitle" /><br/><br/>
        <el-button @click="open = true" type="primary">Фильтры</el-button><br/><br/>
    </div>
    
    <!-- Основной вывод через фильтры -->
    <el-table :data="news.filter
        ( data => data.title.toLowerCase().includes(searchTitle) )
        | tableDates(date1, date2)
        | tableName(name, newsCount)
        | tablePaginate(firstNews, lastNews)                        
        "
              stripe border>

        <el-table-column width="280" label="Заголовок">
            <template slot-scope="scope">
                <router-link tag="el-link" :to="{name: 'OneNews', params: {idn: scope.row.id}}">
                    <a>{{scope.row.title}}</a>
                </router-link>        
            </template> 
        </el-table-column>

        <el-table-column prop="date" label="Дата" width="120"></el-table-column>
        <el-table-column prop="name" label="Автор" width="200"></el-table-column>
        <el-table-column prop="description" label="Описание" width="399"></el-table-column>
    </el-table>

    
    <!-- Пагинация -->
    <div class="block">
        <div class="demonstration">Страницы:</div>
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
    <el-dialog title="Фильтры:" :visible.sync="open" width="31%">
        <el-form :model="newsForm" status-icon :rules="rules"
                 ref="newsForm" label-width="120px" class="demo-ruleForm">
            <el-form-item label="Интервал дат:" prop="newsDate">
                <div class="block">
                    <span class="demonstration"></span>
                    <el-date-picker
                        v-model="newsForm.newsDate"
                        type="daterange"
                        value-format="yyyy-MM-dd"
                        format="yyyy-MM-dd"
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
                <el-col :span="19">
                    <el-input v-model.lazy="newsForm.name"></el-input>
                </el-col>
            </el-form-item>
            <el-form-item class="dialog-footer">
                <el-button type="success"
                           @click="submitForm('newsForm')">
                    Применить
                </el-button>
                <el-button type="primary" @click="open = false">
                    Отменить
                </el-button>
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
            pageNumber: Number(this.$route.params.id) || 1,
            firstNews: (Number(this.$route.params.id) - 1) * newsPerPage || 0,      
            lastNews:   Number(this.$route.params.id) * newsPerPage || newsPerPage, 
            searchTitle: '',
            newsForm: {
                newsDate: '',       // Поля ввода формы фильтов
                name: ''            //
            },
            rules: {                // Правила валидации формы фильтров
                date: [
                    { type: 'daterange',  message: 'Please pick a date', trigger: 'change' }
                ],
                name: [
                    { min: 3, max: 20, message: 'Текст должет содержать от 3-х до 20-ти символов', trigger: 'blur' }
                ]
            },
            flagPageNumberOne: false,       // После фильтрации страница должна стать первой
            path: '',
            name:  this.$route.params.name || '',
            date1: this.$route.params.date1 || '',
            date2: this.$route.params.date2 || '',
            newsCount: { toShow: 0 },
            title: 'Список новостей'
        };
    },
    filters: {
        /**
         *  tableDates - фильтр по дате (интервал)
         *
         * @param {Array} inputData
         * @param {String} d1
         * @param {String} d2
         *
         * @returns {Array}
         */
        tableDates(inputData, d1, d2) {
            if (d1 === '' || d2 === '') {
                return inputData;
            }
            else {
                return inputData.filter(c => (c.date >= d1 && c.date <= d2));
            }
        },
        /**
         *  tableName - фильтр по имени автора
         *
         * @param {Array} inputData
         * @param {String} name
         * @param {Object} count
         *
         * @returns {Array}
         */
        tableName(inputData, name, count) {
            if (name === '') {
                count.toShow = inputData.length;
                return inputData;
            }
            else {
                const dataSlice = inputData.filter(c => c.name.toLowerCase().includes(name+''));
                count.toShow = dataSlice.length;
                return dataSlice;
            }
        },
        /**
         *  tablePaginate - фильтр по пагинации
         *
         * @param {Array} inputData
         * @param {Number} firstNews
         * @param {Number} lastNews
         *
         * @returns {array}
         */
        tablePaginate: (inputData, firstNews, lastNews) => {
            return inputData.slice(firstNews, lastNews);
        }
    },
    computed: {
        /**
         * Метод news возвращает все новости из хранилища
         *
         * @returns {Array}
         */
        news() {
            return this.$store.getters.news;
        },
        /**
         * Метод setPage возвращает текущую страницу
         *
         * @returns {Number}
         */
        setPage() {                        
            return this.pageNumber;
        },
    },
    methods: {
        /**
         *  Метод setTableNews срабатывает по событию
         *  изменения страницы в пагинации и определяет
         *  первую и последнюю новость для вывода.
         */
        setTableNews() {
            // Номер страницы из пагинации
            this.pageNumber = this.flagPageNumberOne ? 1
                : this.$refs.pagination.internalCurrentPage;
            this.firstNews  = (this.pageNumber - 1) * newsPerPage;
            this.lastNews   = this.pageNumber * newsPerPage;
            this.setUrl();
        },
        /**
         * Метод setUrl собирает параметры для УРЛа.
         *
         * param {String} this.date1
         * param {String} this.name
         * param {Number} this.pageNumber
         */
        setUrl() {
            if (this.date1 && this.name && this.pageNumber > 0) {
                this.$router.push(
                    '/d1/' + this.date1 + '/d2/' + this.date2 +
                    '/n/'  + this.name + this.pageOneOrNo(this.pageNumber)
                );
            }
            else if ( this.date1 && this.pageNumber > 0) {
                this.$router.push(
                    '/d1/' + this.date1 + '/d2/' + this.date2 +
                    this.pageOneOrNo(this.pageNumber)
                );
            }
            else if ( this.name && this.pageNumber > 0) {
                this.$router.push(
                    '/n/' + this.name +
                    this.pageOneOrNo(this.pageNumber)
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
                // this.$router.push('/p/' + this.pageNumber);
                this.$router.push(this.pageOneOrNo(this.pageNumber));
            }
            else this.$router.push('/');

            this.resetFlagPageNumberOne();
            this.open = false;              // Закрываем модальное окно
        },
        /**
         * pageOneOrNo не показывает пагинацию в УРЛе
         * если страница - первая
         *
         * @param {Number} page
         * @returns {String}
         */
        pageOneOrNo(page) {
            return page === 1 ? '/' : '/p/' + page;
        },
        /**
         * Метод submitForm - сабмит формы.
         *
         * @param {Object} newsForm
         */
        submitForm(newsForm) {
            this.$refs[newsForm].validate((valid) => {
                if (valid) {
                    this.pageNumber = 1;            // После применения фильтров
                    this.setFlagPageNumberOne();    // страница устанавливается в первую
                    // this.dates = String(this.newsForm.newsDate);
                    // Разбивает строку с датами на две даты: "с" и "по"
                    [this.date1, this.date2] = String(this.newsForm.newsDate).split(',');
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
    mounted() {
        this.$store.dispatch('initStore');
    }
}
</script>

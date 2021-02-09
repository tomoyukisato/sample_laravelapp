
<template>
    <div class="d-block ma-5">
    <div id="calendar">

        <FullCalendar 
            defaultView="dayGridMonth" 
            :locale="locale"
            :custom-buttons="customButtons"
            :header="calendarHeader"
            :weekends="calendarWeekends"
            :plugins="calendarPlugins"
            :height="heightResize"
            :events="calendarEvents"
            @dateClick="handleDateClick"
            @eventClick="handleEventClick"
        />
    </div>
    <memo-form  
            :date="date" 
            ref="dialog"
            @register="getSchedule">

    </memo-form>
    <memo-detail  
            :date="date"
            :image="memoImages"  
            ref="detail_dialog"
            @register="getSchedule"
            @reset="close"
            @update="openUpdate">

    </memo-detail>
    </div>
</template>

<script>

import FullCalendar from "@fullcalendar/vue";
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from "@fullcalendar/timegrid";
import interactionPlugin from "@fullcalendar/interaction";
import jaLocale from "@fullcalendar/core/locales/ja";

import MemoForm from "./MemoForm.vue";
import MemoDetail from "./MemoDetail.vue";
// import TemplateFormGroupComponent from './contents/TemplateFormGroupComponent.vue';

export default {
    components: {
        FullCalendar,
        MemoForm,
        MemoDetail
    },
    data() {
        return {
            //   calendarPlugins: [ dayGridPlugin ]
            text: "",
            date:"",
            content:"",
            memoImages:[],
            customButtons: function() {
            return {
                custom1: {
                text: "Copy week",
                click: () => alert("clicked the custom button!")
                }
            };
            },
            locale: jaLocale, // 日本語化
            // カレンダーヘッダーのデザイン
            calendarHeader: {
                
                    left: "prev,next, agendaDay, custom1",
                    center: "title",
                    right: "custom1"//timeGridWeek,timeGridDay,listWeek"
            },
            calendarWeekends: true, // 土日を表示するか
            // カレンダーで使用するプラグイン
            calendarPlugins: [dayGridPlugin,interactionPlugin, timeGridPlugin],
            // カレンダーに表示するスケジュール一覧
            calendarEvents: [
                // {
                // title: "報告会",
                // start: "2020-03-10T10:00:00",
                // end: "2020-03-10T12:30:00"
                // },
                // {
                // title: "ミーティング",
                // start: "2020-03-12T10:30:00",
                // end: "2020-03-12T12:30:00"
                // },
                // {
                // title: "打ち合わせ",
                // start: "2020-03-18T13:30:00",
                // end: "2020-03-18T14:30:00"
                // }
            ],
            heightResize: window.innerHeight - 100, // ①
                windowResize: function () { // ②
                    $('#calendar').fullCalendar('option', 'height', window.innerHeight - 100);
                }
        }
    },
    created:function(){
        this.getSchedule();
        
    },
    methods: {
        close() {
            console.log("closeされました");
            this.memoImages= [];
        },
        getSchedule(){
            console.log("aaaa");
            axios.get('/daily_menu_app/public/api/memo').then(
            response => {
                this.calendarEvents = response.data;
                // keys = [ 'title', 'start', 'content'];

                // srcData = this.calendarEvents.map(e => 
                //     Object.fromEntries(                      
                //         Object.entries(e).map(([k, v]) => [keys[k], v])
                //     )
                // );
            })
        },
        getImage(image_id){
            console.log("aaaa");
            axios.get('/daily_menu_app/public/api/image/'+image_id).then(
            response => {
                // this.memoImages = response.data;
                let array = response.data
                array.forEach(img => {
                    
                    this.memoImages.push(img.file_path);
                })
                    console.log('TTTT');
                    console.log(this.memoImages);
                // keys = [ 'title', 'start', 'content'];

                // srcData = this.calendarEvents.map(e => 
                //     Object.fromEntries(                      
                //         Object.entries(e).map(([k, v]) => [keys[k], v])
                //     )
                // );
            })
        },
        openUpdate(value){
            console.log("値受け取りました");
            console.log(value);


            this.$refs.detail_dialog.close();
            console.log(value.id);
            console.log(value.title);
            console.log(value.content);
            this.$refs.dialog.open(value.id,value.title,value.content);
        },
        handleDateClick(arg) {
            console.log(arg);
            this.flag=true;
            this.date = arg.dateStr; 
            console.log(this.flag);
            // if (confirm("新しいスケジュールを" + arg.dateStr + "に追加しますか ?")) {
            //     this.calendarEvents.push({
            //     // add new event data
            //     title: "新規スケジュール",
            //     start: arg.date,
            //     allDay: arg.allDay
            //     });
            // }
            this.$refs.dialog.open();
            // var ComponentClass = Vue.extend(MemoForm)
            //     var instance = new ComponentClass({
            //         // 追加 
            //         propsData: {
            //             dialog: this.flag,
            //             date: '2020'
            //         }
            //     });
            //     instance.$mount();
        },
        handleEventClick: function(calEvent, jsEvent, view) {
            console.log(this.calendarEvents);
            console.log( calEvent.event);
            this.flag=true;

            var id = this.calendarEvents.filter(item => item.id == calEvent.event.id)[0].id;
            var text = this.calendarEvents.filter(item => item.id == calEvent.event.id)[0].title;
            var content = this.calendarEvents.filter(item => item.id == calEvent.event.id)[0].content;
            this.getImage(id);
            // console.log(this.event);
            // this.date = calEvent.event;
            // this.date = ;
            // this.date = arg.dateStr; 
            console.log("QQQ");
            console.log(this.memoImages);
            this.$refs.detail_dialog.open(id,text,content);

            // alert('Event: ' + calEvent.event.title);
            // alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);
            // alert('View: ' + view.name);

            // change the border color just for fun
            $(this).css('border-color', 'red');

        }
    }
}
</script>

<style lang='scss'>

@import '~@fullcalendar/core/main.css';
@import '~@fullcalendar/daygrid/main.css';

@media screen and (min-width:1024px) {
    #calendar{
    width: 80%;
    margin-left: 100px;
    box-shadow: 0px 0px 10px #000;
    padding:15px; 
    background: #fff;
    }
    #calendar-container {
        position: fixed;
        top: 0%;
        text-align: center;
        left: 10%;
        right: 10%;
        bottom: 20%;
    }
}
.fc-time{
   display : none;
}
</style>
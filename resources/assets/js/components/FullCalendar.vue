
<template>
    <div class="d-block pa-4">
    <div id="calendar">

        <FullCalendar 
            defaultView="dayGridMonth" 
            :locale="locale"
            :custom-buttons="customButtons"
            :header="calendarHeader"
            :weekends="calendarWeekends"
            :plugins="calendarPlugins"
            :events="calendarEvents"
            @dateClick="handleDateClick"
            @eventClick="handleEventClick"
        />
    </div>
    <memo-form  
            :text="text" 
            :date="date" 
            ref="dialog"
            @register="getSchedule">

    </memo-form>
    </div>
</template>

<script>

import FullCalendar from "@fullcalendar/vue";
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from "@fullcalendar/timegrid";
import interactionPlugin from "@fullcalendar/interaction";
import jaLocale from "@fullcalendar/core/locales/ja";

import MemoForm from "./MemoForm.vue";
// import TemplateFormGroupComponent from './contents/TemplateFormGroupComponent.vue';

export default {
    components: {
        FullCalendar,
        MemoForm
    },
    data() {
        return {
            //   calendarPlugins: [ dayGridPlugin ]
            text: "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididuntse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.",
            date:"",
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
                    right: "dayGridMonth,timeGridWeek,timeGridDay,listWeek"
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
            ]
        }
    },
    created:function(){
        this.getSchedule();
    },
    methods: {
        getSchedule(){
            console.log("aaaa");
            axios.get('/sample_laravelapp/public/api/memo').then(
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
            console.log(calEvent.event.title);
            this.flag=true;
            
            // this.date = arg.dateStr; 
            console.log(this.flag);
            this.$refs.dialog.open();

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

//   #top {
//     background: #eee;
//     border-bottom: 1px solid #ddd;
//     padding: 0 10px;
//     line-height: 40px;
//     font-size: 12px;
//   }

//   #calendar {
//     max-width: 900px;
//     margin: 40px auto;
//     padding: 0 10px;
//   }
</style>
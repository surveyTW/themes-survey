﻿/* Chinese initialisation for the jQuery UI date picker plugin. */
/* Written by Ressol (ressol@gmail.com). */
(function($) {
        $.datepicker.regional['zh-TW'] = {
                /*renderer: $.extend({}, $.ui.datepicker.defaultRenderer,
                        {month: $.ui.datepicker.defaultRenderer.month.
                                replace(/monthHeader:M yyyy/, 'monthHeader:yyyy年 M')}),*/
                monthNames: ['一月','二月','三月','四月','五月','六月',
                '七月','八月','九月','十月','十一月','十二月'],
                monthNamesShort: ['一','二','三','四','五','六',
                '七','八','九','十','十一','十二'],
                dayNames: ['星期日','星期一','星期二','星期三','星期四','星期五','星期六'],
                dayNamesShort: ['周日','周一','周二','周三','周四','周五','周六'],
                dayNamesMin: ['日','一','二','三','四','五','六'],
                dateFormat: 'mm/dd/yy',
                firstDay: 1,
                prevText: '&#x3c;上月', prevStatus: '',
                prevJumpText: '&#x3c;&#x3c;', prevJumpStatus: '',
                nextText: '下月&#x3e;', nextStatus: '',
                nextJumpText: '&#x3e;&#x3e;', nextJumpStatus: '',
                currentText: '今天', currentStatus: '',
                todayText: '今天', todayStatus: '',
                clearText: '-', clearStatus: '',
                closeText: '關閉', closeStatus: '',
                yearStatus: '', monthStatus: '',
                weekText: '周', weekStatus: '',
                dayStatus: 'DD d MM',
                defaultStatus: '',
                isRTL: false
        };
        $.extend($.datepicker.defaults, $.datepicker.regional['zh-TW']);
})(jQuery);

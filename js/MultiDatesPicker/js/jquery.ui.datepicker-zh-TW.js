/* Chinese initialisation for the jQuery UI date picker plugin. */
/* Written by Ressol (ressol@gmail.com). */
(function($) {
        $.ui.datepicker.regional['zh-TW'] = {
                /*renderer: $.extend({}, $.ui.datepicker.defaultRenderer,
                        {month: $.ui.datepicker.defaultRenderer.month.
                                replace(/monthHeader:M yyyy/, 'monthHeader:yyyy�~ M')}),*/
                monthNames: ['�@��','�G��','�T��','�|��','����','����',
                '�C��','�K��','�E��','�Q��','�Q�@��','�Q�G��'],
                monthNamesShort: ['�@','�G','�T','�|','��','��',
                '�C','�K','�E','�Q','�Q�@','�Q�G'],
                dayNames: ['�P����','�P���@','�P���G','�P���T','�P���|','�P����','�P����'],
                dayNamesShort: ['�P��','�P�@','�P�G','�P�T','�P�|','�P��','�P��'],
                dayNamesMin: ['��','�@','�G','�T','�|','��','��'],
                dateFormat: 'yyyy/mm/dd',
                firstDay: 1,
                prevText: '&#x3c;�W��', prevStatus: '',
                prevJumpText: '&#x3c;&#x3c;', prevJumpStatus: '',
                nextText: '�U��&#x3e;', nextStatus: '',
                nextJumpText: '&#x3e;&#x3e;', nextJumpStatus: '',
                currentText: '����', currentStatus: '',
                todayText: '����', todayStatus: '',
                clearText: '-', clearStatus: '',
                closeText: '����', closeStatus: '',
                yearStatus: '', monthStatus: '',
                weekText: '�P', weekStatus: '',
                dayStatus: 'DD d MM',
                defaultStatus: '',
                isRTL: false
        };
        $.extend($.ui.datepicker.defaults, $.ui.datepicker.regional['zh-TW']);
})(jQuery);

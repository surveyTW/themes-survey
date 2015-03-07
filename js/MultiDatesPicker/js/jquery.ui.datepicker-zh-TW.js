/* Chinese initialisation for the jQuery UI date picker plugin. */
/* Written by Ressol (ressol@gmail.com). */
(function($) {
        $.ui.datepicker.regional['zh-TW'] = {
                renderer: $.extend({}, $.ui.datepicker.defaultRenderer,
                        {month: $.ui.datepicker.defaultRenderer.month.
                                replace(/monthHeader:M yyyy/, 'monthHeader:yyyy�~ M')}),
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
Hide details
Change log
r3875 by kbwood.au on Mar 6, 2010   Diff
Refactor of datepicker
Go to: 	
Older revisions
 r3874 by kbwood.au on Mar 5, 2010   Diff 
 r3243 by rdworth on Sep 17, 2009   Diff 
 r3093 by cloudream on Aug 19, 2009   Diff 
All revisions of this file
File info
Size: 1429 bytes, 32 lines
View raw file
File properties
svn:mime-type
text/javascript
svn:eol-style
native

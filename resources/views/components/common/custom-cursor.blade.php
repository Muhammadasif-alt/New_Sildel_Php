{{--
    common/custom-cursor: a bronze dot on the pointer, a bronze ring that follows a little behind,
    and a gold dashed ring around it that turns slowly. The ring grows over links and buttons, and
    becomes a filled circle with a label over any element with data-cursor="Label".
    Enabled by resources/js/modules/cursor.js only on fine pointers with hover and without reduced
    motion (never on touch devices). The system pointer stays visible.
--}}
<div class="cursor" data-cursor-dot aria-hidden="true"></div>
<div class="cursor-ring" data-cursor-ring aria-hidden="true"><span class="cursor-ring-dash"></span></div>
<div class="cursor-label" data-cursor-label aria-hidden="true"></div>

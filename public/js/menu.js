function changeMenuPoint(){
    $(".navigate-item").each(function() {
        const $item = $(this);
        const $text = $item.find(".navigate-text");
        
        // Пропускаем пункт внутри dropdown (он обрабатывается отдельно)
        if ($item.closest('.navigate-dropdown-menu').length) {
            return;
        }
        
        $item.hover(
            function() {
                $text.css({
                    color: "#323232",
                    fontWeight: 'bold',
                    transform: 'translateY(-2px)',
                });
                $item.css('backgroundColor', '#FFFFF0');
            },
            function() {
                $text.css({
                    color: '#FFFFF0',
                    fontWeight: 'normal',
                    transform: 'translateY(0)'
                });
                $item.css('backgroundColor', 'transparent');
            }
        );
    });
}

function drpdownMenu() {
    $(".navigate-dropdown-menu").each(function() {
        const $dropdown = $(this);
        const $menu = $dropdown.find('.dropdown-menu');

        $dropdown.hover(
            function() {
                $menu.css({
                    opacity: '1',
                    visibility: 'visible',
                    transform: 'translateX(-50%) translateY(0)'
                });
            },
            function() {
                $menu.css({
                    opacity: '0',
                    visibility: 'hidden',
                    transform: 'translateX(-50%) translateY(8px)'
                });
            }
        );
    });
}

$(document).ready(function() {
    drpdownMenu();
    changeMenuPoint();
    
    // const lang = navigator.language;
    // let date = new Date();
    // let dayNum = date.getDate();
    // let dayMonth = date.getMonth() + 1;
    // let dateYear = date.getFullYear();
    // let dayName = date.toLocaleString(lang, {weekday: 'long'});
    
    // $(".date").text(`${dayNum}.${dayMonth}.${dateYear}   ${dayName}`);
});
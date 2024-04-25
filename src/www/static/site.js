$(document).ready(function() {
    $(".spoiler").each(function() {
        $(this).addClass("blured");
        let parent = $(this).parent();
        $(this).remove();
        
        let container = $(" \
            <div class=\"position-relative text-center\"> \
            <div> \
        ");

        let baner = $(" \
                <p class=\"spoiler-text position-absolute top-50 start-50 translate-middle\"> \
                    Spoiler \
                </p> \
            ");

        container.append($(this));
        container.append(baner);
        parent.prepend(container);

        $(this).click(() => ToggleBlur($(this), baner));
        baner.click(() => ToggleBlur($(this), baner));
    });
});

function ToggleBlur(img, baner) {
    img.toggleClass('blured');
    baner.toggleClass('hidden');
}

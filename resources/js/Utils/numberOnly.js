export function onlyNumber($event) {
    let keyCode = $event.keyCode ? $event.keyCode : $event.which;
    if (keyCode < 48 || keyCode > 57) {
        // 46 is dot
        $event.preventDefault();
    }
};

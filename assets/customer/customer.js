// add-collection-widget.js
function removeItem(e) {
    console.log('Trying to remove');
    $(this).closest('.contact-item')
        .fadeOut()
        .remove();
}

$(document).ready(function () {
    $('.add-contact-btn').click(function (e) {
        let list = $($(this).data('list-selector'));
        console.log(list);
        // Try to find the counter of the list or use the length of the list
        let counter = list.data('widget-counter');

        // grab the prototype template
        let newWidget = list.data('prototype');
        // replace the "__name__" used in the id and name of the prototype
        // with a number that's unique to your emails
        // end name attribute looks like name="contact[emails][2]"
        newWidget = newWidget.replace(/__name__/g, counter);
        // Increase the counter
        counter++;
        // And store it, the length cannot be used if deleting widgets is allowed
        list.data('widget-counter', counter);

        // create a new list element and add it to the list
        let newElem = $(newWidget);
        newElem.on('onclick', '.remove-contact-btn', removeItem);
        newElem.appendTo(list);
    });
    console.log('testing');
    $('.remove-contact-btn').click(removeItem);
});

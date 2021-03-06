/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you require will output into a single css file (app.scss in this case)
require('../css/app.scss');

// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
const $ = require('jquery');

import 'bulma-fluent/bulma.sass';

$(document).ready(function() {

    // Check for click events on the navbar burger icon
    $(".navbar-burger").click(function() {

        // Toggle the "is-active" class on both the "navbar-burger" and the "navbar-menu"
        $(".navbar-burger").toggleClass("is-active");
        $(".navbar-menu").toggleClass("is-active");

    });

    document.addEventListener('DOMContentLoaded', () => {
        (document.querySelectorAll('.notification .delete') || []).forEach(($delete) => {
            $notification = $delete.parentNode;
            $delete.addEventListener('click', () => {
                $notification.parentNode.removeChild($notification);
            });
        });
    });

    $('.booking-form').on('submit', function (e) {
        e.preventDefault();

        let data = new FormData();
        data.append('eventId', this[0].value);

        let req = new Request($(this).attr("action"), { method: $(this).attr("method"), body: data });

        fetch(req).then().then(
            function () {
                notificationCreate('success', 'You added a ticket to your cart !');
            }
        )
    });

    $('.trash-cart').on('click', function (e) {
        e.preventDefault();

        let req = new Request(this.href, {method: 'DELETE'});
        let id = this.href.split('/')[4];

        fetch(req)
            .then()
            .then(function (response) {
                let row = $('.row-' + id);
                let quantityColumn = $('.row-' + id + ' td:first-child')[0];
                let quantity = quantityColumn.innerHTML - 1;

                let priceColumn = $('.row-' + id + ' td:nth-child(3)')[0];
                let price = priceColumn.attributes[0].value;
                let thTotalPrice = $('.totalPrice');
                let totalPrice = priceColumn.innerHTML.split('€')[0];

                quantityColumn.innerHTML = quantity;

                totalPrice -= price;
                priceColumn.innerHTML = totalPrice.toFixed(2) + '€';
                thTotalPrice[0].innerHTML = 'Total price : ' + totalPrice.toFixed(2) + '€';

                if (quantity === 0) {
                    let parent = row[0].parentNode;
                    row.remove();
                    if ($('.cart').length === 0){
                        let tr = document.createElement('tr');
                        let td = document.createElement('td');
                        td.innerHTML = 'Nothing in your cart !';
                        tr.append(td);
                        parent.insertBefore(tr, $('.tprice')[0]);
                        thTotalPrice[0].innerHTML = 'Total price : 0€';
                    }
                }
                notificationCreate('danger', 'You removed a ticket !');
            })
    });

    const notificationCreate = (type, message) => {

        let notificationsDiv = $('#notifications');
        let notificationDiv = $('.notification');
        if (notificationDiv.length !== 0) {
            notificationDiv[0].parentNode.removeChild(notificationDiv[0]);
        }

        let notification = document.createElement('div');
        notification.className = 'notification is-' + type;
        let buttonClose = document.createElement('div');
        buttonClose.className = 'delete';
        notification.append(buttonClose);
        notification.innerHTML = message;

        notificationsDiv.append(notification);
    }
});

// Initialize all input of type date
var calendars = bulmaCalendar.attach('[type="date"]', options);

console.log(calendars);
// Loop on each calendar initialized
for(var i = 0; i < calendars.length; i++) {
    // Add listener to date:selected event
    calendars[i].on('select', date => {
        console.log(date);
    });
}

// To access to bulmaCalendar instance of an element
var element = document.querySelector('#my-element');
if (element) {
    // bulmaCalendar instance is available as element.bulmaCalendar
    element.bulmaCalendar.on('select', function(datepicker) {
        console.log(datepicker.data.value());
    });
}
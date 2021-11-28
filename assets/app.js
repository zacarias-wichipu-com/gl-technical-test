/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';

const $ = require('jquery');
// this "modifies" the jquery module: adding behavior to it
// the bootstrap module doesn't export/return anything
require('bootstrap');

// or you can include specific pieces
// require('bootstrap/js/dist/tooltip');
// require('bootstrap/js/dist/popover');

$(document).ready(function () {
    $("form[name='fibonacci_sequence']").on('submit', function (event) {
        event.preventDefault();

        $('#fAlert').remove();

        const formData = new FormData(event.target);

        let lower_limit = formData.get('fibonacci_sequence[lower_limit]').replace(/T/i, '');
        let upper_limit = formData.get('fibonacci_sequence[upper_limit]').replace(/T/i, '');

        $.ajax({
            method: 'GET',
            url: app_fibonacci_api_get_route,
            data: {'lower_limit': lower_limit, 'upper_limit': upper_limit}
        })
            .done(function (response) {
                if (response.contained_numbers !== undefined && Array.isArray(response.contained_numbers) && response.contained_numbers.length > 0) {
                    $("main[role='main']").append('<div id="fAlert" class="alert alert-success" role="alert">The numbers of the Fibonacci series contained between the dates are: ' + response.contained_numbers.join(',') + '.</div>');
                    return;
                }
                $("main[role='main']").append('<div id="fAlert" class="alert alert-danger" role="alert">There are no Fibonacci numbers between these dates.</div>');
            });
    });
});

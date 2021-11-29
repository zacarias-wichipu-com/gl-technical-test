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

        let start_date = formData.get('fibonacci_sequence[start_date]').replace(/T/i, ' ');
        let end_date = formData.get('fibonacci_sequence[end_date]').replace(/T/i, ' ');

        $.ajax({
            method: 'GET',
            url: app_fibonacci_api_get_route,
            data: {'start_date': start_date, 'end_date': end_date}
        })
            .done(function (response) {
                if (response.fibonacci_sequence_range_match !== undefined && Array.isArray(response.fibonacci_sequence_range_match) && response.fibonacci_sequence_range_match.length > 0) {
                    $("main[role='main']").append('<div id="fAlert" class="alert alert-success" role="alert">The numbers of the Fibonacci series contained between the dates are: ' + response.fibonacci_sequence_range_match.join(', ') + '.</div>');
                    return;
                }
                $("main[role='main']").append('<div id="fAlert" class="alert alert-warning" role="alert">There are no Fibonacci numbers between these dates.</div>');
            })
            .fail(function (jqXHR) {
                let error_message = 'Se ha producido un error, por favor, inténtalo de nuevo.'
                if (jqXHR.responseJSON !== undefined && jqXHR.responseJSON.error !== undefined && jqXHR.responseJSON.error.length > 0) {
                    error_message = jqXHR.responseJSON.error
                }
                $("main[role='main']").append('<div id="fAlert" class="alert alert-danger" role="alert">' + error_message + '</div>');
                return;
            });
    });
});

import autocomplete from 'jquery-ui/ui/widgets/autocomplete';
import './../styles/autocomplete.scss';

console.log('test');

$('.player-name').autocomplete({
    source: function (request, response) {
        $.get("https://www.balldontlie.io/api/v1/players?search=" + request.term, function (data) {
            console.log(data.data)
            response((data.data).slice(0, 6));
        });
    }
}).data('ui-autocomplete')._renderItem = function (ul, item) {
    console.log(item)
    return $("<li>").append("<a href='/player/" + item.id + "' class='text-light'>" + item.first_name + " " + item.last_name + "</a>").appendTo(ul);
};
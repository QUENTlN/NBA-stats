let $ = require("jquery");

import autocomplete from 'jquery-ui/ui/widgets/autocomplete';


function log( message ) {
    $( "<div>" ).text( message ).prependTo( "#log" );
    $( "#log" ).scrollTop( 0 );
}

var availableTags = [
    {"ActionScript": 1},
    "AppleScript",
    "Asp",
    "BASIC",
    "C",
    "C++",
    "Clojure",
    "COBOL",
    "ColdFusion",
    "Erlang",
    "Fortran",
    "Groovy",
    "Haskell",
    "Java",
    "JavaScript",
    "Lisp",
    "Perl",
    "PHP",
    "Python",
    "Ruby",
    "Scala",
    "Scheme"
];
$("#player-name").autocomplete({ //availableTags
    source: function( request, response ) {
        // console.log(request)
        // console.log(response)
        $.get( "https://www.balldontlie.io/api/v1/players?search="+request.term, function( data ) {
            // console.log(data);
            response( (data.data).slice(0, 7) );
        });
    }
}).data('ui-autocomplete')._renderItem = function(ul,item){
    console.log(item)
    console.log('test')
    return $("<li>").append("<a href='/player/"+item.id+"' class='text-light'>"+item.first_name+" "+item.last_name+"</a>").appendTo(ul);
};
import './styles/home.scss';
import './features/autocomplete';

$("button").on("click", function(){
    window.location.href = "/players/"+$("#player-name").val();
})
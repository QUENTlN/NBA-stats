import './features/autocompleteStats';
import autocomplete from 'jquery-ui/ui/widgets/autocomplete';
import './styles/autocomplete.scss';

$( document ).ready(function() {
    refreshColors()
});

$('.player-name').on("focus", function () {
    $(this).autocomplete({
        source: function (request, response) {
            $.get("https://www.balldontlie.io/api/v1/players?search=" + request.term, function (data) {
                response((data.data).slice(0, 12));
            });
        }
    }).data('ui-autocomplete')._renderItem = function (ul, item) {
        return $("<li>").append("<a data-player='" + JSON.stringify(item) + "' class='player-stat text-light'>" + item.first_name + " " + item.last_name + "</a>").appendTo(ul);
    };
});

$('body').on('click', '.player-stat', function () {
    const player = $(this).data('player')
    addLine(player)
});

$('#FormControlSelect').change(function () {
    $('tr.player-line').each(function () {
        $.get("https://www.balldontlie.io/api/v1/players/" + $(this).data('player-id'), function (data) {
            addLine(data);
        });
        $(this).remove();
    });
})

$('body').on("click", ".btn-supp", function () {
    $(this).parent().parent().remove();
    refreshColors();
    updateBdd();
})

const tds = ['td-games_played', 'td-min', 'td-fgm', 'td-fga', 'td-fg3m', 'td-fg3a', 'td-ftm', 'td-fta', 'td-oreb', 'td-dreb', 'td-reb', 'td-ast', 'td-stl', 'td-blk', 'td-turnover', 'td-pf', 'td-pts', 'td-fg_pct', 'td-fg3_pct', 'td-ft_pct'];

function refreshColors() {
    if ($('tr.player-line').length > 1) {
        jQuery.each(tds, function (i, val) {
            let highest = -Infinity;
            let lowest = +Infinity;
            let BestTd;
            let WorstTd;
            $("td." + val).each(function () {
                $(this).removeClass('text-success');
                $(this).removeClass('text-danger');
                if (highest < parseFloat($(this).text())) {
                    BestTd = $(this);
                } else if (highest === parseFloat($(this).text())) {
                    BestTd = null;
                }
                highest = Math.max(highest, parseFloat($(this).text()));
                if (lowest > parseFloat($(this).text())) {
                    WorstTd = $(this);
                } else if (lowest === parseFloat($(this).text())) {
                    WorstTd = null;
                }
                lowest = Math.min(lowest, parseFloat($(this).text()));
            });
            if (BestTd !== null) {
                BestTd.addClass("text-success");
            }
            if (WorstTd !== null) {
                WorstTd.addClass("text-danger");
            }
        })
    }
}

function addLine(player){
    $.get("https://www.balldontlie.io/api/v1/season_averages?season=" + $('#FormControlSelect').val() + "&player_ids[]=" + player.id, function (data) {
        const stat = data.data['0'];
        if (stat !== undefined) {
            $('#stats-players-tbody').append("<tr class='player-line' data-player-id='" + player.id + "'>\n" +
                "                                <th scope=\"row\">" + player.first_name + " " + player.last_name + "</th>\n" +
                "                                <td class='td-games_played'>" + stat.games_played + "</td>\n" +
                "                                <td class='td-min'>" + stat.min + "</td>\n" +
                "                                <td class='td-fgm'>" + stat.fgm + "</td>\n" +
                "                                <td class='td-fga'>" + stat.fga + "</td>\n" +
                "                                <td class='td-fg3m'>" + stat.fg3m + "</td>\n" +
                "                                <td class='td-fg3a'>" + stat.fg3a + "</td>\n" +
                "                                <td class='td-ftm'>" + stat.ftm + "</td>\n" +
                "                                <td class='td-fta'>" + stat.fta + "</td>\n" +
                "                                <td class='td-oreb'>" + stat.oreb + "</td>\n" +
                "                                <td class='td-dreb'>" + stat.dreb + "</td>\n" +
                "                                <td class='td-reb'>" + stat.reb + "</td>\n" +
                "                                <td class='td-ast'>" + stat.ast + "</td>\n" +
                "                                <td class='td-stl'>" + stat.stl + "</td>\n" +
                "                                <td class='td-blk'>" + stat.blk + "</td>\n" +
                "                                <td class='td-turnover'>" + stat.turnover + "</td>\n" +
                "                                <td class='td-pf'>" + stat.pf + "</td>\n" +
                "                                <td class='td-pts'>" + stat.pts + "</td>\n" +
                "                                <td class='td-fg_pct'>" + stat.fg_pct + "</td>\n" +
                "                                <td class='td-fg3_pct'>" + stat.fg3_pct + "</td>\n" +
                "                                <td class='td-ft_pct'>" + stat.ft_pct + "</td>\n" +
                "                                <td><button class=\"btn btn-warning w-100 btn-supp\"><i class=\"fas fa-times-circle\"></i></button></td>\n" +
                "                            </tr>"
            );
            refreshColors()
            updateBdd()
        } else {
            $("#alertPlayer").html(player.first_name + " " + player.last_name +" ne jouais pas cette année là").fadeIn();
            closeSnoAlertBox();

            function closeSnoAlertBox() {
                window.setTimeout(function () {
                    $("#alertPlayer").fadeOut(300)
                }, 3000);
            }
        }
    });
}

function updateBdd(){
    const players = [];
    const season = $('#FormControlSelect').val();
    const idComparison = $('#id-comparison').val()
    if ($('tr.player-line').length > 1){
        $('tr.player-line').each(function () {
            players.push($(this).data('player-id'))
        });
        $.ajax({
            method: "POST",
            url: "/updatebdd",
            data: { season: season, players: players, idComparison: idComparison }
        }).done(function( data ) {
            $("#id-comparison").val(data);
        });
    }
}
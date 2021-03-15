import './styles/player.scss';

const _seasonSelect = $('#FormControlSelect');

_seasonSelect.change(function () {
    load_stat();
});

$(function () {
    load_stat();
});

function load_stat() {
    $.get("https://www.balldontlie.io/api/v1/season_averages?season=" + _seasonSelect.val() + "&player_ids[]=" + $('#id-player').html(), function (data) {
        let stat = data.data[0];
        if (stat != null) {
            $('#season-div').html(
                "<table class=\"table table-dark table-borderless bg-transparent table-hover text-light\">\n" +
                "  <tbody>\n" +
                "    <tr>\n" +
                "      <th scope=\"row\">Parties Jouées</th>\n" +
                "      <td>" + stat.games_played + "</td>\n" +
                "    </tr>\n" +
                "    <tr>\n" +
                "      <th scope=\"row\">min</th>\n" +
                "      <td>" + stat.min + "</td>\n" +
                "    </tr>\n" +
                "    <tr>\n" +
                "      <th scope=\"row\">fgm</th>\n" +
                "      <td>" + stat.fgm + "</td>\n" +
                "    </tr>\n" +
                "    <tr>\n" +
                "      <th scope=\"row\">fga</th>\n" +
                "      <td>" + stat.fga + "</td>\n" +
                "    </tr>\n" +
                "    <tr>\n" +
                "      <th scope=\"row\">fg3m</th>\n" +
                "      <td>" + stat.fg3m + "</td>\n" +
                "    </tr>\n" +
                "    <tr>\n" +
                "      <th scope=\"row\">fg3a</th>\n" +
                "      <td>" + stat.fg3m + "</td>\n" +
                "    </tr>\n" +
                "    <tr>\n" +
                "      <th scope=\"row\">ftm</th>\n" +
                "      <td>" + stat.ftm + "</td>\n" +
                "    </tr>\n" +
                "    <tr>\n" +
                "      <th scope=\"row\">fta</th>\n" +
                "      <td>" + stat.fta + "</td>\n" +
                "    </tr>\n" +
                "    <tr>\n" +
                "      <th scope=\"row\">oreb</th>\n" +
                "      <td>" + stat.oreb + "</td>\n" +
                "    </tr>\n" +
                "    <tr>\n" +
                "      <th scope=\"row\">dreb</th>\n" +
                "      <td>" + stat.dreb + "</td>\n" +
                "    </tr>\n" +
                "    <tr>\n" +
                "      <th scope=\"row\">reb</th>\n" +
                "      <td>" + stat.reb + "</td>\n" +
                "    </tr>\n" +
                "    <tr>\n" +
                "      <th scope=\"row\">ast</th>\n" +
                "      <td>" + stat.ast + "</td>\n" +
                "    </tr>\n" +
                "    <tr>\n" +
                "      <th scope=\"row\">stl</th>\n" +
                "      <td>" + stat.stl + "</td>\n" +
                "    </tr>\n" +
                "    <tr>\n" +
                "      <th scope=\"row\">blk</th>\n" +
                "      <td>" + stat.blk + "</td>\n" +
                "    </tr>\n" +
                "    <tr>\n" +
                "      <th scope=\"row\">turnover</th>\n" +
                "      <td>" + stat.turnover + "</td>\n" +
                "    </tr>\n" +
                "    <tr>\n" +
                "      <th scope=\"row\">pf</th>\n" +
                "      <td>" + stat.pf + "</td>\n" +
                "    </tr>\n" +
                "      <th scope=\"row\">Points</th>\n" +
                "      <td>" + stat.pts + "</td>\n" +
                "    </tr>\n" +
                "    <tr>\n" +
                "      <th scope=\"row\">fg pct</th>\n" +
                "      <td>" + stat.fg_pct + "</td>\n" +
                "    </tr>\n" +
                "    <tr>\n" +
                "      <th scope=\"row\">fg3 pct</th>\n" +
                "      <td>" + stat.fg3_pct + "</td>\n" +
                "    </tr>\n" +
                "    <tr>\n" +
                "      <th scope=\"row\">ft pct</th>\n" +
                "      <td>" + stat.ft_pct + "</td>\n" +
                "    </tr>\n" +
                "  </tbody>\n" +
                "</table>" +
                "<a class='w-100' href='/compare/" + _seasonSelect.val() + "?players[]=" + stat.player_id + "'><button class='btn btn-dark w-100 mb-3'>Comparer</button></a>"
            );
        } else {
            $('#season-div').html("<h6 class='text-center text-light mb-3'>Le joueur n'a pas joué cette année là</h6>");
        }
    });
}
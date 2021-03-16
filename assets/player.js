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
                "      <th scope=\"row\">MIN</th>\n" +
                "      <td>" + stat.min + "</td>\n" +
                "    </tr>\n" +
                "    <tr>\n" +
                "      <th scope=\"row\">FGM</th>\n" +
                "      <td>" + stat.fgm + "</td>\n" +
                "    </tr>\n" +
                "    <tr>\n" +
                "      <th scope=\"row\">FGA</th>\n" +
                "      <td>" + stat.fga + "</td>\n" +
                "    </tr>\n" +
                "    <tr>\n" +
                "      <th scope=\"row\">FG3M</th>\n" +
                "      <td>" + stat.fg3m + "</td>\n" +
                "    </tr>\n" +
                "    <tr>\n" +
                "      <th scope=\"row\">FG3A</th>\n" +
                "      <td>" + stat.fg3m + "</td>\n" +
                "    </tr>\n" +
                "    <tr>\n" +
                "      <th scope=\"row\">FTM</th>\n" +
                "      <td>" + stat.ftm + "</td>\n" +
                "    </tr>\n" +
                "    <tr>\n" +
                "      <th scope=\"row\">FTA</th>\n" +
                "      <td>" + stat.fta + "</td>\n" +
                "    </tr>\n" +
                "    <tr>\n" +
                "      <th scope=\"row\">OREB</th>\n" +
                "      <td>" + stat.oreb + "</td>\n" +
                "    </tr>\n" +
                "    <tr>\n" +
                "      <th scope=\"row\">DREB</th>\n" +
                "      <td>" + stat.dreb + "</td>\n" +
                "    </tr>\n" +
                "    <tr>\n" +
                "      <th scope=\"row\">REB</th>\n" +
                "      <td>" + stat.reb + "</td>\n" +
                "    </tr>\n" +
                "    <tr>\n" +
                "      <th scope=\"row\">AST</th>\n" +
                "      <td>" + stat.ast + "</td>\n" +
                "    </tr>\n" +
                "    <tr>\n" +
                "      <th scope=\"row\">STL</th>\n" +
                "      <td>" + stat.stl + "</td>\n" +
                "    </tr>\n" +
                "    <tr>\n" +
                "      <th scope=\"row\">BLK</th>\n" +
                "      <td>" + stat.blk + "</td>\n" +
                "    </tr>\n" +
                "    <tr>\n" +
                "      <th scope=\"row\">TURNOVER</th>\n" +
                "      <td>" + stat.turnover + "</td>\n" +
                "    </tr>\n" +
                "    <tr>\n" +
                "      <th scope=\"row\">PF</th>\n" +
                "      <td>" + stat.pf + "</td>\n" +
                "    </tr>\n" +
                "      <th scope=\"row\">PTS</th>\n" +
                "      <td>" + stat.pts + "</td>\n" +
                "    </tr>\n" +
                "    <tr>\n" +
                "      <th scope=\"row\">FG PCT</th>\n" +
                "      <td>" + stat.fg_pct + "</td>\n" +
                "    </tr>\n" +
                "    <tr>\n" +
                "      <th scope=\"row\">FG3 PCT</th>\n" +
                "      <td>" + stat.fg3_pct + "</td>\n" +
                "    </tr>\n" +
                "    <tr>\n" +
                "      <th scope=\"row\">FT PCT</th>\n" +
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
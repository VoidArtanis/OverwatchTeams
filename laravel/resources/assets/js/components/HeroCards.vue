<template>

    <div class="row hero-cards">
        <div class="col-lg-2 col-md-4 col-sm-4 col-xs-6 centered-container" v-for="hero in sorted">
            <div class=" herocard">
                <div class="hero-portrait-detailed">
                    <img class="hero-avatar" :src="avatars[hero]"/>
                    <div class="hero-portrait-title">{{ names[hero] }}</div>
                </div>
                <h4 class="hero-card-sub">{{ getWinRate(heroes[hero]['average_stats']['games_won'], heroes[hero]['average_stats']['games_played'])}}</h4>
                <h5 class="hero-card-sub-sm">{{ getGames(heroes[hero]['average_stats']['games_played'],heroes[hero]['average_stats']['medals_gold'])}}</h5>
            </div>

        </div>
    </div>

</template>

<script>
    export default {
        props: ['sortedheroes', 'herodata', 'heroavatars', 'heronames'],
        data: function () {
            return {
                sorted: JSON.parse(this.sortedheroes).slice(0, 6),
                heroes: JSON.parse(this.herodata),
                avatars: JSON.parse(this.heroavatars),
                names: JSON.parse(this.heronames)
            }
        },
        methods: {
            getWinRate: function (wins, games) {
                if (games) {
                    wins = (wins) ? wins : 0;
                    var n = (Number(wins) / Number(games)) * 100;
                    return 'Winrate ' + (Math.ceil(n / 5) * 5 ) + '%';
                }else{
                    if(wins)
                    return  wins + ' wins';
                    else
                        return 'N/A';

                }
            },
            getGames: function (games,golds) {
                if (games) {

                    return games + ' games played';
                }else{
                       return golds + ' gold medals';
                }
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>

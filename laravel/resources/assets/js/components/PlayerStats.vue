<template>

    <div class="row">
        <div class="col-lg-2 col-md-4 col-sm-4 col-xs-6 centered-container">
            <div class="text-center stats-block">
                <h1>{{ data['eliminations_most_in_game'] }}</h1>
                <h4>Eliminations</h4>
            </div>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-4 col-xs-6 centered-container">
            <div class="text-center stats-block">
                <h1>{{ data['final_blows_most_in_game'] }}</h1>
                <h4>Final Blows</h4>
            </div>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-4 col-xs-6 centered-container">
            <div class="text-center stats-block">
                <h1>{{ data['objective_kills_most_in_game'] }}</h1>
                <h4>Objective Kills</h4>
            </div>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-4 col-xs-6 centered-container">
            <div class="text-center stats-block">
                <h1>{{ getTime(data['objective_time_most_in_game']) }}</h1>
                <h4>Objective Time</h4>
            </div>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-4 col-xs-6 centered-container">
            <div class="text-center stats-block">
                <h1>{{ data['hero_damage_done_most_in_game'] }}</h1>
                <h4>Hero Damage</h4>
            </div>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-4 col-xs-6 centered-container">
            <div class="text-center stats-block">
                <h1>{{ data['healing_done_most_in_game'] }}</h1>
                <h4>Healing Done</h4>
            </div>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-4 col-xs-6 centered-container">
            <div class="text-center stats-block">
                <h1>{{ getTime(data['time_spent_on_fire_most_in_game']) }}</h1>
                <h4>On Fire</h4>
            </div>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-4 col-xs-6 centered-container">
            <div class="text-center stats-block">
                <h1>{{ data['solo_kills_most_in_game'] }}</h1>
                <h4>Solo Kills</h4>
            </div>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-4 col-xs-6 centered-container">
            <div class="text-center stats-block">
                <h1>{{ data['multikill_best'] }}</h1>
                <h4>Multi Kill</h4>
            </div>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-4 col-xs-6 centered-container">
            <div class="text-center stats-block">
                <h1>{{ data['offensive_assists_most_in_game'] }}</h1>
                <h4>Offensive Assists</h4>
            </div>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-4 col-xs-6 centered-container">
            <div class="text-center stats-block">
                <h1>{{ data['defensive_assists_most_in_game'] }}</h1>
                <h4>Defensive Assists</h4>
            </div>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-4 col-xs-6 centered-container">
            <div class="text-center stats-block">
                <h1>{{ data['final_blows_most_in_game'] }}</h1>
                <h4>Final Blows</h4>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        props: ['stats'],
        data: function () {
            return {
                data: JSON.parse(this.stats)
            }
        },
        methods:{
            getTime: function(t){
                var mins = (Number(t)*60) % 60;
                var secs = (Number(mins)*60) % 60;
                return Math.floor(mins) + ':' + (Math.ceil(secs) + '0').slice(-2);
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>

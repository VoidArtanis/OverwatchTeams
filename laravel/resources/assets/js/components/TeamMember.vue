<template>
    <div class="row">
        <div class=" desktop-search">
            <a :href="profileroot">
                <div ripple class="result">
                    <div class="fl numbering">
                        {{counter}}
                    </div>
                    <div class="row row-keep-margins  ">
                        <img :src="result['us']['stats']['quickplay']['overall_stats']['avatar']"
                             style="float:left" class="player-portrait fl" onerror="this.src='img/default.png'">
                        <h1 class="h2 playerName-search fl txt-white">{{ result['battleTag'] }}</h1>
                        <div class="competitive-rank text-center rl">
                            <img class="rank-portrait-search"
                                 :src="rankedImage">
                            <p class=" competitive-sr txt-white">
                                {{ result['us']['stats']['competitive']['overall_stats']['comprank'] }}</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="  mobile-search">
            <a :href="profileroot">
                <div ripple class="result">
                    <div class="mobileNumbering">
                        #{{counter}}
                    </div>
                    <div class="row row-keep-margins  ">
                        <div class="col-xs-8">
                            <div class="row">
                                <h1 class="h2 playerName-search   txt-white col-xs-12">{{ result['battleTag']
                                    }}</h1>
                            </div>
                        </div>
                        <div class="competitive-rank text-center rl col-xs-4"
                             style="margin-top: -2px;margin-bottom: 8px;">
                            <img class="rank-portrait-search"
                                 :src="rankedImage">
                            <p class=" competitive-sr txt-white">
                                {{ result['us']['stats']['competitive']['overall_stats']['comprank'] }}</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['player', 'counter', 'rankedpotrait','profileroot'],
        data: function () {
            return {
                result: JSON.parse(this.player),
                counter: JSON.parse(this.counter),
                rankedImage: this.rankedpotrait,

            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>

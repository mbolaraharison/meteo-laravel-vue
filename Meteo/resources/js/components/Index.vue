<template>
    <div class="sph-body">
        <div class="jumbotron pb-2 pt-4 sph-jumbo-1">
            <h1 class="display-5 text-center sph-headline">Bienvenue sur la page Météo</h1>
            <hr class="my-4">
            <div class="form-group d-flex justify-content-center ui-widget sph-div-search">
                <autocomplete :search="search" v-bind:class="'sph-search'" v-on:submit="submit" :placeholder="vars['name']" aria-label="Search for a city"></autocomplete>
                <img v-on:click="locate" id="location_id" class="mt-1 sph-location" :src="'assets/images/location-logo.png'" alt="" width="35" height="35">
            </div>
        </div>
        <div class="jumbotron pb-2 pt-4 mt-n2 sph-jumbo-2">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 d-flex justify-content-center">
                    <div class="card border-primary mb-3 w-100 p-3">
                    <div class="card-header">Température</div>
                    <div class="card-body">
                        <div class="card-title">
                            <div class="row">
                                <div class="col-6 col-lg-9 col-md-6 col-sm-6 d-flex align-items-center">
                                <h2 class="sph-orange">
                                    {{ vars['temperature'] }}°C
                                </h2>
                                </div>
                                <div class="col-6 col-lg-3 col-md-6 col-sm-6 d-flex align-items-center pl-0">
                                    <div class="page-item border-right text-center">
                                    min {{ vars['temp_min'] }}°C
                                    </div>
                                    <div class="page-item border-left text-center">
                                    max {{ vars['temp_max'] }}°C  
                                    </div>
                                </div>
                            </div>
                        </div>                  
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Précipitations
                                <span>
                                {{ vars['precipitations'] }} %
                                </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Humidité
                                <span>
                                {{ vars['humidite'] }} %
                                </span>
                            </li>
                        </ul>
                    </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 d-flex justify-content-center">
                    <div class="card border-primary mb-3 w-100 p-3">
                    <div class="card-header">Vent</div>
                    <div class="card-body">
                        <h2 class="card-title pb-2 sph-orange">
                        {{ vars['vent'] }} km/h
                        </h2>
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Pression atmosphérique
                                <span>
                                {{ vars['pression'] }} hPa
                                </span>
                            </li>
                        </ul>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Autocomplete from '@trevoreyre/autocomplete-vue'
import '@trevoreyre/autocomplete-vue/dist/style.css'

export default {
    name : "Index",
    data : function(){
        return {
            message : ""
        }
    },
    components: {
        Autocomplete
    },
    methods : {
        locate(){
            if ("geolocation" in navigator){
                navigator.geolocation.getCurrentPosition(function(position){ 
                        console.log(position.coords.latitude+","+ position.coords.longitude);
                        window.location.replace('./'+position.coords.latitude+'/'+position.coords.longitude);
                    });
            }else{
                console.log("Browser doesn't support geolocation!");
            }
        },
        search(input) {
            if (input.length < 1) { return [] }
            return this.cities.filter(city => {
                return city.toLowerCase()
                .startsWith(input.toLowerCase())
            });
        },
        submit(result){
            window.location.replace("./"+result);
        }
    },
    data : function(){
        return {
            cities : ["Angers,FR", "Nantes,FR", "Paris,FR", "Toulouse,FR", "Lyon,FR", "Bordeaux,FR", "Marseille,FR", "Rennes,FR"]
        }
    },
    props : ['vars']
}
</script>

<style lang="scss" scoped>
    .sph-location{
        cursor: pointer;
    }
    $bleu_ciel : #f3f9ff;
    .sph-search{
        width : 50%;
    }
   .sph-jumbo-1{
    background-color : $bleu_ciel !important;
    }

    .sph-jumbo-2{
        background-color : $bleu_ciel !important;
    }

    .sph-orange{
    color : #E95420 !important;
}

.sph-widget {
    background: rgba( 255, 255, 255, .8 ) 
                url('http://i.stack.imgur.com/FhHRx.gif') 
                99% / 7%
                no-repeat;
}

/* Extra small devices (portrait phones, less than 576px)*/
@media (max-width: 575.98px) {
    .sph-search{
        width : 50% !important;
    }

    .sph-headline{
        font-size: 35px;
    }

    .sph-logo-footer{
        padding-bottom: 4%;
    }
}

    /* Small devices (landscape phones, 576px and up) */
    @media (min-width: 576px) and (max-width: 767.98px) {
        .sph-search{
            width : 60%;
        }
    }

    /* Medium devices (tablets, 768px and up) */
    @media (min-width: 768px) and (max-width: 991.98px) {
        .sph-search{
            width : 60%;
        }
    }

    /* Large devices (desktops, 992px and up) */
    @media (min-width: 992px) and (max-width: 1199.98px) {}

    /* Extra large devices (large desktops, 1200px and up)*/
    @media (min-width: 1200px) {}

    @keyframes smoothScroll {
        0% {
            transform: translateY(-40px);
        }
        100% {
            transform: translateY(0px);
        }
    }

    .sph-body{
        font-weight: bold !important;
    }
</style>
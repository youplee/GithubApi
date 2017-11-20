@extends('layouts.apps')

@section('content')
<div id="app">

                    <div class="panel ">
                        <div class="panel-body">
                            <div class="col-md-4">
                                <div class="profile_user">
                                    <h3 class="user_name_max">{{$user->nom}} {{$user->prenom}}</h3>
                                    <p>{{$user->email}}</p>
                                    <span class="fa-stack faceb fa-lg">
                                         <i class="fa fa-circle fa-stack-2x"></i>
                                        <i class="fa fa-stack-1x fa-facebook fa-inverse"></i>
                                    </span>
                                    <span class="fa-stack googleplus fa-lg">
                                         <i class="fa fa-circle fa-stack-2x"></i>
                                        <i class="fa fa-flag fa-stack-1x fa-google-plus fa-inverse"></i>
                                    </span>
                                    <span class="fa-stack tweet-btn fa-lg">
                                         <i class="fa fa-circle fa-stack-2x"></i>
                                        <i class="fa fa-flag fa-stack-1x fa-twitter fa-inverse"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <!-- Nav tabs -->
                                        <ul class="nav nav-tabs nav-custom" >
                                            <li  v-for="typeRecherche in typeRecherches">
                                                <a :href="'#'+typeRecherche.libelle" data-toggle="tab">
                                                    <strong v-text="typeRecherche.libelle"></strong>
                                                </a>
                                            </li>
                                        </ul>
                                        <!-- Tab panes -->
                                        <div class="tab-content nopadding noborder">
                                            <div v-for="typeRecherche in typeRecherches" :id="typeRecherche.libelle" class="tab-pane animated fadeInRight fade in">
                                                <div class="table-responsive">
                                                    <table class="table table-responsive">
                                                        <tbody>
                                                        <tr v-for="favorite in favorites" v-if="typeRecherche.id ==  favorite.typeRecherche_id">
                                                            <td class="text-center">
                                                                <i class="icon-bubble icons"></i>
                                                                </td>
                                                            <td v-text="favorite.lien">
                                                            </td>
                                                            <td v-text="favorite.created_at">
                                                            </td>
                                                            <td>
                                        <a href="#" v-on:click.prevent="retraitFavori(favorite)">
                                            <i data-uk-tooltip="{pos:'top'}" title="Remove from favorite" style="color:red;" class="material-icons">favorite</i>
                                        </a>  
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <!-- tab-pane -->
                                        </div>
                                        <!-- tab-content -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
</div>
<!-- vue js -->
<script src="{{asset('js/vue.js') }}"></script>
<script src="{{asset('js/axios.min.js') }}"></script>
<script src="{{asset('js/vue-resource.min.js') }}"></script>
<script src="{{asset('js/vue-table.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.0.0/sweetalert2.all.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/vue.multiselect/1.1.4/vue-multiselect.min.js"></script>
<!-- end vue js -->

<script>
Vue.component('Multiselect', VueMultiselect.default);

    let app = new Vue({

        el      : '#app',
        data    : {
            selected            : null,
            selectedTypeSearch  : null,
            selectedOrder       : null,
            selectedSort        : null,
            favorites            : [],
            typeRecherches           : [],
            languages           : [],
            typeRecherches      : [],
            orders              : ['asc', 'desc'],
            allSorts               : [],
            sorts               : [],
            courtierId          : 0,
            produitIds          : [],
            produitsCourtier    : [],
            seen                : false,
            keyword             : '',
            results             : [],
        },
        methods : {

            load : function(){

                //  Vue.http.headers.common['X-CSRF-TOKEN'] = $('meta[name="csrf-token"]').attr('content');
            
                axios.get('/loadProfil').then(
                    
                    (response) =>{

                        console.log(response);

                        if(response){

                            this.favorites      = response.data.favorites;
                            this.typeRecherches = response.data.typeRecherches;
                        }

                    },
                    
                    (response) =>{

                    }
                );
            },
        retraitFavori: function(favorite) {

            axios.post('retraitFavoriFromProfil',{favorite : favorite})
                    .then(
                        
                (response) =>{

                    if(response){

                        swal("Succes!", "", "success");
                        this.load();
                    this.sendEmailRetraitFavori();


                    }
                }
            );
        },
            sendEmailRetraitFavori: function() {

                axios.post('sendEmailRetraitFavori')
                    .then(
                        
                    (response) =>{

                        if(response){

                                notify('success');
                        }
                    }
                );
            },
    },

        ready   : function () {

             this.load();
        },

    });
</script>
@endsection
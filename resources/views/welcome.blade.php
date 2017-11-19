@extends('layouts.apps')

@section('content')

    @if(session('errorMsg'))
        <div class="alert alert-warning" >
            <p><center>{!! session('errorMsg') !!}</center></p>
        </div>
    @endif
    @if(Auth::check())
        <div class="col-md-10 col-md-offset-1" id="app">
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <i class="fa fa-fw ti-home"></i> Search Keyword Github
                        </h3>
                        <span class="pull-right">
                            <i class="fa fa-fw ti-angle-up clickable"></i>
                            <i class="fa fa-fw ti-close removepanel clickable"></i>
                        </span>
                    </div>
                <div class="panel-body"> 
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Search Github" v-model="keyword">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="adult-number">Written in this language</label>
                                    <multiselect
                                    :selected="selected"
                                    :options="languages"
                                    :multiple="false"
                                    placeholder="Choose language"
                                    @update="updateSelected">
                                    </multiselect>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="child-number">Type Search</label>
                                    <multiselect
                                    :selected="selectedTypeSearch"
                                    :options="typeRecherches"
                                    :multiple="false"
                                    placeholder="Choose type of your search"
                                    @update="updateSelectedType">
                                    </multiselect>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="child-number">Order</label>
                                    <multiselect
                                    :selected="selectedOrder"
                                    :options="orders"
                                    :multiple="false"
                                    placeholder="Jour du prelevement"
                                    @update="updateSelectedOrder">
                                    </multiselect>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="child-number">Sort</label>
                                    <multiselect
                                    :selected="selectedSort"
                                    :options="sorts"
                                    :multiple="false"
                                    placeholder="Jour du prelevement"
                                    @update="updateSelectedSort">
                                    </multiselect>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <button class="btn btn-warning btn-block" v-on:click='search()'>Search   </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel" v-show="seen">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="ti-layout-grid3"></i> Data Table
                    </h3>
                    <span class="pull-right">
                        <i class="fa fa-fw ti-angle-up clickable"></i>
                        <i class="fa fa-fw ti-close removepanel clickable"></i>
                    </span>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="sample_1">
                            <thead>
                                <tr>
                                    <th>Type Search</th>
                                    <th>Url</th>
                                    <th>Score</th>
                                    <th>Language</th>
                                    <th>Favoris</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="result in results">
                                    <td v-text="selectedTypeSearch"></td>
                                    <td v-text="result.html_url"></td>
                                    <td v-text="result.score"></td>
                                    <td v-text="result.languages"></td>
                                    <td>
                                        <a v-if="result.favorite"  href="#"  
                                        v-on:click.prevent="retraitFavori(result)">
                                            <i data-uk-tooltip="{pos:'top'}" title="Statut Activé" style="color:red;" class="material-icons">favorite</i>
                                        </a>  
                                        <a v-if="result.favorite == 0" href="#"         
                                        v-on:click.prevent="ajoutFavori(result)">
                                            <i data-uk-tooltip="{pos:'top'}" title="Statut Desactivé" style="color:green;"  class="material-icons">favorite</i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @else
        @include('auth.login')
    @endif
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="{{asset('assets/vendors/datatables/js/jquery.dataTables.js') }}"></script>
<script src="{{asset('assets/vendors/datatables/js/dataTables.bootstrap.js') }}"></script>
<script src="{{asset('assets/js/custom_js/datatables_custom.js') }}"></script>

<!-- vue js -->
<script src="{{asset('js/vue.js') }}"></script>
<script src="{{asset('js/axios.min.js') }}"></script>
<script src="{{asset('js/vue-resource.min.js') }}"></script>
<script src="{{asset('js/vue-table.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.0.0/sweetalert2.all.min.js"></script>
<script src="https://cdn.jsdelivr.net/vue.multiselect/1.1.4/vue-multiselect.min.js"></script>
<script>
Vue.component('Multiselect', VueMultiselect.default);

    let app = new Vue({

        el      : '#app',
        data    : {
            selected            : null,
            selectedTypeSearch  : null,
            selectedOrder       : null,
            selectedSort        : null,
            languages           : [],
            typeRecherches      : [],
            orders              : ['asc', 'desc'],
            allSorts               : [],
            sorts               : [],
            seen                : false,
            keyword             : '',
            results             : []
        },
        methods : {

            load : function(){

                //  Vue.http.headers.common['X-CSRF-TOKEN'] = $('meta[name="csrf-token"]').attr('content');
            
                axios.get('/loadData').then(
                    
                    (response) =>{

                        if(response){

                            this.languages      = response.data.languages;
                            this.typeRecherches = response.data.typeRecherches;
                            this.allSorts       = response.data.sorts;

                        }

                    },
                    
                    (response) =>{

                    }
                );
            },

            search : function(){

                swal({
                    title: 'SEARCH IN github ...',
                    text: 'Please wait ....',
                    timer: 60000,
                    onOpen: function () {
                    swal.showLoading()
                    }
                }).then(function (result) {

                    if (result.dismiss === 'timer') {


                    }
                })

                axios.post('searchgithub',{keyword:this.keyword, selectedLanguages :this.selected, selectedTypeRecherche :this.selectedTypeSearch, selectedSort :this.selectedSort, selectedOrder :this.selectedOrder })
                    .then(
                        
                        (response) =>{

                            if(response){

                                swal("Succes!", "", "success");
                                this.results = response.data;
                                this.seen = true;

                            }

                        }
                );
            },

            updateSelected : function(newSelected) {

                this.selected = newSelected;

            },

            updateSelectedType : function(newSelected) {

                this.selectedTypeSearch = newSelected;
                this.sorts              = this.allSorts[this.selectedTypeSearch];
                this.selectedSort       = null;

            },

            updateSelectedOrder : function(newSelected) {

                this.selectedOrder = newSelected;
            },

            updateSelectedSort : function(newSelected) {

                this.selectedSort = newSelected;

            },

            ajoutFavori: function(result) {

                axios.post('ajoutFavori',{result : result})
                    .then(
                        
                    (response) =>{

                        if(response){

                            swal("Succes!", "Favorite Added with Succes", "success");
                            result.favorite = 1;
                            this.sendEmailFavori(result, response.data.catalogueId);

                        }
                    }
                );
            },

            sendEmailFavori: function(result, catalogueId) {

                axios.post('sendEmailFavori',{result : result, catalogueId : catalogueId})
                    .then(
                        
                    (response) =>{

                        if(response){

                            notify('success');

                        }
                    }
                );
            },
            retraitFavori: function(result) {

                axios.post('retraitFavori',{result : result})
                    .then(
                        
                    (response) =>{

                        if(response){

                            swal("Succes!", "Favorite Removed with Succes", "success");
                            result.favorite = 0;
                            this.sendEmailRetraitFavori(result, response.data.catalogueId);

                        }
                    }
                );
            },

            sendEmailRetraitFavori: function(result, catalogueId) {

                axios.post('sendEmailRetraitFavori',{result : result, catalogueId : catalogueId})
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

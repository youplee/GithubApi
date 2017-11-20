
new Vue({
      el: '#appp',

      data: {
              agences: [{id: 0, text: ''}],
              sites: [{id: 0, text: '', agenceId: 0}],
              equipes: [{id: 0, text: '', siteId: 0}],
              conseillers: [{id: 0, text: '', equipeId: 0}],
              url: '',
              bordereau: [],
              dateExport: { dateA: null, dateArrete: 0 },
              saveBtn: true,
              arrete: null,
              agence: null,
              site: null,
              equipe: null,
              conseille: null,
               search: '',
               filter: false,
               details: false,
               loading: true,
               error: false,
               searchBtn: true,
              e3: null,
              menu: false,
              modal: false,
             dialog: false,
             dateDe: null,
             dateA: null,
             datedebut: null,
             datefin: '',
             commission: {
                value:'',
                name:'',
                contrat: '',
                chiffre:'',
                point:'',
                commission:'',
                action:''
             },
             listArrete: [],
             commissions: [],
             profiles: [],
             classements: [],
             depassements: [],
             parametres: [],
             taux_cie: [],
             nbr_taux: [],
             nbr_cie: [],
           users: [],
           validation: true,
           disableBtn: false,
        d3: null,
        dialogParametre: false, 
        headers: [  
                   { text: 'Conseillé', left: true, value: 'name', class:"" },
                   { text: 'Equipe', left: true, value: 'equipe' },
                   { text: 'Contrat', value: 'contrat' },
                   { text: 'Chiffre', value: 'chiffre' },        
                   { text: 'Point', value: 'point', class:"" }, 
                   { text: 'Commission', value: 'commission', class:"" }, 
                   
                ],
        itemss: [],
        item: null,

      },
      methods: {
            load : function(){

                //  Vue.http.headers.common['X-CSRF-TOKEN'] = $('meta[name="csrf-token"]').attr('content');
            
                axios.get('/loadData').then(
                    
                    (response) =>{

                        console.log(response);

                        if(response){

                            this.itemss      = response.data.languages;
                            this.typeRecherches = response.data.typeRecherches;
                            this.allSorts       = response.data.sorts;
                        }

                    },
                    
                    (response) =>{

                    }
                );
            },
        bordereauPrint: function(id) {
          this.idCom     = id;
        },
        exportCsv: function() {
            
            axios.patch("/courtier/commission/sante/xls")
              .then(response => {

                  console.log(response.data);
                   
              })
              .catch(error => {

                  console.log(error);
              })
        },
        periode: function(){
           this.filter = false;
           this.dateExport = { dateA: this.datefin, dateArrete: 0 };
           this.getCommissionUser();
        },
        getCommissionUser: function() {
               
              this.itemss = [];

              this.loading = true;

              data = {
                        to_date: this.datefin,
                     };

              axios.post("/courtier/commission/sante", data)
                  .then(response => {
               // this.users = response.data;
                console.log('Commissions: ', response.data);
                


                response.data.forEach(element => {
                  
                  commission = {
                      element: element,
                      avatar: window.Laravel.url + '/upload/avatars/' + element.user.photo,
                      name: element.user.nom + ' ' + element.user.prenom + ' (' + element.user.login + ')',
                      equipe: element.equipe.nom,
                      contrat: element.general.contrat,
                      chiffre: element.general.chiffre,
                      point: element.general.point,
                      commission: element.general.commission,
                      action:1,
                      site: this.siteComm(element.equipe.site_id)[0].text,
                      agence: this.agenceComm(this.siteComm(element.equipe.site_id)[0].agenceId)[0].text,
                      primes: element.primes
                  };

                  this.itemss.push(commission);

                });

                 console.log('items :', this.itemss);

                 this.loading= false;
                
                //this.utilisateur = this.users[0].name;
               })
                  .catch(error => {
                      console.log(error);
              });
            
          },
          getCommissionSetting: function() {
            
             axios.post('/courtier/commission/sante/setting')
             .then(response => {

                 response.data.forEach(element => {

                  console.log(element);
                      
                       this.parametres.push({
                                             id: element.id,
                                             key: element.key,
                                             title: element.libelle,
                                             value: element.value
                                          });
                 })

                
             })
             .catch(error => {

             });

          },
          getCommissionProfile: function() {

              axios.post("/courtier/commission/sante/profiles")
                  .then(response => {
              
                    this.profiles = response.data;

                   console.log(this.profiles);

              })
                  .catch(error => {
                      console.log(error);
               });

          },
          getCommissionClassement: function() {

              axios.post("/courtier/commission/sante/classement")
                  .then(response => {
              
                    this.classements = response.data;

               
               })
                  .catch(error => {
                      console.log(error);
              });

          },
          getCommissionDepassement: function() {

              axios.post("/courtier/commission/sante/depassement")
                  .then(response => {
              
                    this.depassements = response.data;

                
               
               })
                  .catch(error => {
                      console.log(error);
              });
          },
           getCommissionParamUsers: function() {

              axios.post("/courtier/commission/sante/users")
                  .then(response => {
              
                      response.data.agences.forEach(agence => {
                       
                        this.agences.push({
                              id: agence.id,
                            text: agence.nom
                        });

                      });

                      response.data.sites.forEach(site => {
                       
                        this.sites.push({
                              id: site.id,
                            text: site.nom,
                            agenceId: site.agence_id
                        });

                      });
                     

                      response.data.equipes.forEach(equipe => {
                       
                        this.equipes.push({
                              id: equipe.id,
                            text: equipe.nom,
                            siteId: equipe.site_id
                        });
                      });

                        
                      response.data.conseillers.forEach(conseiller => {
                       
                        this.conseillers.push({
                              id: conseiller.id,
                            text: conseiller.nom + ' ' + conseiller.prenom + ' ( ' + conseiller.login + ' ) ',
                            equipeId: conseiller.pivot.id
                        });

                      });
               
               })
                  .catch(error => {
                      console.log(error);
              });
          },
          getTauxCie: function() {

              axios.post("/courtier/commission/sante/gettauxcie")
                  .then(response => {
              
                    this.taux_cie = response.data;
                    this.calcTaux();
                
               })
                  .catch(error => {
                      console.log(error);
              });
          },
          getListeArrete: function() {

              axios.post("/courtier/commission/sante/getarreteelist")
                  .then(response => {
              
                     this.dateA = response.data.current; 
                     this.listArrete = [];
                     response.data.list.forEach(element => {

                         this.listArrete.push({
                            id: element.id,
                            text: element.debut_arretee  + ' - ' + element.fin_arretee,
                            mois: element.mois,
                            annee: element.annee
                         });
                     });

                    console.log('liste : ', this.listArrete);

               })
                  .catch(error => {
                      console.log(error);
              });
          },
          updateSettings: function() {
              
              data = {
                profiles: this.profiles,
                classements: this.classements,
                depassements: this.depassements,
                parametres: this.parametres,
                taux_cie: this.taux_cie,
              };

              this.saveBtn = false;

              axios.post("/courtier/commission/sante/setting/update", data)
                  .then(response => {
              //

                    this.dialogParametre = false;

                    this.getCommissionUser();

                    this.saveBtn = true;
               })
                  .catch(error => {
                      console.log(error);
              });
          },
          getCommissionFilter: function() {
              
              data = {
                    arrete: this.arrete,
              };

              if(data.arrete == null) {
                return this.getCommissionUser();
              }

              this.dateExport = { dateA: this.arrete.id, dateArrete: 1 };

              console.log("Filter:", data);

              this.loading = true;

              axios.post("/courtier/commission/sante/getarretee", data)
                  .then(response => {

                      if(response.data.success) {
                          
                          this.itemss = [];

                          response.data.commissions.forEach(element => {

                            commission = {
                                id: element.id,
                                element: false,
                                avatar: window.Laravel.url + '/upload/avatars/' + element.user.photo,
                                name: element.user.nom + ' ' + element.user.prenom + ' (' + element.user.login + ')',
                                equipe: element.equipe.nom,
                                contrat: element.general.contrat,
                                chiffre: element.general.chiffre,
                                point: element.general.point,
                                commission: element.general.commission,
                                action:1,
                                site: this.siteComm(element.equipe.site_id)[0].text,
                                agence: this.agenceComm(this.siteComm(element.equipe.site_id)[0].agenceId)[0].text,
                                primes: element.primes
                            };

                            this.itemss.push(commission);

                          });

                          console.log('items filtre:', this.itemss);

                      }else{
                       
                        this.itemss = [];

                      }


                      this.loading = false;
                      
               
               })
                  .catch(error => {
                      console.log(error);
              });
          },
          validerArrete: function() {

                this.disableBtn = true;

                axios.put("/courtier/commission/sante/generate", { to_date: this.datefin })
                  .then(response => {

                      if(response.data.success) {
                         
                         this.getListeArrete();
                         this.itemss = [];
                         
                         this.datefin = window.Laravel.dateNow;
                         this.dialog  = false;

                         this.disableBtn = false;

                         this.getCommissionUser();
                         
                      }

                 })
                 .catch(error => {
                    console.log(error);
                    this.disableBtn = true;
                 })
           }
          ,
          toggleFilter: function() {

            this.details = false;
            this.filter  = !this.filter;

          },
          ShowDetails: function(item) {

            this.details = true;
            this.filter  = false;
            console.log(item);
            this.item = item;
          },
          siteComm: function(id) {

            return this.sites.filter(s => {
             
               if(id) {
                
                  return s.id == id;
                 
               }

            });

          },
          agenceComm: function(id) {

            return this.agences.filter(s => {
             
                if(id) {
                
                  return s.id == id;
                 
                }

            });

          },
          sliderValue: function(param) {
            
            if(param.key == "pas_taux_closing") {
               return param.value/10;
            }

            return param.value;
          },
          calcTaux: function() {



            this.taux_cie.forEach((taux, i) => {
              
              comm = taux.comm;
              
              comm.forEach((value, j) => {
                
                this.nbr_taux[j] = ((this.nbr_taux[j]) ? this.nbr_taux[j] : 0 ) + value.nombre;
                
              });

            });

            console.log("calcTaux", this.nbr_taux);

          },

      },
      watch:{

        datefin: function(newDate) {
           if(this.dateA > this.datefin) {
            this.searchBtn  = false;
            this.validation = false;
           }else{
            this.searchBtn  = true;
            this.validation = true;
           }
        },

        // nbr_taux: function(){

        //   this.taux_cie.forEach((taux, i) => {
              
        //       comm = taux.comm;
              
        //       comm.forEach((value, j) => {
                
        //         this.nbr_taux[j] = ((this.nbr_taux[j]) ? this.nbr_taux[j] : 0 ) + value.nombre;
                
        //       });

        //     });

        // }

      },
      computed: {

          cieFilter: function() {

            this.nbr_taux = [];

            this.taux_cie.forEach((taux, i) => {
                
                comm = taux.comm;
                
                comm.forEach((value, j) => {
                  
                  this.nbr_taux[j] = parseInt((this.nbr_taux[j]) ? this.nbr_taux[j] : 0 ) + parseInt(value.nombre ? value.nombre : 0);
                  
                });

            });

          },
          
          sitesFilter: function() {

            return this.sites.filter(s => {
             
               if(this.agence) {
                 
                  if(this.agence.id) {

                     return s.agenceId == this.agence.id;
                  }

               }

               return true;
            });

          },

          equipesFilter: function() {

            return this.equipes.filter(s => {
             
                if(this.site) {
                 
                  if(this.site.id) {
                    
                     return s.siteId == this.site.id;
                  }

               }

               return true;
            });

          },

          conseillersFilter: function() {

            return this.conseillers.filter(s => {
             
                if(this.equipe) {
                 
                  if(this.equipe.id) {
                    
                     return s.equipeId == this.equipe.id;
                  }

               }

               return true;
            });

          },

      },
      created: function() {

        this.load();

      }
    })



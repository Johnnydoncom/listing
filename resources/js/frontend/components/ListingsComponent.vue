<template>
<div class="row mb-4">
    <div class="col-12 col-sm-3 car-filter">
    	<div class="card">
    		<div class="card-header">
    				FIlter 
    			</div>
    		<div class="card-body">	
    			<div class="form-group mt-sm-3">
    				<label for="">Filter By Category</label>
			       	<select class="form-control" @change="filterByCat()" v-model="category">
			       		<option selected="">Category</option>
			       		<option v-for="category in categories" :value="category.id">{{ category.name }}</option>
			       	</select>
			    </div>
			    <div class="form-group mt-sm-3">
			    	<label for="">Filter By Make</label>
			       	<select class="form-control" @change="filterByMake()" v-model="make">
			       		<option>Make</option>
			       		<option v-for="make in makes" :value="make.id">{{ make.name }}</option>
			       	</select>
			    </div>
    		</div>
    	</div>
    </div>
    <div class="col-12 col-sm-9">
        <div class="card">
        	<div class="card-header bg-transparent">
        		 <h4>Cars for Sale</h4>
        	</div>
            <div class="card-body">
                <div class="row">
                 
                    <div v-for="listing in listings" class="col car-lists border-top border-warning pb-2">

                    	 <div class="row clearfix mb-3 listing-item">
					           <div class="col-12 col-sm-2 w-100">
					           		<img class="img-fluid" :src="listing.featured_image" :alt="listing.title">
					           </div>
					           <div class="col-12 col-sm-10">
					               <h5><a :href="listing.slug">{{ listing.title }}</a></h5>
					               
					               <div class="d-flex w-100 justify-content-between">
					                  	<div class="">
		                                    <span v-if="listing.make">Make: {{ listing.make.name }}</span><br>
		                                    <span v-if="listing.model">Model: {{ listing.model.name }}</span><br v-if="listing.model">
		                                    <span>Location: {{ listing.location }}</span>
		                                </div>
					                  	<div class="b">
		                                    <span>Posted: <span class="fa fa-clock"></span> {{ listing.created_at | timeago }}</span><br>
		                                    <span>Price: <span class="fa fa-dollar-sign text-primary"></span> {{ listing.is_offer ? 'Offer' : listing.price }}</span>
		                                </div>
					                </div>

					           </div>
					       </div>

                            
                          </div>
                        </div>
                    </div>
                   	<div class="col" v-if="!listings.length">
                   		<p>No result found</p>
                   	</div>


                </div>
            </div>
</div>
<!-- <div class="clearfix"></div> -->
</template>
<script>
	var moment = require('moment');
	Vue.filter('moment', function(value, format) {
            return moment.utc(value).local().format(format);
    });
	Vue.filter('timeago', function(value) {
            return moment.utc(value).local().fromNow();
    });
    export default {
        mounted() {
        	// this.getListings();
        	// this.getCategories();
        	// this.getMakes();
         //    console.log('Component mounted.')
        },
        data() {
	        return {
	        	category:'',
	        	make: '',
	        	model:'',
	        	query:'',
	          	listings: [],
	          	categories: {},
	          	makes: {},
	          	models: {},
	          	message: {
		          	name: '',
		          	seller:'',
		          	customer: '',
		          	message:'',
	          	},
	          	moment: moment
	        }
	    },

	    methods: {
	    	getListings() {
	          window.axios.get('cars-for-sale').then((response) => {
	            this.listings = response.data;
	          });
	        },
	        getCategories() {
	          window.axios.get('/category').then((response) => {
	            this.categories = response.data;
	          });
	        },
	        getMakes() {
	          window.axios.get('/make').then((response) => {
	            this.makes = response.data;
	          });
	        },
	        filterByCat(){
	        	this.listings = {};
	        	window.axios.get('/category/'+ this.category).then((response) => {
		            this.listings = response.data;
		        });
	        },
	       	filterByMake(){
	        	this.listings = {};
	        	window.axios.get('/make/'+ this.make).then((response) => {
		            this.listings = response.data;
		        });
	        }
	        // getModels() {
	        // 	this.models = "";
	        //   	window.axios.get('/admin/make/'+ this.listing.make).then((response) => {
		       //      this.models = response.data;
		       //  });
	        // },
	    }

    }
</script>

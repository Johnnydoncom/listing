<template>
<form method="post" @submit.prevent="formSubmit">
	<div v-if="success" class="alert alert-success mt-3">
	       Suggestion Updated!
	</div>
    <div class="row">
    	<div class="col-8 border border-2 border-left-0 border-top-0 border-bottom-0">
        	<div class="card">
				<div class="card-body">
		            <div class="form-group">
		                <input type="text" v-model="listing.title" class="form-control form-control-lg" placeholder="Title">
		                <div v-if="errors && errors.title" class="text-danger">{{ errors.title[0] }}</div>
		            </div>
		            <div class="form-group">
		            	<input type="text" placeholder="Location" v-model="listing.location" class="form-control form-control-lg">
		            	<div v-if="errors && errors.location" class="text-danger">{{ errors.location[0] }}</div>
		            </div>
		            <div class="row">
		            	<div class="col">
		            		<div class="form-group">
				            	<input type="text" placeholder="Price" v-model="listing.price" class="form-control form-control-lg">
				            	<div v-if="errors && errors.price" class="text-danger">{{ errors.price[0] }}</div>
				            </div>
		            	</div>
		            	<div class="col">
		            		<div class="form-group">
				            	<input type="text" placeholder="Year" v-model="listing.year" class="form-control form-control-lg">
				            	<div v-if="errors && errors.year" class="text-danger">{{ errors.year[0] }}</div>
				            </div>
		            	</div>
		            	<div class="col">
		            		<div class="form-check form-check-inline">
				            	<label :for="listing.offer" class="form-check-label"><input type="checkbox" v-model="listing.offer" class="form-check-input"> This is an offer</label>
				            </div>
		            	</div>
		            </div>
		            <hr>
		            <div class="form-group">
		                <textarea name="description" class="form-control" v-model="listing.description" rows="10" placeholder="Description"></textarea>
		            </div>
			            <div class="row">
			           		<div class="col">
			           			<div class="form-group">
			           				<label for="">Transmission</label>
			           				<input type="text" name="tx" class="form-control">
			           			</div>
			           		</div>
			           		<div class="col">
			           			<div class="form-group">
			           				<label for="">VIN</label>
			           				<input type="text" name="" class="form-control">
			           			</div>
			           		</div>
			           		<div class="col">
			           			<div class="form-group">
			           				<label for="">drivetrain</label>
			           				<input type="text" name="" class="form-control">
			           			</div>
			           		</div>
			           	</div>
			           	<div class="row">
			           		<div class="col">
			           			<div class="form-group">
			           				<label for="">No of Gears</label>
			           				<input type="number" name="" class="form-control">
			           			</div>
			           		</div>
			           		<div class="col">
			           			<div class="form-group">
			           				<label for="">No of Air-Bag</label>
			           				<input type="number" name="" class="form-control">
			           			</div>
			           		</div>
			           		<div class="col">
			           			<div class="form-group">
			           				<label for="">Fuel Type</label>
			           				<input type="text" name="" class="form-control">
			           			</div>
			           		</div>
			           	</div>
			           	<div class="row">
			           		<div class="col">
			           			<div class="form-group">
			           				<label for="">Mileage</label>
			           				<input type="text" name="" class="form-control">
			           			</div>
			           		</div>
			           		<div class="col">
			           			<div class="form-group">
			           				<label for="">Interior Color</label>
			           				<input type="text" name="" class="form-control">
			           			</div>
			           		</div>
			           		<div class="col">
			           			<div class="form-group">
			           				<label for="">Exterior Color</label>
			           				<input type="text" name="" class="form-control">
			           			</div>
			           		</div>
			           	</div>
			           	<button class="btn btn-primary">Update</button>
			           	<button class="btn float-right" :class="listing.approved == '1' ? 'btn-success' : 'btn-danger'" @click="processApproval">{{ (listing.approved == 1) ? 'Approved' : 'Disapproved' }}</button>
			    </div>
    		</div>
		</div>

        <div class="col-4">
        	<div class="card">
				<div class="card-body">
            		<div class="form-group mt-4 border-bottom">
            			<label class="h4">Category</label>
						<select class="custom-select" size="5" v-model="listing.category" name="category">
						  <option selected>Select Category</option>
						  <option v-for="category in categories" :value="category.id">{{ category.name }}</option>
						  
						</select>
            		</div>

            		<div class="form-group mt-4 border-bottom">
            			<label class="h4">Make</label>
						<select class="custom-select" size="5" @change="getModels()" v-model="listing.make">
						  <option v-for="make in makes" :value="make.id">{{ make.name }}</option>
						</select>
            		</div>

            		<div class="form-group mt-4 border-bottom">
            			<label class="h4">Model</label>
						<select class="custom-select" size="3" v-model="listing.model">
							<!-- <option selected>Select Model</option> -->
						  	<option v-for="model in models" :value="model.id">{{ model.name }}</option>
						</select>
            		</div>
            		<div class="form-group mt-4 border-bottom">
            			<label class="h4">Featured Image</label>
						<input type="file" v-on:change="onImageChange" class="form-control">									
            		</div>
            		<div class="col-12" v-if="image">
                          <img :src="image" class="img img-responsive" style="width: 100%">
                     </div>

                </div>
            </div>
        </div>
    </div>
</form>

  
</template>
<script>
    export default {
    	props: ['slisting'],
        mounted() {
        	this.getCategories();
        	this.getMakes();
        	// this.getModels();
            console.log('Component mounted.')
        },
        data() {
	        return {
	        	image: this.slisting.featured_image,
	        	make: this.slisting.make_id,
	        	model: this.slisting.model_id,
	          	categories: {},
	          	makes: {},
	          	models: {},
	          	featured_image:'',
	          	listing: {
		          	title: this.slisting.title,
		          	description:this.slisting.description,
		          	make: this.slisting.make_id,
		          	model:this.slisting.model_id,
		          	category:this.slisting.category_id,
		          	price:this.slisting.price,
		          	featured_image: '',
		          	offer:this.slisting.is_offer,
		          	year:this.slisting.year,
		          	location:this.slisting.location,
		          	approved: this.slisting.approved
	          	},
	          	errors: {},
	          	success: false,
	        }
	    },
      created() {
	     this.getModels();
	    },

	    methods: {
	        getCategories() {
	          window.axios.get('/admin/category').then((response) => {
	            this.categories = response.data;
	          });
	        },
	        getMakes() {
	          window.axios.get('/admin/make').then((response) => {
	            this.makes = response.data;
	            this.getModels();
	          });
	        },
	        getModels() {
	        	// this.models = "";
	          	window.axios.get('/admin/make/'+ this.listing.make).then((response) => {
		            this.models = response.data;
		        });
	        },

            formSubmit(e) {
                window.axios.put('/admin/listing/'+ this.slisting.id, this.listing).then(response => {
			        this.success = true;
       
			    }).catch(error => {
			        if (error.response.status === 422) {
			          this.errors = error.response.data.errors || {};
			        }
			     });
            },

            // Image upload
            onImageChange(e) {
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createImage(files[0]);
            },
            createImage(file) {
                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    vm.image = e.target.result;
                    vm.listing.featured_image = e.target.result;
                };
                reader.readAsDataURL(file);
            },

            processApproval(){
            	window.axios.post('/admin/listing/approval', {listing_id: this.slisting.id}).then((response) => {
		            this.listing.approved = response.data.approved;
		            // console.log(response.data.approved);
		        });
            }



	    }
    }
</script>
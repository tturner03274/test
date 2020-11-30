<div id="vue-vehicle-lookup">
    <label for="vehicle_registration" class="block pb-1 text-brand-blue font-bold">Registration *</label>

    <input
        type="text"
        name="vehicle_registration"
        id="vehicle_registration"
        value="{{ old('vehicle_registration') }}"
        :value="vehicle_registration" @input="vehicle_registration = $event.target.value.toUpperCase()"
        required
        placeholder="e.g. AB10 CDE"
        class="pw-input inline-block {{ $errors->has('vehicle_registration') ? 'border-brand-blue mb-1' : '' }}"
    >

    <div class="inline-block">
        <button v-on:click.prevent="getVehicle" class="leading-tight text-brand-blue p-4 py-3 font-bold cursor-pointer" v-cloak>
            <i class="fas fa-search text-brand-gray-300 pr-1"></i> @{{ buttonText }}
        </button>
    </div>

    <p v-if="foundVehicle" v-cloak class="text-green-500 mb-6"><i class="far fa-check-circle"></i> Vehicle found.</p>
    <p v-if="lookupErrors" v-cloak class="text-orange-500 mb-6"><i class="far fa-times-circle"></i> @{{ lookupErrors }}</p>

    <div v-if="foundVehicle" v-cloak class="">
        <div class="flex -mx-1">
            <div class="px-1 w-1/4">
                <label class="block pb-1 text-brand-blue font-bold">Vehicle Make</label>
                <input
                    type="text" readonly name="vehicle_make" required placeholder="Automatically filled"
                    class="pw-input {{ $errors->has('vehicle_make') ? 'border-brand-blue mb-1' : 'border-brand-gray-300 mb-6' }}"
                    v-model="foundVehicle.make"
                >
            </div>
            
            <div class="px-1 w-1/4">
                <label class="block pb-1 text-brand-blue font-bold">Vehicle Model</label>
                <input
                    type="text" readonly name="vehicle_model" required placeholder="Automatically filled"
                    class="pw-input {{ $errors->has('vehicle_model') ? 'border-brand-blue mb-1' : 'border-brand-gray-300 mb-6' }}"
                    v-model="foundVehicle.model"
                >
            </div>
            
            <div class="px-1 w-1/4">
                <label class="block pb-1 text-brand-blue font-bold">Manufacture Date</label>
                <input
                    type="text" readonly name="vehicle_year" required placeholder="Automatically filled"
                    class="pw-input {{ $errors->has('vehicle_year') ? 'border-brand-blue mb-1' : 'border-brand-gray-300 mb-6' }}"
                    v-model="foundVehicle.manufactureDate"
                >
            </div>
            
            <div class="px-1 w-1/4">
                <label class="block pb-1 text-brand-blue font-bold">MOT Expires</label>
                <input
                    type="text" readonly name="mot_expiry" required placeholder="Automatically filled"
                    class="pw-input {{ $errors->has('mot_expiry') ? 'border-brand-blue mb-1' : 'border-brand-gray-300 mb-6' }}"
                    v-model="foundVehicle.motTests[0].expiryDate"
                >
            </div>
        </div>

    </div>
</div>

@section('js')
@parent

<script>

new Vue({
  el: '#vue-vehicle-lookup',
  data: {
    buttonText: 'Look Up Vehicle',
    vehicle_registration: '',
    lookupErrors: null,
    foundVehicle: null,
  },
  methods: {
      getVehicle() {
        
        var self = this;
        
        this.buttonText = 'Searching...'

        // reset data
        this.foundVehicle = null;
        this.lookupErrors = null;

        axios.post('/vehicle-api', {
            registration: this.vehicle_registration
        })
        .then(function (response) {    
            self.buttonText = 'Look Up Vehicle';
            self.foundVehicle = response.data[0];
        })
        .catch(function (error) {
            
            self.buttonText = 'Look Up Vehicle';
            
            // validation error
            if ( error.response.data.hasOwnProperty('errors') ){
                self.lookupErrors = error.response.data.errors.registration[0];
            }
            
            // http errors
            if ( error.response.data.hasOwnProperty('errorMessage') ){
                self.lookupErrors = error.response.data.errorMessage;
            }
            
        })
        .finally(function () {
        });
      }
  }
});



</script>
@endsection
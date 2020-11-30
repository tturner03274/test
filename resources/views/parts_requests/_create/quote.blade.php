
<div id="vue-deadline">
    
    <label for="deadline" class="block pb-1 text-brand-blue font-bold">Deadline *</label>
    
    <div class="flex items-center mb-6">

        <select class="pw-input mb-0" name="deadline" id="" v-model.lazy="deadline" v-on:change="updateExpiryDate">
            <option value="10">10 Minutes</option>
            <option value="30">30 Minutes</option>
            <option value="60">1 Hour</option>
            <option value="180">3 Hours</option>
            <option value="{{ 24*60 }}">1 Day</option>
            <option value="{{ 7*24*60 }}">7 Days</option>
        </select>

        <div class="pl-6">Bidding will end at <span class="text-brand-blue">@{{ deadlineTime }}</span> on <span class="text-brand-blue">@{{ deadlineDate }}</span></div>
    </div>
</div>

@include('_partials.forms.row.input', [
    'type' => 'text',
    'name' => 'delivery_postcode',
    'label' => 'Delivery Postcode',
    'placeholder' => 'e.g. AB10 2CD',
    'required' => true,
    'value' => auth()->user()->post_code,
])


@section('js')
@parent
<script>
new Vue({
  el: '#vue-deadline',
  data: {
    deadline: '10',
    deadlineTime: '',
    deadlineDate: ''
  },
  mounted:function(){
    
    this.interval = setInterval(() => {
      this.updateExpiryDate();
    }, 1000);

    this.updateExpiryDate()
    
  },
  methods: {
    updateExpiryDate() {
        var deadline = moment().add(this.deadline, 'minutes');
        this.deadlineTime = deadline.format('HH:mm:ss'); // 18:31 Thu 5 Sep 2019 
        this.deadlineDate = deadline.format('ddd D MMM YYYY'); // 18:31 Thu 5 Sep 2019 
    }
  }
})
</script>
@endsection
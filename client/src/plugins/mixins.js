import Vue from 'vue'

const mixin = {
  
    methods: {
        
        //format price
        formatPrice(value) {
            let val = (value/1).toFixed(0).replace('.', ',')
            return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
        },

    },

}

Vue.mixin(mixin)
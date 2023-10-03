import { defineStore } from "pinia";
import { ref, computed } from "vue";
import axios from 'axios';

export const useUserStore = defineStore('user', {
    state:() => ({
        destinations: [],
    }),
    getters:{},
    actions:{
       async fetchDestination(){
        try {
            const {data} = await axios({
                method:'GET',
                url:"http://localhost:8000/api/destination",
            })
            
           console.log(data);
           this.destinations = data.data
        } catch (error) {
            console.log(error);
        }
       },
    }
})
 
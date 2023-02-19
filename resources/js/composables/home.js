import { reactive } from "vue";
import axios from "axios";

export default function useHome(){

    const contactForm = reactive({
        email: '',
        name: '',
        message: ''
    });

 

    return
    {
      contactSubmit,
       contactForm
    };
}



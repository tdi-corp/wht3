<template>
  <div class="flex justify-content-center">
    <form @submit.prevent="submitForm" class=" w-full">
        <div class="mb-2">
            <InputText v-model="name" placeholder="Enter Title" fluid :class="{'p-invalid':$v?.name?.$error}" />
        </div>
        <div class="mb-2">
            <InputText v-model="description" placeholder="Enter Description" fluid :class="{'p-invalid':$v?.description?.$error}" />
        </div>   
        <div class="mb-2">
            <InputText v-model="price" placeholder="Enter Price" fluid :class="{'p-invalid':$v?.price?.$error}" />
        </div>  
        <div class="mb-2">
            <InputText v-model="url1" placeholder="Enter Main Url" fluid :class="{'p-invalid':$v?.url1?.$error}" />
        </div> 
        <div class="mb-2">
            <InputText v-model="url2" placeholder="Enter Url 2" fluid :class="{'p-invalid':$v?.url2?.$error}" />
        </div>  
        <div class="mb-2">
            <InputText v-model="url3" placeholder="Enter Url 3" fluid :class="{'p-invalid':$v?.url3?.$error}" />
        </div>                   
        <p v-for="error of $v.$errors" :key="error.$uid" class="text-sm text-red-600">
            {{ error.$message }}
        </p>        
        
      <Button type="submit" class="p-button p-button-primary">Submit</Button>
    </form>
  </div>
</template>

<script setup>
import { useDialog } from "primevue/usedialog";
import { ref, computed, inject } from "vue";

import InputText from 'primevue/inputtext';
import { required, minLength, maxLength, numeric } from '@vuelidate/validators'
import { useVuelidate } from '@vuelidate/core'


const dialogRef = inject("dialogRef");
const dialogEmit = defineEmits(['save']);
const dialog = useDialog();
const name = ref('')
const description = ref('')
const price = ref('')
const url1 = ref('')
const url2 = ref('')
const url3 = ref('')

const rules = computed(() => (
  {
    name: {
        required,
        maxLength: maxLength(200),
    },
    description: {
        required,
        maxLength: maxLength(1000),
    },
    price: {
        required,
        numeric,
    },
    url1: {
        required,
        minLength: minLength(5),
        maxLength: maxLength(300),
    },
    url2: {
        minLength: minLength(5),
        maxLength: maxLength(300),
    },
    url3: {
        minLength: minLength(5),
        maxLength: maxLength(300),
    },                  
  }
));

const $v = useVuelidate(rules, { 
    name, 
    description,
    price,
    url1,
    url2,
    url3
});

const submitForm = () => {
  const result = $v.value.$validate();
  result.then((res) => {
    if(res) {
        PostsService()
        .then(res => {
            dialogEmit('save')
            console.log(res?.data);  //id
        })     
    }
  }).catch((err) => {
    console.log(err);
  })

};


const PostsService = async () => {
    const myHeaders = new Headers();
    myHeaders.append("Content-Type", "application/json");

    return await fetch('http://localhost:8000/api/post', {
        method: "POST",
        body: JSON.stringify({ 
            name: name.value,
            description: description.value,
            price: price.value,
            url1: url1.value, 
        }),
        headers: myHeaders,
    })
    .then((res) => res.json());
}

</script>

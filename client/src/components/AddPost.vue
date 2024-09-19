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
        <p v-for="error of $v.$errors" :key="error.$uid" class="text-sm text-red-600">
            {{ error.$message }}
        </p>        
        
      <Button type="submit" class="p-button p-button-primary">Submit</Button>
    </form>
  </div>
</template>

<script setup>
// import { ref, onMounted, inject, computed } from "vue";
import { useDialog } from "primevue/usedialog";
import { ref, computed, inject } from "vue";

import InputText from 'primevue/inputtext';
import { required, minLength, maxLength } from '@vuelidate/validators'
import { useVuelidate } from '@vuelidate/core'


const dialogRef = inject("dialogRef");
const dialog = useDialog();
// const products = ref(null);
const name = ref('')
const description = ref('')
const price = ref('')
const url1 = ref('')
const url2 = ref('')
const url3 = ref('')

// onMounted(() => {

// });

// const selectProduct = (data) => {
//     dialogRef.value.close(data);
// };


const rules = computed(() => (
  {
    name: {
      required,
      minLength: minLength(1),
      maxLength: maxLength(4),
    },
    description: {
      required,
      minLength: minLength(1),
      maxLength: maxLength(4),
    },
    price: {
      required,
      minLength: minLength(1),
      maxLength: maxLength(4),
    },
    url1: {
      required,
      minLength: minLength(1),
      maxLength: maxLength(4),
    },
               
  }
));

const $v = useVuelidate(rules, { 
    name, 
    description,
    price,
    url1
});
console.log($v);

const submitForm = () => {
  const result = $v.value.$validate();
  result.then((res) => {
    if(res) {
      alert('Form submitted.');
    }
  }).catch((err) => {
    console.log(err);
  })

};

</script>

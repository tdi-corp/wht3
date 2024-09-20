<template>
  <div class="w-full">
        <div class="mb-2">
            <InputText disabled :value="state.data.name" placeholder="Name" fluid  />
        </div>
        <div class="mb-2">
            <InputText disabled :value="state.data.price" placeholder="Price" fluid  />
        </div>   
        <div class="mb-2">
            <InputText disabled :value="state.data.url1" placeholder="Main Url" fluid  />
        </div>  
        <div class="mb-2">
            <InputGroup>
                <InputText disabled :value="state.data.description" placeholder="Description" fluid  />
                <Button label="Запросить описание" @click="ShowFields('description')"/>
            </InputGroup>
        </div> 
        <div class="mb-2">
            <InputGroup>
                <InputText disabled :value="state.data.url2" placeholder="Url 2" fluid  />
                <Button label="Запросить Ссылку 2" @click="ShowFields('url2')"/>
            </InputGroup>
        </div>  
        <div class="mb-2">
            <InputGroup>
                <InputText disabled :value="state.data.url3" placeholder="Url 3" fluid />
                <Button label="Запросить Ссылку 3" @click="ShowFields('url3')"/>
            </InputGroup>
        </div> 
    </div>
</template>

<script setup>
import {  inject, reactive } from "vue";
import { useDialog } from "primevue/usedialog";
import InputText from 'primevue/inputtext';
import InputGroup from "primevue/inputgroup";
import { Services } from "@/services";

const dialogRef = inject("dialogRef");
const dialog = useDialog();

const state = reactive(dialogRef.value?.data?.data)

const ShowFields = (params = null) => {
    
    Services.ShowService(state.data.id, {fields: params})
        .then(res => {
            if(res?.data[params]){
                state.data = Object.assign(state.data, {[params]: res?.data[params]})

            }
            
        })
}

</script>

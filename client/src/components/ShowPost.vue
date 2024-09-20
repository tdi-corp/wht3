<template>
  <div class="w-full">
        <div class="mb-2">
            <InputText disabled :value="12" placeholder="Name" fluid  />
        </div>
        <div class="mb-2">
            <InputText disabled placeholder="Price" fluid  />
        </div>   
        <div class="mb-2">
            <InputText disabled placeholder="Main Url" fluid  />
        </div>  
        <div class="mb-2">
            <InputGroup>
                <InputText disabled placeholder="Description" fluid  />
                <Button label="Запросить описание" />
            </InputGroup>
        </div> 
        <div class="mb-2">
            <InputGroup>
                <InputText disabled placeholder="Url 2" fluid  />
                <Button label="Запросить Ссылку 2" />
            </InputGroup>
        </div>  
        <div class="mb-2">
            <InputGroup>
                <InputText disabled placeholder="Url 3" fluid  />
                <Button label="Запросить Ссылку 3" />
            </InputGroup>
        </div> 
        
        {{ state }}
    </div>
</template>

<script setup>
import {  inject, reactive } from "vue";
import { useDialog } from "primevue/usedialog";
import InputText from 'primevue/inputtext';
import InputGroup from "primevue/inputgroup";

const dialogRef = inject("dialogRef");
const dialog = useDialog();

const state = reactive(dialogRef.value?.data?.data)

</script>

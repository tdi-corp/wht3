<template>
	<div>
        Test

	</div>
</template>

<script setup>
import { ref, onMounted, inject } from "vue";
import { useDialog } from "primevue/usedialog";

const dialogRef = inject("dialogRef");
const dialog = useDialog();
const products = ref(null);

onMounted(() => {

});

const selectProduct = (data) => {
    dialogRef.value.close(data);
};


</script>
